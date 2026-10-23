@extends('layouts.public')

@section('title', ($product->bangla_name ?: $product->name) . ' - ১০০% অরিজিনাল স্কিনকেয়ার')

@section('content')

<div class="bg-slate-50 py-10 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Top Urgency Banner -->
        <div class="bg-rose-600 text-white text-xs font-bold py-2.5 px-4 rounded-xl text-center mb-6 shadow-md flex items-center justify-center gap-2">
            <span>🔥 বিশেষ অফার চলছে! আজই অর্ডার করলে পাবেন নিশ্চিত জেনুইন কোরিয়ান প্রোডাক্ট ও ক্যাশ অন ডেলিভারি</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left Column: Product Showcase -->
            <div class="lg:col-span-7 bg-white p-6 sm:p-8 rounded-2xl border border-slate-200 shadow-sm space-y-6">
                
                <div class="flex items-center justify-between">
                    <span class="text-xs bg-emerald-100 text-emerald-800 font-bold px-3 py-1 rounded-full">
                        {{ $product->brand?->name ?? 'Genuine' }} • {{ $product->country_of_origin }}
                    </span>
                    <span class="text-xs text-slate-500 font-semibold">SKU: {{ $product->sku }}</span>
                </div>

                <h1 class="text-2xl sm:text-3xl font-black text-slate-900 leading-tight">
                    {{ $product->landing_headline ?: ($product->bangla_name ?: $product->name) }}
                </h1>

                <!-- Price Box -->
                <div class="p-4 bg-emerald-50 rounded-xl border border-emerald-100 flex items-center justify-between">
                    <div>
                        <div class="text-xs text-emerald-700 font-semibold">অফার মূল্য (Discounted Price):</div>
                        <div class="flex items-baseline gap-2 mt-0.5">
                            <span class="text-3xl font-black text-emerald-800">৳{{ number_format($product->effective_price, 0) }}</span>
                            @if($product->sale_price && $product->sale_price < $product->regular_price)
                                <span class="text-sm text-slate-400 line-through">৳{{ number_format($product->regular_price, 0) }}</span>
                                <span class="text-xs font-bold text-rose-600">({{ round((($product->regular_price - $product->sale_price) / $product->regular_price) * 100) }}% ছাড়)</span>
                            @endif
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="inline-block bg-emerald-600 text-white text-[11px] font-bold px-2.5 py-1 rounded-md">ইন স্টক (In Stock)</span>
                        <div class="text-[11px] text-slate-500 mt-1">ক্যাশ অন ডেলিভারি সারা দেশে</div>
                    </div>
                </div>

                <!-- Highlights List -->
                <div class="space-y-3">
                    <h3 class="font-bold text-slate-900 text-sm">উপকারিতা ও বৈশিষ্ট্য:</h3>
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 text-xs sm:text-sm text-slate-700 bn-font leading-relaxed whitespace-pre-line">
                        @if($product->landing_highlights)
                            {{ $product->landing_highlights }}
                        @else
                            ✓ ১০০% অথেনটিক কোরিয়ান ফর্মুলেশন (BSTI সার্টিফাইড)
                            ✓ ত্বককে করে তোলে মসৃণ, কোমল ও উজ্জ্বল
                            ✓ রোদে পোড়া দাগ, ব্রণ ও পিগমেন্টেশন কমাতে সাহায্য করে
                            ✓ কোনো ক্ষতিকর প্যারাবেন বা কৃত্রিম উপাদান নেই
                        @endif
                    </div>
                </div>

                <!-- How to use -->
                @if($product->how_to_use)
                    <div class="space-y-2">
                        <h3 class="font-bold text-slate-900 text-sm">ব্যবহারের সঠিক নিয়ম:</h3>
                        <p class="text-xs text-slate-600 bn-font leading-relaxed bg-slate-50 p-3 rounded-lg border border-slate-100">
                            {{ $product->how_to_use }}
                        </p>
                    </div>
                @endif

                <!-- Authenticity Guarantee -->
                <div class="p-4 rounded-xl border border-dashed border-emerald-300 bg-emerald-50/50 flex items-center gap-3">
                    <span class="text-3xl">🛡️</span>
                    <div class="text-xs text-slate-700 bn-font">
                        <strong>১০০% আসল পণ্যের গ্যারান্টি:</strong> আমাদের প্রতিটি পণ্য সরাসরি ব্র্যান্ড অনুমোদিত আমদানিকারকের মাধ্যমে সংগৃহীত। নকল প্রমাণে শতভাগ মূল্য ফেরত!
                    </div>
                </div>

            </div>

            <!-- Right Column: High-Converting Direct Checkout Form -->
            <div class="lg:col-span-5 bg-white p-6 sm:p-8 rounded-2xl border-2 border-emerald-500 shadow-xl space-y-5 sticky top-28">
                
                <div class="text-center pb-3 border-b border-slate-100">
                    <span class="text-xs bg-rose-100 text-rose-800 font-bold px-3 py-1 rounded-full uppercase">Order Confirmation</span>
                    <h2 class="text-xl font-black text-slate-900 mt-2">অর্ডারটি কনফার্ম করতে ফর্মটি পূরণ করুন</h2>
                    <p class="text-xs text-slate-500 mt-1">কোনো অগ্রিম পেমেন্ট ছাড়াই অর্ডার করুন</p>
                </div>

                <form action="{{ route('order.quick-checkout') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" id="unitPrice" value="{{ $product->effective_price }}">

                    <!-- Name -->
                    <div>
                        <label class="text-xs font-bold text-slate-800 block mb-1">আপনার পূর্ণ নাম (Full Name) *</label>
                        <input type="text" name="customer_name" required placeholder="যেমন: আয়েশা রহমান" value="{{ old('customer_name') }}" class="w-full text-sm rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500" />
                    </div>

                    <!-- Phone -->
                    <div>
                        <label class="text-xs font-bold text-slate-800 block mb-1">মোবাইল নাম্বার (Mobile Number) *</label>
                        <input type="tel" name="customer_phone" required placeholder="017XXXXXXXX" value="{{ old('customer_phone') }}" class="w-full text-sm rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500" />
                        <span class="text-[11px] text-slate-400">এই নাম্বারে কল করে অর্ডারটি নিশ্চিত করা হবে।</span>
                    </div>

                    <!-- Delivery Zone -->
                    <div>
                        <label class="text-xs font-bold text-slate-800 block mb-1">ডেলিভারি এলাকা নির্বাচন করুন *</label>
                        <select name="delivery_zone" id="deliveryZone" onchange="calculateTotal()" class="w-full text-sm rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500">
                            <option value="inside_dhaka" data-fee="60">ঢাকার ভেতর (হোম ডেলিভারি) - ৳৬০</option>
                            <option value="sub_dhaka" data-fee="100">ঢাকার আশপাশে (গাজীপুর/সাভার/কেরানীগঞ্জ) - ৳১০০</option>
                            <option value="outside_dhaka" data-fee="130">ঢাকার বাইরে সারা বাংলাদেশে - ৳১৩০</option>
                        </select>
                    </div>

                    <!-- Address -->
                    <div>
                        <label class="text-xs font-bold text-slate-800 block mb-1">সম্পূর্ণ ঠিকানা (Full Address) *</label>
                        <textarea name="delivery_address" required rows="2" placeholder="বাড়ি নং, রোড নং, এলাকা ও থানার নাম লিখুন" class="w-full text-sm rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500">{{ old('delivery_address') }}</textarea>
                    </div>

                    <!-- Quantity -->
                    <div>
                        <label class="text-xs font-bold text-slate-800 block mb-1">পরিমাণ (Quantity)</label>
                        <div class="flex items-center gap-3">
                            <button type="button" onclick="changeQty(-1)" class="w-9 h-9 rounded-lg bg-slate-100 hover:bg-slate-200 font-bold text-sm flex items-center justify-center">-</button>
                            <input type="number" name="quantity" id="quantityInput" value="1" min="1" readonly class="w-16 text-center font-bold text-sm rounded-lg border-slate-300" />
                            <button type="button" onclick="changeQty(1)" class="w-9 h-9 rounded-lg bg-slate-100 hover:bg-slate-200 font-bold text-sm flex items-center justify-center">+</button>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div>
                        <label class="text-xs font-bold text-slate-800 block mb-1">পেমেন্ট মেথড</label>
                        <div class="grid grid-cols-2 gap-2 text-xs">
                            <label class="flex items-center gap-2 p-2.5 rounded-lg border border-emerald-500 bg-emerald-50/40 cursor-pointer font-bold text-slate-800">
                                <input type="radio" name="payment_method" value="cod" checked class="text-emerald-600 focus:ring-emerald-500" />
                                <span>ক্যাশ অন ডেলিভারি</span>
                            </label>
                            <label class="flex items-center gap-2 p-2.5 rounded-lg border border-slate-200 cursor-pointer text-slate-700">
                                <input type="radio" name="payment_method" value="bkash" class="text-emerald-600 focus:ring-emerald-500" />
                                <span>বিকাশ / নগদ</span>
                            </label>
                        </div>
                    </div>

                    <!-- Live Breakdown Summary -->
                    <div class="p-3 bg-slate-50 rounded-xl space-y-1.5 text-xs text-slate-600 border border-slate-200">
                        <div class="flex justify-between">
                            <span>পণ্যের মূল্য:</span>
                            <span id="subtotalDisplay">৳{{ number_format($product->effective_price, 0) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>কুরিয়ার চার্জ:</span>
                            <span id="deliveryDisplay">৳৬০</span>
                        </div>
                        <div class="flex justify-between font-extrabold text-sm text-emerald-800 pt-1 border-t border-slate-200">
                            <span>সর্বমোট প্রদেয়:</span>
                            <span id="grandTotalDisplay">৳{{ number_format($product->effective_price + 60, 0) }}</span>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-black rounded-xl shadow-lg shadow-emerald-600/30 transition text-base flex items-center justify-center gap-2">
                        <span>অর্ডার সম্পন্ন করুন (ক্যাশ অন ডেলিভারি)</span>
                    </button>
                </form>

            </div>

        </div>

    </div>
</div>

<script>
    function changeQty(diff) {
        let input = document.getElementById('quantityInput');
        let current = parseInt(input.value) || 1;
        let newQty = Math.max(1, current + diff);
        input.value = newQty;
        calculateTotal();
    }

    function calculateTotal() {
        let unitPrice = parseFloat(document.getElementById('unitPrice').value) || 0;
        let qty = parseInt(document.getElementById('quantityInput').value) || 1;
        let subtotal = unitPrice * qty;

        let zoneSelect = document.getElementById('deliveryZone');
        let selectedOption = zoneSelect.options[zoneSelect.selectedIndex];
        let deliveryFee = parseFloat(selectedOption.getAttribute('data-fee')) || 60;

        let total = subtotal + deliveryFee;

        document.getElementById('subtotalDisplay').innerText = '৳' + subtotal.toLocaleString();
        document.getElementById('deliveryDisplay').innerText = '৳' + deliveryFee.toLocaleString();
        document.getElementById('grandTotalDisplay').innerText = '৳' + total.toLocaleString();
    }
</script>

@endsection
