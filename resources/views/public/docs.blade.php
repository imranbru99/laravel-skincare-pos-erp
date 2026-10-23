@extends('layouts.public')

@section('title', 'ডকুমেন্টেশন ও আর্কিটেকচার গাইড - Glow & Care')

@section('content')

<div class="py-16 bg-slate-50 min-h-screen">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        
        <div class="space-y-3">
            <span class="text-xs bg-emerald-100 text-emerald-800 font-bold px-3 py-1 rounded-full uppercase">Architecture Guide</span>
            <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">সিস্টেম আর্কিটেকচার ও প্যাকেজ গাইড</h1>
            <p class="text-sm text-slate-600 bn-font leading-relaxed">
                এই প্ল্যাটফর্মটি আধুনিক Laravel 11 এবং Filament v3 এর উপর নির্মিত। এতে ৭টি শক্তিশালী স্পেশালাইজড প্যাকেজ সমন্বিত রয়েছে।
            </p>
        </div>

        <div class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm space-y-8">
            
            <!-- Packages Table -->
            <div>
                <h2 class="text-xl font-bold text-slate-900 mb-4">১. ব্যবহৃত কোর প্যাকেজসমূহ ও তাদের ভূমিকা</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="bg-slate-100 text-slate-700">
                                <th class="p-3 border">Package</th>
                                <th class="p-3 border">Layer</th>
                                <th class="p-3 border">Description & Capability</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            <tr>
                                <td class="p-3 border font-mono font-bold text-emerald-700">imrandevbd/drutogoti</td>
                                <td class="p-3 border font-semibold">Speed & Cache</td>
                                <td class="p-3 border">কোয়েরি অপ্টিমাইজেশন, N+1 ডিটেকশন, বেন্চমার্কিং এবং রুট/কনফিগ ক্যাশিং।</td>
                            </tr>
                            <tr>
                                <td class="p-3 border font-mono font-bold text-emerald-700">imrandevbd/laravel-admin-panel</td>
                                <td class="p-3 border font-semibold">Admin UI</td>
                                <td class="p-3 border">ড্যাশবোর্ড উইজেটস, আরব্যাক পারমিশন এবং অ্যাডমিন মেট্রিক্স।</td>
                            </tr>
                            <tr>
                                <td class="p-3 border font-mono font-bold text-emerald-700">imrandevbd/laravel-ai-catalog</td>
                                <td class="p-3 border font-semibold">Catalog Scraper</td>
                                <td class="p-3 border">অনলাইন থেকে প্রোডাক্ট স্পেসিফিকেশন ও কসমেটিকস ক্যাটালগ অটো-স্ক্র্যাপিং।</td>
                            </tr>
                            <tr>
                                <td class="p-3 border font-mono font-bold text-emerald-700">imrandevbd/laravel-ai-hub</td>
                                <td class="p-3 border font-semibold">AI Intelligence</td>
                                <td class="p-3 border">স্কিন টাইপ ডায়াগনোসিস, অ্যাক্টিভ উপাদান নিরাপত্তা অ্যানালাইজার ও বাংলা কপিরাইটিং।</td>
                            </tr>
                            <tr>
                                <td class="p-3 border font-mono font-bold text-emerald-700">imrandevbd/laravel-attendance-hub</td>
                                <td class="p-3 border font-semibold">Biometrics</td>
                                <td class="p-3 border">ZKTeco ও ফিঙ্গারপ্রিন্ট মেশিনের মাধ্যমে মাল্টি-ব্রাঞ্চ স্টাফদের উপস্থিতি ট্র্যাকিং।</td>
                            </tr>
                            <tr>
                                <td class="p-3 border font-mono font-bold text-emerald-700">imrandevbd/laravel-unicode-pdf</td>
                                <td class="p-3 border font-semibold">Bangla PDF</td>
                                <td class="p-3 border">খাঁটি বাংলা ইউনিকোড ফন্টে ট্যাক্স চালান, ৮০মিমি থার্মাল রসিদ ও আন্তঃশাখা চালান মুদ্রণ।</td>
                            </tr>
                            <tr>
                                <td class="p-3 border font-mono font-bold text-emerald-700">imrandevbd/laravel-universal-slug</td>
                                <td class="p-3 border font-semibold">Multilingual Slugs</td>
                                <td class="p-3 border">বাংলা ও ইংরেজি উভয় ভাষায় এসইও-বান্ধব পারমালিংক বা স্ল্যাগ জেনারেশন।</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Artisan Commands -->
            <div>
                <h2 class="text-xl font-bold text-slate-900 mb-3">২. প্রয়োজনীয় আর্টিসান কমান্ডসমূহ</h2>
                <div class="bg-slate-900 text-emerald-400 p-4 rounded-xl font-mono text-xs space-y-2 overflow-x-auto">
                    <div># স্পিড ও কোয়েরি পারফরম্যান্স চেক</div>
                    <div>php artisan drutogoti:diagnose</div>
                    <div>php artisan drutogoti:benchmark</div>
                    <div><br># হাজিরা মেশিন ডিভাইস সিঙ্ক</div>
                    <div>php artisan attendance:catalog</div>
                    <div>php artisan attendance:simulate --count=20</div>
                    <div><br># এআই ক্যাটালগ ও ইউনিকোড পিডিএফ ক্যাশ ক্লিয়ার</div>
                    <div>php artisan unicode-pdf:diagnose</div>
                    <div>php artisan slug:audit</div>
                </div>
            </div>

            <!-- Steadfast Courier Integration -->
            <div>
                <h2 class="text-xl font-bold text-slate-900 mb-3">৩. স্টেডফাস্ট কুরিয়ার কনফিগারেশন (.env)</h2>
                <div class="bg-slate-900 text-emerald-400 p-4 rounded-xl font-mono text-xs space-y-1 overflow-x-auto">
                    <div>STEADFAST_API_KEY=your_portal_api_key</div>
                    <div>STEADFAST_SECRET_KEY=your_portal_secret_key</div>
                    <div>STEADFAST_BASE_URL=https://portal.steadfast.com.bd/api/v1</div>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection
