<x-filament-panels::page>
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        
        <!-- Left: Product Grid & Search -->
        <div class="lg:col-span-7 space-y-4">
            
            <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 flex flex-wrap gap-4 items-center justify-between">
                <div class="flex-1 min-w-[200px]">
                    <input 
                        type="text" 
                        wire:model.live.debounce.300ms="searchQuery" 
                        placeholder="🔍 Search product by Name, SKU, Barcode, Brand..." 
                        class="w-full text-sm rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-emerald-500 focus:border-emerald-500"
                    />
                </div>
                <div>
                    <select wire:model.live="selectedBranchId" class="text-sm rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        @foreach(\App\Models\Branch::all() as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Product Cards -->
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 max-h-[600px] overflow-y-auto pr-1">
                @php
                    $products = \App\Models\Product::query()
                        ->where('is_active', true)
                        ->when($this->searchQuery, function($q, $s) {
                            $q->where('name', 'like', "%{$s}%")
                              ->orWhere('sku', 'like', "%{$s}%")
                              ->orWhere('barcode', 'like', "%{$s}%");
                        })
                        ->limit(24)
                        ->get();
                @endphp

                @forelse($products as $prod)
                    <div wire:click="addToCart({{ $prod->id }})" class="bg-white dark:bg-gray-800 p-3 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-emerald-500 cursor-pointer transition shadow-sm flex flex-col justify-between">
                        <div>
                            <div class="text-xs text-emerald-600 font-semibold">{{ $prod->brand?->name ?? 'Genuine' }}</div>
                            <div class="font-medium text-xs text-gray-800 dark:text-gray-100 line-clamp-2 mt-1">{{ $prod->name }}</div>
                            <div class="text-[11px] text-gray-500 dark:text-gray-400 mt-0.5">SKU: {{ $prod->sku }}</div>
                        </div>
                        <div class="mt-3 flex items-center justify-between">
                            <span class="font-bold text-sm text-emerald-600 dark:text-emerald-400">৳{{ number_format($prod->effective_price, 0) }}</span>
                            <span class="text-[10px] bg-emerald-50 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300 px-1.5 py-0.5 rounded font-bold">+ ADD</span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-10 text-gray-400">
                        No products found matching your search.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Right: Current POS Cart & Checkout -->
        <div class="lg:col-span-5 bg-white dark:bg-gray-800 p-5 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm flex flex-col justify-between h-full min-h-[580px]">
            <div>
                <div class="flex items-center justify-between border-b border-gray-100 dark:border-gray-700 pb-3 mb-3">
                    <h2 class="font-bold text-base text-gray-800 dark:text-gray-100 flex items-center gap-2">
                        <span>🧾 Current Order Cart</span>
                        <span class="text-xs bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded-full">{{ count($cart) }} Items</span>
                    </h2>
                    @if(!empty($cart))
                        <button wire:click="clearCart" class="text-xs text-rose-500 hover:underline">Clear</button>
                    @endif
                </div>

                <!-- Customer Details Input -->
                <div class="grid grid-cols-2 gap-2 mb-3">
                    <div>
                        <label class="text-[11px] text-gray-500 dark:text-gray-400 block mb-1">Customer Mobile</label>
                        <input type="text" wire:model.defer="customerPhone" placeholder="017..." class="w-full text-xs rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" />
                    </div>
                    <div>
                        <label class="text-[11px] text-gray-500 dark:text-gray-400 block mb-1">Customer Name</label>
                        <input type="text" wire:model.defer="customerName" placeholder="Name" class="w-full text-xs rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" />
                    </div>
                </div>

                <!-- Cart Items List -->
                <div class="max-h-[260px] overflow-y-auto divide-y divide-gray-100 dark:divide-gray-700 pr-1">
                    @forelse($cart as $item)
                        <div class="py-2.5 flex items-center justify-between gap-2">
                            <div class="flex-1 min-w-0">
                                <div class="text-xs font-medium text-gray-800 dark:text-gray-100 truncate">{{ $item['name'] }}</div>
                                <div class="text-[11px] text-gray-400">৳{{ number_format($item['price'], 0) }} each</div>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <button wire:click="updateQuantity({{ $item['id'] }}, -1)" class="w-6 h-6 rounded bg-gray-100 dark:bg-gray-700 flex items-center justify-center font-bold text-xs">-</button>
                                <span class="text-xs font-semibold w-5 text-center">{{ $item['qty'] }}</span>
                                <button wire:click="updateQuantity({{ $item['id'] }}, 1)" class="w-6 h-6 rounded bg-gray-100 dark:bg-gray-700 flex items-center justify-center font-bold text-xs">+</button>
                            </div>
                            <div class="text-right min-w-[65px]">
                                <div class="text-xs font-bold text-gray-900 dark:text-white">৳{{ number_format($item['total'], 0) }}</div>
                                <button wire:click="removeFromCart({{ $item['id'] }})" class="text-[10px] text-red-500 hover:underline">Remove</button>
                            </div>
                        </div>
                    @empty
                        <div class="py-12 text-center text-xs text-gray-400">
                            Cart is empty. Click on products to add.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Bottom: Totals & Complete -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-3 mt-3 space-y-2">
                <div class="flex justify-between text-xs text-gray-600 dark:text-gray-400">
                    <span>Subtotal:</span>
                    <span>৳{{ number_format($this->subtotal, 2) }}</span>
                </div>
                <div class="flex items-center justify-between text-xs text-gray-600 dark:text-gray-400">
                    <span>Special Discount (৳):</span>
                    <input type="number" wire:model.live.debounce.300ms="discount" class="w-24 text-right text-xs py-0.5 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" />
                </div>
                <div class="flex justify-between text-base font-bold text-emerald-600 dark:text-emerald-400 pt-1 border-t border-gray-100 dark:border-gray-700">
                    <span>Net Total Payable:</span>
                    <span>৳{{ number_format($this->total, 2) }}</span>
                </div>

                <!-- Payment Selection -->
                <div class="pt-2">
                    <label class="text-[11px] font-semibold text-gray-500 block mb-1">Payment Method</label>
                    <div class="grid grid-cols-4 gap-1.5 text-xs">
                        @foreach(['cash' => 'Cash', 'bkash' => 'bKash', 'nagad' => 'Nagad', 'card' => 'POS Card'] as $key => $label)
                            <button 
                                type="button" 
                                wire:click="$set('paymentMethod', '{{ $key }}')"
                                class="py-1.5 px-2 rounded font-medium border text-center transition {{ $paymentMethod === $key ? 'bg-emerald-600 text-white border-emerald-600' : 'bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-600' }}">
                                {{ $label }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <button 
                    type="button" 
                    wire:click="completeSale"
                    wire:loading.attr="disabled"
                    class="w-full py-2.5 mt-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-lg shadow-sm transition text-sm flex items-center justify-center gap-2">
                    <span>Complete Sale (৳{{ number_format($this->total, 0) }})</span>
                </button>

                @if($lastCompletedOrderId)
                    <div class="pt-2 text-center">
                        <a href="{{ route('order.pdf.receipt', $lastCompletedOrderId) }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs text-emerald-600 dark:text-emerald-400 font-bold hover:underline">
                            <span>🖨️ Print 80mm Bangla Thermal Receipt</span>
                        </a>
                    </div>
                @endif
            </div>
        </div>

    </div>
</x-filament-panels::page>
