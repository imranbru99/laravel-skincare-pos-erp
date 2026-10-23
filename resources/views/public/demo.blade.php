@extends('layouts.public')

@section('title', 'লাইভ ডেমো অ্যাক্সেস ও টেস্ট অ্যাকাউন্টস - Glow & Care')

@section('content')

<div class="py-16 bg-slate-50 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
        <div class="text-center space-y-3 max-w-3xl mx-auto">
            <span class="text-emerald-700 bg-emerald-100 text-xs font-bold px-3.5 py-1.5 rounded-full inline-block">
                🚀 ১-ক্লিকেই ইনস্ট্যান্ট লগইন
            </span>
            <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                বিভিন্ন রোল অনুযায়ী সিস্টেমের কার্যকারিতা পরীক্ষা করুন
            </h1>
            <p class="text-slate-600 bn-font text-base">
                পাসওয়ার্ড টাইপ করার প্রয়োজন নেই। নিচের যেকোনো রোলের বাটনে ক্লিক করলেই সরাসরি সেই প্রোফাইলের ড্যাশবোর্ডে প্রবেশ করবেন।
            </p>
        </div>

        <!-- 6 Personas Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <!-- Persona 1: Super Admin -->
            <div class="bg-white p-6 rounded-2xl border-2 border-emerald-500 shadow-md flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-2xl">👑</span>
                        <span class="text-[11px] bg-emerald-100 text-emerald-800 font-bold px-2 py-0.5 rounded">Full System Access</span>
                    </div>
                    <h3 class="font-extrabold text-lg text-slate-900">সুপার অ্যাডমিন (Super Admin)</h3>
                    <p class="text-xs text-slate-500 bn-font mt-1">
                        সকল শাখা, স্টক, মডিউল অন/অফ কন্ট্রোল, লাভ-ক্ষতির হিসাব এবং সার্বিক সিস্টেম কনফিগারেশন।
                    </p>
                    <div class="mt-4 p-3 bg-slate-50 rounded-xl text-xs font-mono space-y-1 border border-slate-100">
                        <div>ইমেইল: <span class="font-bold text-slate-800">superadmin@skincare.com</span></div>
                        <div>পাসওয়ার্ড: <span class="font-bold text-slate-800">password123</span></div>
                    </div>
                </div>

                <div class="mt-6">
                    <a href="{{ route('demo.login', 'super_admin') }}" class="w-full py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl text-xs flex items-center justify-center gap-2 transition shadow-sm">
                        <span>১-ক্লিকে সুপার অ্যাডমিন লগইন &rarr;</span>
                    </a>
                </div>
            </div>

            <!-- Persona 2: Branch Manager -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:border-emerald-500 transition flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-2xl">🏬</span>
                        <span class="text-[11px] bg-blue-100 text-blue-800 font-bold px-2 py-0.5 rounded">Banani Flagship Branch</span>
                    </div>
                    <h3 class="font-extrabold text-lg text-slate-900">শাখা ইনচার্জ (Branch Manager)</h3>
                    <p class="text-xs text-slate-500 bn-font mt-1">
                        বনানী শোরুমের অভ্যন্তরীণ স্টক ব্যবস্থাপনা, কেন্দ্রীয় গুদাম থেকে রিকুইজিশন এবং স্টাফ উপস্থিতি।
                    </p>
                    <div class="mt-4 p-3 bg-slate-50 rounded-xl text-xs font-mono space-y-1 border border-slate-100">
                        <div>ইমেইল: <span class="font-bold text-slate-800">banani.manager@skincare.com</span></div>
                        <div>পাসওয়ার্ড: <span class="font-bold text-slate-800">password123</span></div>
                    </div>
                </div>

                <div class="mt-6">
                    <a href="{{ route('demo.login', 'branch_manager') }}" class="w-full py-2.5 bg-slate-800 hover:bg-slate-700 text-white font-bold rounded-xl text-xs flex items-center justify-center gap-2 transition">
                        <span>১-ক্লিকে ম্যানেজার লগইন &rarr;</span>
                    </a>
                </div>
            </div>

            <!-- Persona 3: Cashier / POS -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:border-emerald-500 transition flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-2xl">💻</span>
                        <span class="text-[11px] bg-amber-100 text-amber-800 font-bold px-2 py-0.5 rounded">Counter Cashier</span>
                    </div>
                    <h3 class="font-extrabold text-lg text-slate-900">কাউন্টার সেলসম্যান (Cashier)</h3>
                    <p class="text-xs text-slate-500 bn-font mt-1">
                        টাচস্ক্রিন পিওএস, বারকোড স্ক্যানিং, ক্যাশ/বিকাশ পেমেন্ট রিসিভ ও ৮০মিমি থার্মাল রসিদ প্রিন্টিং।
                    </p>
                    <div class="mt-4 p-3 bg-slate-50 rounded-xl text-xs font-mono space-y-1 border border-slate-100">
                        <div>ইমেইল: <span class="font-bold text-slate-800">cashier@skincare.com</span></div>
                        <div>পাসওয়ার্ড: <span class="font-bold text-slate-800">password123</span></div>
                    </div>
                </div>

                <div class="mt-6">
                    <a href="{{ route('demo.login', 'cashier') }}" class="w-full py-2.5 bg-slate-800 hover:bg-slate-700 text-white font-bold rounded-xl text-xs flex items-center justify-center gap-2 transition">
                        <span>১-ক্লিকে ক্যাশিয়ার পিওএস লগইন &rarr;</span>
                    </a>
                </div>
            </div>

            <!-- Persona 4: Fulfillment Officer -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:border-emerald-500 transition flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-2xl">📦</span>
                        <span class="text-[11px] bg-purple-100 text-purple-800 font-bold px-2 py-0.5 rounded">Courier Fulfillment</span>
                    </div>
                    <h3 class="font-extrabold text-lg text-slate-900">ডেলিভারি ইনচার্জ (Courier Lead)</h3>
                    <p class="text-xs text-slate-500 bn-font mt-1">
                        অনলাইন ও ল্যান্ডিং পেজের পেন্ডিং অর্ডার চেক, প্যাকেজিং, এবং স্টেডফাস্ট/পাঠাও এপিআইতে বুকিং।
                    </p>
                    <div class="mt-4 p-3 bg-slate-50 rounded-xl text-xs font-mono space-y-1 border border-slate-100">
                        <div>ইমেইল: <span class="font-bold text-slate-800">delivery@skincare.com</span></div>
                        <div>পাসওয়ার্ড: <span class="font-bold text-slate-800">password123</span></div>
                    </div>
                </div>

                <div class="mt-6">
                    <a href="{{ route('demo.login', 'fulfillment') }}" class="w-full py-2.5 bg-slate-800 hover:bg-slate-700 text-white font-bold rounded-xl text-xs flex items-center justify-center gap-2 transition">
                        <span>১-ক্লিকে ফুলফিলমেন্ট লগইন &rarr;</span>
                    </a>
                </div>
            </div>

            <!-- Persona 5: Dermatologist / Doctor -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:border-emerald-500 transition flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-2xl">👩‍⚕️</span>
                        <span class="text-[11px] bg-rose-100 text-rose-800 font-bold px-2 py-0.5 rounded">Skin Consultant</span>
                    </div>
                    <h3 class="font-extrabold text-lg text-slate-900">ডার্মাটোলজিস্ট (Skin Doctor)</h3>
                    <p class="text-xs text-slate-500 bn-font mt-1">
                        ক্লিনিক অ্যাপয়েন্টমেন্ট শিডিউলিং, ত্বকের সমস্যা বিশ্লেষণ এবং প্রেসক্রিপশনে সঠিক পণ্য রিকমেন্ডেশন।
                    </p>
                    <div class="mt-4 p-3 bg-slate-50 rounded-xl text-xs font-mono space-y-1 border border-slate-100">
                        <div>ইমেইল: <span class="font-bold text-slate-800">doctor@skincare.com</span></div>
                        <div>পাসওয়ার্ড: <span class="font-bold text-slate-800">password123</span></div>
                    </div>
                </div>

                <div class="mt-6">
                    <a href="{{ route('demo.login', 'doctor') }}" class="w-full py-2.5 bg-slate-800 hover:bg-slate-700 text-white font-bold rounded-xl text-xs flex items-center justify-center gap-2 transition">
                        <span>১-ক্লিকে ডাক্তার প্যানেলে লগইন &rarr;</span>
                    </a>
                </div>
            </div>

            <!-- Persona 6: Customer -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:border-emerald-500 transition flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-2xl">🛍️</span>
                        <span class="text-[11px] bg-teal-100 text-teal-800 font-bold px-2 py-0.5 rounded">VIP Customer</span>
                    </div>
                    <h3 class="font-extrabold text-lg text-slate-900">লয়্যাল কাস্টমার (Customer Account)</h3>
                    <p class="text-xs text-slate-500 bn-font mt-1">
                        পূর্বে সম্পন্ন করা অর্ডারের ইতিহাস, অর্জিত লয়্যালটি রিওয়ার্ড পয়েন্ট এবং স্কিন প্রোফাইল।
                    </p>
                    <div class="mt-4 p-3 bg-slate-50 rounded-xl text-xs font-mono space-y-1 border border-slate-100">
                        <div>ইমেইল: <span class="font-bold text-slate-800">customer@skincare.com</span></div>
                        <div>পাসওয়ার্ড: <span class="font-bold text-slate-800">password123</span></div>
                    </div>
                </div>

                <div class="mt-6">
                    <a href="{{ route('shop') }}" class="w-full py-2.5 bg-slate-800 hover:bg-slate-700 text-white font-bold rounded-xl text-xs flex items-center justify-center gap-2 transition">
                        <span>অনলাইন শপ ক্যাটালগ ব্রাউজ করুন &rarr;</span>
                    </a>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection
