@extends('layouts.public')

@section('title', 'সিস্টেমের পূর্ণাঙ্গ ফিচারসমূহ - Glow & Care Skincare Business Suite')

@section('content')

<!-- Header -->
<div class="bg-slate-900 text-white py-16 text-center">
    <div class="max-w-4xl mx-auto px-4 space-y-3">
        <span class="text-emerald-400 font-bold text-xs uppercase tracking-widest">Enterprise Architecture</span>
        <h1 class="text-3xl sm:text-5xl font-black tracking-tight">সব ধরনের স্কিনকেয়ার ব্যবসার পূর্ণাঙ্গ সমাধান</h1>
        <p class="text-slate-300 bn-font text-base max-w-2xl mx-auto">
            আপনার প্রয়োজন অনুসারে প্রতিটি মডিউল অন বা অফ করতে পারবেন। অনলাইন স্টোর, শোরুম পিওএস, ক্লিনিকে অ্যাপয়েন্টমেন্ট বা পাইকারি ডিলারশিপ—সকলের জন্য উপযোগী।
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-16">

    <!-- Section 1: Multi-Branch & Stock -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div class="space-y-4">
            <span class="text-xs bg-emerald-100 text-emerald-800 font-bold px-3 py-1 rounded-full uppercase">Module 01</span>
            <h2 class="text-3xl font-extrabold text-slate-900">মাল্টি-ব্রাঞ্চ শোরুম ও সেন্ট্রাল ওয়্যারহাউস</h2>
            <p class="text-slate-600 bn-font text-base leading-relaxed">
                আপনার ঢাকা বনানী, ধানমন্ডি, চট্টগ্রাম বা সিলেটের সকল আউটলেটের স্টক এক জায়গা থেকে মনিটর করুন।
            </p>
            <ul class="space-y-2 text-sm text-slate-700 bn-font">
                <li class="flex items-center gap-2">✓ সেন্ট্রাল গুদাম থেকে শোরুমে স্টক রিকুইজিশন ও চালান স্থানান্তর</li>
                <li class="flex items-center gap-2">✓ শাখা ভিত্তিক সেলস ও রেভিনিউ রিপোর্ট</li>
                <li class="flex items-center gap-2">✓ কোনো শাখায় পণ্য শেষ হয়ে আসলে স্বয়ংক্রিয় লো-স্টক অ্যালার্ট</li>
            </ul>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100 text-xs font-bold text-slate-500">
                <span>শাখা ভিত্তিক লাইভ স্টক</span>
                <span class="text-emerald-600">রিয়েল-টাইম সিঙ্ক</span>
            </div>
            <div class="divide-y divide-slate-100 text-xs mt-3">
                <div class="py-2.5 flex justify-between">
                    <span>সেন্ট্রাল ওয়্যারহাউস (তেজগাঁও)</span>
                    <span class="font-bold text-slate-800">২,৪৫০ পিস</span>
                </div>
                <div class="py-2.5 flex justify-between">
                    <span>বনানী ১১ ফ্ল্যাগশিপ শোরুম</span>
                    <span class="font-bold text-slate-800">৩৮০ পিস</span>
                </div>
                <div class="py-2.5 flex justify-between">
                    <span>ধানমন্ডি সীমান্ত স্কয়ার শোরুম</span>
                    <span class="font-bold text-slate-800">২৯০ পিস</span>
                </div>
                <div class="py-2.5 flex justify-between">
                    <span>চট্টগ্রাম সানমার শোরুম</span>
                    <span class="font-bold text-slate-800">১৯৫ পিস</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 2: Touchscreen POS & Cash Register -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div class="order-2 lg:order-1 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <div class="text-xs text-emerald-600 font-bold mb-1">কাউন্টার সেলস টার্মিনাল</div>
            <div class="text-lg font-bold text-slate-900 mb-4">৮০মিমি বাংলা থার্মাল রসিদ প্রিন্টিং</div>
            <div class="bg-slate-50 p-4 rounded-xl text-xs font-mono border border-slate-200 space-y-1">
                <div class="text-center font-bold">GLOW & CARE SKINCARE</div>
                <div class="text-center">বনানী শাখা, ঢাকা</div>
                <div class="border-b border-dashed border-slate-300 py-1"></div>
                <div class="flex justify-between py-1">
                    <span>রসিদ নং: POS-261023-A41</span>
                    <span>ক্যাশ কাউন্টার ০১</span>
                </div>
                <div class="border-b border-dashed border-slate-300 py-1"></div>
                <div class="flex justify-between">
                    <span>COSRX Snail 96 (১টি)</span>
                    <span>৳১,৮৫০</span>
                </div>
                <div class="flex justify-between font-bold text-emerald-700 pt-1">
                    <span>মোট পরিশোধ (বিকাশ):</span>
                    <span>৳১,৮৫০</span>
                </div>
            </div>
        </div>
        <div class="order-1 lg:order-2 space-y-4">
            <span class="text-xs bg-blue-100 text-blue-800 font-bold px-3 py-1 rounded-full uppercase">Module 02</span>
            <h2 class="text-3xl font-extrabold text-slate-900">টাচস্ক্রিন পিওএস (POS) ও ক্যাশ রেজিস্টার</h2>
            <p class="text-slate-600 bn-font text-base leading-relaxed">
                শোরুমের বিক্রয়কর্মীরা এক নিমেষেই বারকোড স্ক্যান করে ক্যাশ, বিকাশ, নগদ বা কার্ডের মাধ্যমে বিক্রয় সম্পন্ন করতে পারবেন।
            </p>
            <ul class="space-y-2 text-sm text-slate-700 bn-font">
                <li class="flex items-center gap-2">✓ ক্যাশ ড্রয়ার খোলার ও বন্ধের প্রতিদিনের ব্যালেন্স মেলানো</li>
                <li class="flex items-center gap-2">✓ ওয়াক-ইন কাস্টমার ও নিয়মিত গ্রাহকের লয়্যালটি পয়েন্ট গণনা</li>
                <li class="flex items-center gap-2">✓ ১০০% বাংলা ইউনিকোড সমৃদ্ধ থার্মাল স্লিপ প্রিন্ট</li>
            </ul>
        </div>
    </div>

    <!-- Section 3: Couriers & Logistics -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div class="space-y-4">
            <span class="text-xs bg-purple-100 text-purple-800 font-bold px-3 py-1 rounded-full uppercase">Module 03</span>
            <h2 class="text-3xl font-extrabold text-slate-900">স্টেডফাস্ট ও পাঠাও অটো-কুরিয়ার এপিআই</h2>
            <p class="text-slate-600 bn-font text-base leading-relaxed">
                পেন্ডিং অর্ডার এক ক্লিকেই স্টেডফাস্ট কুরিয়ারে পার্সেল বুকিং হয়ে ট্র্যাকিং কোড তৈরি হয়ে যায়। ডেলিভারি সম্পন্ন হলে স্বয়ংক্রিয়ভাবে ইনভেন্টরি ও ক্যাশ হিসাব আপডেট হয়।
            </p>
            <ul class="space-y-2 text-sm text-slate-700 bn-font">
                <li class="flex items-center gap-2">✓ ঢাকা ভেতরে ৬০৳, সাব-ঢাকা ১০০৳ এবং ঢাকার বাইরে ১৩০৳ অটো ক্যালকুলেশন</li>
                <li class="flex items-center gap-2">✓ আরটিও (RTO / Return) রিটার্ন পার্সেলের সহজ ইনভেন্টরি রিভার্সাল</li>
                <li class="flex items-center gap-2">✓ কাস্টমারকে এসএমএসের মাধ্যমে লাইভ ট্র্যাকিং লিংক প্রদান</li>
            </ul>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-3">
            <div class="flex items-center justify-between text-xs font-bold text-slate-500">
                <span>Steadfast API Live Bridge</span>
                <span class="text-emerald-600">Connected</span>
            </div>
            <div class="p-3 bg-emerald-50 rounded-xl border border-emerald-100 flex items-center justify-between">
                <div>
                    <div class="font-bold text-xs text-emerald-900">Consignment: #SF92841029</div>
                    <div class="text-[11px] text-emerald-700">কাস্টমার: ফারিয়া ইসলাম (ধানমন্ডি)</div>
                </div>
                <span class="text-xs bg-emerald-200 text-emerald-900 font-bold px-2 py-0.5 rounded">In Transit</span>
            </div>
            <div class="text-[11px] text-slate-400">স্বয়ংক্রিয়ভাবে পাঠাও ও রেডএক্স এপিআই সমর্থন করে।</div>
        </div>
    </div>

    <!-- Section 4: AI & Unicode PDF -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div class="order-2 lg:order-1 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-3">
            <div class="text-xs font-bold text-indigo-600">AI Skincare Engine & Unicode PDF</div>
            <div class="text-sm font-bold text-slate-800">প্যাকেজ ইন্টিগ্রেশন সমূহ:</div>
            <div class="grid grid-cols-2 gap-2 text-xs">
                <div class="p-2.5 rounded-lg bg-slate-50 border border-slate-100">
                    <span class="font-bold block">drutogoti</span>
                    <span class="text-slate-500 text-[10px]">স্পিড ও কুয়েরি অপ্টিমাইজেশন</span>
                </div>
                <div class="p-2.5 rounded-lg bg-slate-50 border border-slate-100">
                    <span class="font-bold block">laravel-unicode-pdf</span>
                    <span class="text-slate-500 text-[10px]">খাঁটি বাংলা চালান ও ভ্যাট</span>
                </div>
                <div class="p-2.5 rounded-lg bg-slate-50 border border-slate-100">
                    <span class="font-bold block">laravel-ai-hub</span>
                    <span class="text-slate-500 text-[10px]">স্কিন রুটিন কনসালট্যান্ট</span>
                </div>
                <div class="p-2.5 rounded-lg bg-slate-50 border border-slate-100">
                    <span class="font-bold block">laravel-attendance-hub</span>
                    <span class="text-slate-500 text-[10px]">বায়োমেট্রিক হাজিরা মেশিন</span>
                </div>
            </div>
        </div>
        <div class="order-1 lg:order-2 space-y-4">
            <span class="text-xs bg-indigo-100 text-indigo-800 font-bold px-3 py-1 rounded-full uppercase">Module 04</span>
            <h2 class="text-3xl font-extrabold text-slate-900">স্মার্ট এআই এবং বাংলা ইউনিকোড ইঞ্জিন</h2>
            <p class="text-slate-600 bn-font text-base leading-relaxed">
                পণ্য এন্ট্রি করলেই এআই স্বয়ংক্রিয়ভাবে বাংলায় প্রোডাক্টের উপকারিতা, ব্যবহারের নিয়ম লিখে দেয় এবং গ্রাহকের ত্বকের ধরন অনুযায়ী সঠিক রুটিন সাজিয়ে দেয়।
            </p>
        </div>
    </div>

</div>

<!-- CTA -->
<div class="bg-emerald-900 text-white py-16 text-center">
    <div class="max-w-3xl mx-auto px-4 space-y-4">
        <h2 class="text-3xl font-black">আপনার স্কিনকেয়ার ব্র্যান্ডের জন্য সেরা প্ল্যাটফর্ম</h2>
        <p class="text-emerald-200 bn-font text-base">
            এখনই লাইভ ডেমো অ্যাডমিন প্যানেলে লগইন করে প্রতিটি ফিচার নিজেই ব্যবহার করে দেখুন।
        </p>
        <div class="pt-2">
            <a href="{{ route('demo') }}" class="px-8 py-3.5 bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-black rounded-xl shadow-lg transition inline-flex items-center gap-2">
                <span>🚀 ডেমো প্যানেলে প্রবেশ করুন</span>
            </a>
        </div>
    </div>
</div>

@endsection
