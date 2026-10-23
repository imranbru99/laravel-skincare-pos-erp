<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Services\BangladeshiCourierService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    /**
     * High-converting single-product landing page checkout
     */
    public function quickCheckout(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => ['required', 'string', 'regex:/^(?:\+?88)?01[3-9]\d{8}$/'],
            'delivery_address' => 'required|string',
            'delivery_zone' => 'required|in:inside_dhaka,sub_dhaka,outside_dhaka',
            'quantity' => 'nullable|integer|min:1',
            'payment_method' => 'required|in:cod,bkash,nagad',
            'notes' => 'nullable|string',
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $quantity = (int) ($validated['quantity'] ?? 1);
        $deliveryCharge = BangladeshiCourierService::calculateDeliveryFee($validated['delivery_zone']);
        $unitPrice = $product->effective_price;
        $subtotal = $unitPrice * $quantity;
        $totalAmount = $subtotal + $deliveryCharge;

        DB::beginTransaction();
        try {
            // Find or create customer
            $customer = Customer::firstOrCreate(
                ['phone' => $validated['customer_phone']],
                [
                    'name' => $validated['customer_name'],
                    'address' => $validated['delivery_address'],
                    'district' => $validated['delivery_zone'] === 'inside_dhaka' ? 'Dhaka' : 'Outside Dhaka',
                ]
            );

            // Default dispatch branch
            $branch = Branch::where('is_central_warehouse', true)->first() ?? Branch::first();

            $order = Order::create([
                'order_number' => Order::generateOrderNumber('LP'),
                'branch_id' => $branch?->id,
                'customer_id' => $customer->id,
                'customer_name' => $validated['customer_name'],
                'customer_phone' => $validated['customer_phone'],
                'delivery_address' => $validated['delivery_address'],
                'delivery_zone' => $validated['delivery_zone'],
                'delivery_city' => $validated['delivery_zone'] === 'inside_dhaka' ? 'Dhaka' : 'Outside Dhaka',
                'subtotal' => $subtotal,
                'discount' => 0,
                'delivery_charge' => $deliveryCharge,
                'total_amount' => $totalAmount,
                'paid_amount' => $validated['payment_method'] === 'cod' ? 0 : $totalAmount,
                'due_amount' => $validated['payment_method'] === 'cod' ? $totalAmount : 0,
                'order_type' => 'landing_page',
                'payment_method' => $validated['payment_method'],
                'payment_status' => $validated['payment_method'] === 'cod' ? 'pending' : 'paid',
                'status' => 'pending',
                'notes' => $validated['notes'],
            ]);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'unit_price' => $unitPrice,
                'quantity' => $quantity,
                'total_price' => $subtotal,
            ]);

            DB::commit();

            return redirect()->route('order.success', $order->order_number);
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', 'অর্ডার সম্পন্ন করতে সমস্যা হয়েছে: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Demo 1-Click Login as different personas
     */
    public function demoLogin(string $role)
    {
        $user = User::where('role', $role)->first();
        if ($user) {
            Auth::login($user);
            return redirect('/admin');
        }

        return redirect('/demo')->with('error', 'Demo user not found for this role.');
    }
}
