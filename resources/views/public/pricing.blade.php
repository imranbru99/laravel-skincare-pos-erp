@extends('layouts.public')

@section('title', 'মূল্য তালিকা ও প্যাকেজসমূহ - Glow & Care')

@section('content')

<div class="py-16 bg-slate-50 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
        <div class="text-center space-y-3 max-w-3xl mx-auto">
            <span class="text-emerald-700 bg-emerald-100 text-xs font-bold px-3.5 py-1.5 rounded-full inline-block">
                Transparent BD Pricing
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-slate-900 tracking-tight">
                আপনার ব্যবসার সাইজ অনুযায়ী সেরা প্যাকেজ বেছে নিন
            </h1>
            <p class="text-slate-600 bn-font text-base">
                কোনো হিডেন চার্জ নেই। প্রতি প্যাকেজেই স্টেডফাস্ট কুরিয়ার এপিআই, বাংলা ইনভয়েস এবং নিয়মিত সফটওয়্যার আপডেট অন্তর্ভুক্ত।
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
            
            <!-- Tier 1: Starter -->
            <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between">
                <div class="space-y-4">
                    <span class="text-xs bg-slate-100 text-slate-700 font-bold px-3 py-1 rounded-full uppercase">অনলাইন স্টার্টার</span>
                    <h3 class="text-xl font-extrabold text-slate-900">ডিটুসি ও ফেসবুক পেজ</h3>
                    <p class="text-xs text-slate-500 bn-font">সোশ্যাল মিডিয়া স্কিনকেয়ার পেজ ও সিঙ্গেল আউটলেটের জন্য।</p>
                    <div class="pt-4 border-t border-slate-100">
                        <span class="text-4xl font-black text-slate-900">৳২,৫০০</span>
                        <span class="text-xs text-slate-500">/ প্রতি মাস</span>
                    </div>

                    <ul class="space-y-2.5 text-xs text-slate-600 bn-font pt-2">
                        <li class="flex items-center gap-2">✓ ১টি সেন্ট্রাল শপ / ওয়্যারহাউস</li>
                        <li class="flex items-center gap-2">✓ আনলিমিটেড হাই-কনভার্টিং ল্যান্ডিং পেজ</li>
                        <li class="flex items-center gap-2">✓ স্টেডফাস্ট ও পাঠাও অটো-কুরিয়ার এপিআই</li>
                        <li class="flex items-center gap-2">✓ বাংলা পিডিএফ ইনভয়েস ও ক্যাশ মেমো</li>
                        <li class="flex items-center gap-2">✓ বিকাশ / নগদ ম্যানুয়াল ও অটো গেটওয়ে</li>
                    </ul>
                </div>

                <div class="mt-8">
                    <a href="{{ route('demo') }}" class="w-full py-3 bg-slate-900 hover:bg-slate-800 text-white font-bold rounded-xl text-xs flex items-center justify-center transition">
                        ডেমো ট্রায়াল শুরু করুন &rarr;
                    </a>
                </div>
            </div>

            <!-- Tier 2: Pro Multi-Branch (Recommended) -->
            <div class="bg-white p-8 rounded-2xl border-2 border-emerald-500 shadow-xl relative flex flex-col justify-between">
                <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 bg-emerald-600 text-white text-[11px] font-bold px-4 py-1 rounded-full uppercase tracking-wider">
                    সবচেয়ে জনপ্রিয় (Most Popular)
                </div>

                <div class="space-y-4">
                    <span class="text-xs bg-emerald-100 text-emerald-800 font-bold px-3 py-1 rounded-full uppercase">রিটেল শোরুম চেইন</span>
                    <h3 class="text-xl font-extrabold text-slate-900">মাল্টি-ব্রাঞ্চ গ্রোথ</h3>
                    <p class="text-xs text-slate-500 bn-font">ঢাকা ও বিভিন্ন জেলার ফিজিক্যাল শোরুম ও অনলাইন ব্যবসার জন্য।</p>
                    <div class="pt-4 border-t border-slate-100">
                        <span class="text-4xl font-black text-emerald-700">৳৫,৫০০</span>
                        <span class="text-xs text-slate-500">/ প্রতি মাস</span>
                    </div>

                    <ul class="space-y-2.5 text-xs text-slate-700 bn-font pt-2">
                        <li class="flex items-center gap-2 font-bold text-emerald-800">✓ স্টারটার প্যাকেজের সব ফিচার</li>
                        <li class="flex items-center gap-2">✓ ৩টি শোরুম ব্রাঞ্চ + ১টি সেন্ট্রাল ওয়্যারহাউস</li>
                        <li class="flex items-center gap-2">✓ টাচস্ক্রিন পিওএস (POS) ও ৮০মিমি রসিদ প্রিন্টিং</li>
                        <li class="flex items-center gap-2">✓ আন্তঃশাখা স্টক রিকুইজিশন ও চালান ট্র্যাকিং</li>
                        <li class="flex items-center gap-2">✓ ব্যাচ নাম্বার ও এক্সপায়ারি অ্যালার্ট ট্র্যাকিং</li>
                        <li class="flex items-center gap-2">✓ এআই স্কিনকেয়ার রুটিন কনসালট্যান্ট হাব</li>
                        <li class="flex items-center gap-2">✓ শোরুম বায়োমেট্রিক হাজিরা মেশিন সিঙ্ক</li>
                    </ul>
                </div>

                <div class="mt-8">
                    <a href="{{ route('demo') }}" class="w-full py-3.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl text-sm flex items-center justify-center transition shadow-lg shadow-emerald-600/30">
                        প্যাকেজটি বেছে নিন &rarr;
                    </a>
                </div>
            </div>

            <!-- Tier 3: Enterprise -->
            <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between">
                <div class="space-y-4">
                    <span class="text-xs bg-purple-100 text-purple-800 font-bold px-3 py-1 rounded-full uppercase">আমদানিকারক ও ক্লিনিক</span>
                    <h3 class="text-xl font-extrabold text-slate-900">এন্টারপ্রাইজ কর্পোরেট</h3>
                    <p class="text-xs text-slate-500 bn-font">কসমেটিকস হোলসেলার, বিএসটিআই আমদানিকারক ও স্কিন ক্লিনিক।</p>
                    <div class="pt-4 border-t border-slate-100">
                        <span class="text-4xl font-black text-slate-900">৳১০,৫০০</span>
                        <span class="text-xs text-slate-500">/ প্রতি মাস</span>
                    </div>

                    <ul class="space-y-2.5 text-xs text-slate-600 bn-font pt-2">
                        <li class="flex items-center gap-2 font-bold text-slate-800">✓ মাল্টি-ব্রাঞ্চ প্যাকেজের সব ফিচার</li>
                        <li class="flex items-center gap-2">✓ আনলিমিটেড ব্রাঞ্চ ও ওয়্যারহাউস</li>
                        <li class="flex items-center gap-2">✓ ডার্মাটোলজিস্ট অ্যাপয়েন্টমেন্ট ও প্রেসক্রিপশন</li>
                        <li class="flex items-center gap-2">✓ পাইকারি ডিলার পোর্টাল ও ক্রেডিট লিমিট</li>
                        <li class="flex items-center gap-2">✓ কাস্টম ডোমেইন ও নিজস্ব এসএমএস গেটওয়ে</li>
                        <li class="flex items-center gap-2">✓ ২৪/৭ ডেডিকেটেড ভিআইপি সাপোর্ট</li>
                    </ul>
                </div>

                <div class="mt-8">
                    <a href="{{ route('contact') }}" class="w-full py-3 bg-slate-900 hover:bg-slate-800 text-white font-bold rounded-xl text-xs flex items-center justify-center transition">
                        যোগাযোগ করুন &rarr;
                    </a>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection
