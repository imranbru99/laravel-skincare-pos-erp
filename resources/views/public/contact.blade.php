@extends('layouts.public')

@section('title', 'যোগাযোগ ও শোরুম আউটলেট সমূহ - Glow & Care')

@section('content')

<div class="py-16 bg-slate-50 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
        <div class="text-center space-y-3 max-w-3xl mx-auto">
            <span class="text-emerald-700 bg-emerald-100 text-xs font-bold px-3.5 py-1.5 rounded-full inline-block">
                Showrooms & Support
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-slate-900 tracking-tight">
                আমাদের শোরুমসমূহ ও কাস্টমার কেয়ার
            </h1>
            <p class="text-slate-600 bn-font text-base">
                যেকোনো জিজ্ঞাসা, সফটওয়্যার ডেমো বা পণ্য যাচাইয়ের জন্য সরাসরি আমাদের শোরুমে আসুন অথবা কল করুন।
            </p>
        </div>

        <!-- 3 Branch Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-3">
                <span class="text-xs bg-emerald-100 text-emerald-800 font-bold px-2.5 py-0.5 rounded">ঢাকা শোরুম ১</span>
                <h3 class="font-extrabold text-lg text-slate-900">বনানী ফ্ল্যাগশিপ আউটলেট</h3>
                <p class="text-xs text-slate-600 bn-font leading-relaxed">
                    হাউজ ১২, রোড ১১, ব্লক এফ, বনানী, ঢাকা-১২১৩।<br>
                    (বনানী সুপারমার্কেটের বিপরীতে)
                </p>
                <div class="pt-2 text-xs font-mono text-emerald-700 font-bold">
                    হটলাইন: ০১৭১১-১১২২৩৩
                </div>
                <div class="text-[11px] text-slate-400">প্রতিদিন সকাল ১০:০০ - রাত ১০:০০</div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-3">
                <span class="text-xs bg-emerald-100 text-emerald-800 font-bold px-2.5 py-0.5 rounded">ঢাকা শোরুম ২</span>
                <h3 class="font-extrabold text-lg text-slate-900">ধানমন্ডি শোরুম</h3>
                <p class="text-xs text-slate-600 bn-font leading-relaxed">
                    সীমান্ত স্কয়ার (লেভেল ৩, শপ ৩০৫), ধানমন্ডি ২৭, ঢাকা-১২০৯।
                </p>
                <div class="pt-2 text-xs font-mono text-emerald-700 font-bold">
                    হটলাইন: ০১৭২২-৪৪৫৫৬৬
                </div>
                <div class="text-[11px] text-slate-400">প্রতিদিন সকাল ১০:০০ - রাত ১০:০০ (মঙ্গলবার বন্ধ)</div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-3">
                <span class="text-xs bg-emerald-100 text-emerald-800 font-bold px-2.5 py-0.5 rounded">চট্টগ্রাম শোরুম</span>
                <h3 class="font-extrabold text-lg text-slate-900">চট্টগ্রাম সানমার আউটলেট</h3>
                <p class="text-xs text-slate-600 bn-font leading-relaxed">
                    সানমার ওশান সিটি (লেভেল ৪), জিইসি সার্কেল, চট্টগ্রাম।
                </p>
                <div class="pt-2 text-xs font-mono text-emerald-700 font-bold">
                    হটলাইন: ০১৮১১-৭৭৮৮৯৯
                </div>
                <div class="text-[11px] text-slate-400">প্রতিদিন সকাল ১০:০০ - রাত ৯:৩০</div>
            </div>

        </div>

        <!-- Contact Form & WhatsApp Float -->
        <div class="bg-white p-8 sm:p-10 rounded-2xl border border-slate-200 shadow-sm grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
            <div class="space-y-4">
                <h3 class="text-2xl font-black text-slate-900">মেসেজ পাঠান অথবা সরাসরি চ্যাট করুন</h3>
                <p class="text-sm text-slate-600 bn-font leading-relaxed">
                    আমাদের স্কিনকেয়ার বিশেষজ্ঞ টিম এবং টেকনিক্যাল কনসালট্যান্টরা আপনাকে দ্রুত সহায়তা প্রদান করবে।
                </p>

                <div class="pt-2 space-y-2">
                    <a href="https://wa.me/8801700000000" target="_blank" class="inline-flex items-center gap-2 px-5 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold transition shadow-sm">
                        <span>💬 হোয়াটসঅ্যাপে চ্যাট করুন (Direct WhatsApp)</span>
                    </a>
                </div>
            </div>

            <form onsubmit="event.preventDefault(); alert('ধন্যবাদ! আপনার মেসেজটি গৃহীত হয়েছে। আমরা শীঘ্রই যোগাযোগ করবো।');" class="space-y-3">
                <div>
                    <label class="text-xs font-bold text-slate-700 block mb-1">আপনার নাম</label>
                    <input type="text" required placeholder="নাম লিখুন" class="w-full text-xs rounded-xl border-slate-300" />
                </div>
                <div>
                    <label class="text-xs font-bold text-slate-700 block mb-1">মোবাইল নাম্বার</label>
                    <input type="tel" required placeholder="017..." class="w-full text-xs rounded-xl border-slate-300" />
                </div>
                <div>
                    <label class="text-xs font-bold text-slate-700 block mb-1">আপনার বার্তা</label>
                    <textarea rows="3" required placeholder="কী বিষয়ে জানতে চান লিখুন..." class="w-full text-xs rounded-xl border-slate-300"></textarea>
                </div>
                <button type="submit" class="w-full py-3 bg-slate-900 hover:bg-slate-800 text-white font-bold rounded-xl text-xs transition">
                    বার্তা প্রেরণ করুন &rarr;
                </button>
            </form>
        </div>

    </div>
</div>

@endsection
