<?php

namespace App\Filament\Pages;

use App\Models\Branch;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\DB;

class PosTerminal extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-calculator';

    protected static ?string $navigationGroup = 'POS & Sales';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'POS Terminal (পয়েন্ট অব সেল)';

    protected static ?string $title = 'Showroom POS Terminal';

    protected static string $view = 'filament.pages.pos-terminal';

    public $selectedBranchId;
    public $searchQuery = '';
    public $customerPhone = '';
    public $customerName = 'Walk-in Customer';
    public $paymentMethod = 'cash';
    public $cart = []; // [productId => ['id', 'name', 'price', 'qty', 'total']]
    public $discount = 0;
    public $paidAmount = 0;
    public $lastCompletedOrderId = null;

    public function mount()
    {
        $this->selectedBranchId = auth()->user()?->branch_id ?? Branch::first()?->id ?? 1;
    }

    public function addToCart($productId)
    {
        $product = Product::find($productId);
        if (!$product) {
            return;
        }

        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['qty'] += 1;
            $this->cart[$productId]['total'] = $this->cart[$productId]['qty'] * $this->cart[$productId]['price'];
        } else {
            $price = $product->effective_price;
            $this->cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'sku' => $product->sku,
                'price' => $price,
                'qty' => 1,
                'total' => $price,
            ];
        }

        Notification::make()->title('Item Added to Cart')->success()->send();
    }

    public function updateQuantity($productId, $change)
    {
        if (!isset($this->cart[$productId])) {
            return;
        }

        $newQty = $this->cart[$productId]['qty'] + $change;
        if ($newQty <= 0) {
            unset($this->cart[$productId]);
        } else {
            $this->cart[$productId]['qty'] = $newQty;
            $this->cart[$productId]['total'] = $newQty * $this->cart[$productId]['price'];
        }
    }

    public function removeFromCart($productId)
    {
        unset($this->cart[$productId]);
    }

    public function clearCart()
    {
        $this->cart = [];
        $this->discount = 0;
        $this->paidAmount = 0;
    }

    public function getSubtotalProperty()
    {
        return array_sum(array_column($this->cart, 'total'));
    }

    public function getTotalProperty()
    {
        return max(0, $this->subtotal - (float) $this->discount);
    }

    public function completeSale()
    {
        if (empty($this->cart)) {
            Notification::make()->title('Cart is empty')->warning()->send();
            return;
        }

        DB::beginTransaction();
        try {
            // Find or create customer
            $customer = null;
            if (!empty($this->customerPhone)) {
                $customer = Customer::firstOrCreate(
                    ['phone' => $this->customerPhone],
                    ['name' => $this->customerName, 'district' => 'Dhaka']
                );
                // award loyalty points
                $customer->increment('loyalty_points', (int) ($this->total / 100));
            }

            $order = Order::create([
                'order_number' => Order::generateOrderNumber('POS'),
                'branch_id' => $this->selectedBranchId,
                'customer_id' => $customer?->id,
                'user_id' => auth()->id(),
                'customer_name' => $this->customerName,
                'customer_phone' => $this->customerPhone ?: '01700000000',
                'delivery_address' => 'Outlet Counter Sales',
                'delivery_zone' => 'inside_dhaka',
                'delivery_city' => 'Dhaka',
                'subtotal' => $this->subtotal,
                'discount' => $this->discount,
                'delivery_charge' => 0,
                'total_amount' => $this->total,
                'paid_amount' => $this->paidAmount > 0 ? $this->paidAmount : $this->total,
                'due_amount' => max(0, $this->total - ($this->paidAmount > 0 ? $this->paidAmount : $this->total)),
                'order_type' => 'pos',
                'payment_method' => $this->paymentMethod,
                'payment_status' => 'paid',
                'status' => 'delivered',
            ]);

            foreach ($this->cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'product_name' => $item['name'],
                    'unit_price' => $item['price'],
                    'quantity' => $item['qty'],
                    'total_price' => $item['total'],
                ]);

                // Deduct branch stock
                \App\Models\BranchStock::where('branch_id', $this->selectedBranchId)
                    ->where('product_id', $item['id'])
                    ->decrement('stock_quantity', $item['qty']);
            }

            DB::commit();

            $this->lastCompletedOrderId = $order->id;
            $this->clearCart();

            Notification::make()
                ->title('Sale Completed Successfully!')
                ->body("Order: {$order->order_number} | Total: ৳" . number_format($order->total_amount, 2))
                ->success()
                ->send();

        } catch (\Throwable $e) {
            DB::rollBack();
            Notification::make()->title('POS Sale Error')->body($e->getMessage())->danger()->send();
        }
    }
}
