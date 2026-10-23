@extends('layouts.public')

@section('title', 'অর্ডার সফলভাবে সম্পন্ন হয়েছে - Glow & Care')

@section('content')

<div class="py-16 bg-slate-50 min-h-screen flex items-center justify-center">
    <div class="max-w-2xl w-full mx-4 bg-white p-8 sm:p-10 rounded-2xl border border-slate-200 shadow-xl text-center space-y-6">
        
        <div class="w-20 h-20 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center text-4xl mx-auto shadow-inner">
            ✓
        </div>

        <div>
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full">Order Successful</span>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 mt-2">ধন্যবাদ, আপনার অর্ডারটি সফলভাবে গ্রহণ করা হয়েছে!</h1>
            <p class="text-sm text-slate-500 bn-font mt-1">
                আমাদের কাস্টমার রিলেশন প্রতিনিধি শীঘ্রই আপনার নাম্বারে কল করে অর্ডারটি কনফার্ম করবেন।
            </p>
        </div>

        <!-- Order Box -->
        <div class="bg-slate-50 p-5 rounded-xl border border-slate-200 text-left space-y-3 text-xs sm:text-sm">
            <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                <span class="text-slate-500">অর্ডার ট্র্যাকিং নাম্বার:</span>
                <span class="font-extrabold text-emerald-700 font-mono text-base">{{ $order->order_number }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-slate-500">গ্রাহকের নাম:</span>
                <span class="font-bold text-slate-800">{{ $order->customer_name }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-slate-500">মোবাইল নাম্বার:</span>
                <span class="font-bold text-slate-800">{{ $order->customer_phone }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-slate-500">ডেলিভারি ঠিকানা:</span>
                <span class="font-bold text-slate-800">{{ $order->delivery_address }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-slate-500">পেমেন্ট মেথড:</span>
                <span class="font-bold text-slate-800 uppercase">{{ $order->payment_method }} ({{ $order->payment_status }})</span>
            </div>
            <div class="flex justify-between items-center pt-2 border-t border-slate-200 text-base font-extrabold text-slate-900">
                <span>সর্বমোট প্রদেয়:</span>
                <span class="text-emerald-700">৳{{ number_format($order->total_amount, 2) }}</span>
            </div>
        </div>

        <!-- Ordered Items -->
        <div class="text-left">
            <div class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">অর্ডারকৃত আইটেম:</div>
            <div class="space-y-2">
                @foreach($order->items as $item)
                    <div class="p-3 bg-white border border-slate-200 rounded-lg flex justify-between items-center text-xs">
                        <div>
                            <span class="font-bold text-slate-800">{{ $item->product_name }}</span>
                            <span class="text-slate-400 block text-[11px]">{{ $item->quantity }} টি x ৳{{ number_format($item->unit_price, 0) }}</span>
                        </div>
                        <span class="font-bold text-slate-900">৳{{ number_format($item->total_price, 0) }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="pt-4 flex flex-wrap gap-4 justify-center">
            <a href="{{ route('order.pdf.invoice', $order) }}" target="_blank" class="px-6 py-3 bg-slate-900 hover:bg-slate-800 text-white font-bold rounded-xl text-sm transition flex items-center gap-2 shadow-sm">
                <span>📄 বাংলা ইনভয়েস / চালান ডাউনলোড করুন (PDF)</span>
            </a>
            <a href="{{ route('home') }}" class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl text-sm transition">
                হোমপেজে ফিরে যান
            </a>
        </div>

    </div>
</div>

@endsection
