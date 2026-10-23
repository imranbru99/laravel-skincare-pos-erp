@extends('layouts.public')

@section('title', 'Glow & Care - বাংলাদেশী স্কিনকেয়ার ও কসমেটিকস বিজনেস ইআরপি প্ল্যাটফর্ম')

@section('content')

<!-- Hero Section -->
<section class="relative bg-gradient-to-b from-emerald-50/60 via-white to-slate-50 py-16 lg:py-24 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold bn-font">
                    <span>✨ বাংলাদেশের শীর্ষস্থানীয় স্কিনকেয়ার বিজনেস সফটওয়্যার</span>
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 leading-[1.15] tracking-tight">
                    আপনার স্কিনকেয়ার ব্যবসা পরিচালনা করুন <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-500">এক ক্লিকেই</span>
                </h1>

                <p class="text-base sm:text-lg text-slate-600 bn-font leading-relaxed max-w-2xl">
                    অনলাইন শপ, ফেসবুক ল্যান্ডিং পেজ অর্ডার, মাল্টি-ব্রাঞ্চ শোরুম পিওএস (POS), স্টেডফাস্ট ও পাঠাও অটো-কুরিয়ার বুকিং, এক্সপায়ারি ট্র্যাকিং ও এআই স্কিন অ্যানালাইসিস—সবকিছু এখন একটি পূর্ণাঙ্গ সিস্টেমে।
                </p>

                <!-- CTA Action Buttons -->
                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4 pt-2">
                    <a href="{{ route('demo') }}" class="px-6 py-3.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg shadow-emerald-600/25 transition text-base flex items-center gap-2">
                        <span>🚀 লাইভ ডেমো টেস্ট করুন (1-Click Login)</span>
                    </a>
                    <a href="{{ route('skin-quiz') }}" class="px-6 py-3.5 bg-white hover:bg-slate-50 text-slate-800 border border-slate-300 font-bold rounded-xl shadow-sm transition text-base flex items-center gap-2">
                        <span>✨ অনলাইন স্কিন টেস্ট করুন</span>
                    </a>
                </div>

                <!-- Bangladeshi Highlights -->
                <div class="grid grid-cols-3 gap-4 pt-4 border-t border-slate-200 text-left">
                    <div>
                        <div class="font-extrabold text-xl text-slate-900">১০০% আসল</div>
                        <div class="text-xs text-slate-500 bn-font">বিএসটিআই ও ব্যাচ ট্র্যাকিং</div>
                    </div>
                    <div>
                        <div class="font-extrabold text-xl text-slate-900">মাল্টি-ব্রাঞ্চ</div>
                        <div class="text-xs text-slate-500 bn-font">ঢাকা ও জেলা শোরুম স্টক</div>
                    </div>
                    <div>
                        <div class="font-extrabold text-xl text-slate-900">বাংলা চালান</div>
                        <div class="text-xs text-slate-500 bn-font">ইউনিকোড থার্মাল রসিদ</div>
                    </div>
                </div>
            </div>

            <!-- Hero Right Card / Graphic -->
            <div class="lg:col-span-5 relative">
                <div class="bg-white rounded-2xl shadow-xl border border-slate-200/80 p-6 relative z-10 space-y-5">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span class="font-bold text-sm text-slate-800">সেন্ট্রাল লাইভ হাব (Dhaka Central)</span>
                        </div>
                        <span class="text-xs bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded font-bold">POS Active</span>
                    </div>

                    <!-- Live KPI Cards -->
                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-emerald-50/70 p-3 rounded-xl border border-emerald-100">
                            <div class="text-xs text-emerald-700 font-medium">আজকের বিক্রয় (Today)</div>
                            <div class="text-xl font-black text-emerald-900 mt-1">৳১,৪৭,৫০০</div>
                            <div class="text-[10px] text-emerald-600 mt-0.5">↑ ১৮% গত সপ্তাহের চেয়ে বৃদ্ধি</div>
                        </div>
                        <div class="bg-blue-50/70 p-3 rounded-xl border border-blue-100">
                            <div class="text-xs text-blue-700 font-medium">পেন্ডিং কুরিয়ার পার্সেল</div>
                            <div class="text-xl font-black text-blue-900 mt-1">৮৬ টি</div>
                            <div class="text-[10px] text-blue-600 mt-0.5">Steadfast API Ready</div>
                        </div>
                    </div>

                    <!-- Recent Orders Mini List -->
                    <div>
                        <div class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">সাম্প্রতিক অর্ডার সমূহ</div>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between text-xs p-2 rounded-lg bg-slate-50 border border-slate-100">
                                <div>
                                    <div class="font-bold text-slate-800">তানিয়া রহমান - গুলশান</div>
                                    <div class="text-slate-400 text-[10px]">COSRX Snail Mucin 96 Essence</div>
                                </div>
                                <span class="bg-emerald-100 text-emerald-800 text-[10px] font-bold px-2 py-0.5 rounded">পরিশোধিত</span>
                            </div>
                            <div class="flex items-center justify-between text-xs p-2 rounded-lg bg-slate-50 border border-slate-100">
                                <div>
                                    <div class="font-bold text-slate-800">সুমাইয়া আহমেদ - চট্টগ্রাম</div>
                                    <div class="text-slate-400 text-[10px]">Beauty of Joseon Sunscreen</div>
                                </div>
                                <span class="bg-amber-100 text-amber-800 text-[10px] font-bold px-2 py-0.5 rounded">কুরিয়ারে প্রেরণ</span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Switch CTA -->
                    <a href="{{ route('demo') }}" class="block text-center py-2.5 bg-slate-900 hover:bg-slate-800 text-white rounded-xl text-xs font-bold transition">
                        সব ডেমো অ্যাকাউন্ট পরীক্ষা করুন &rarr;
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 10 Comprehensive Business Features Grid -->
<section class="py-20 bg-white border-y border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto space-y-3 mb-16">
            <span class="text-emerald-600 font-bold text-xs uppercase tracking-widest">End-to-End Features</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                স্কিনকেয়ার ব্যবসার জন্য প্রয়োজনীয় সব ফিচার এক সফটওয়্যারে
            </h2>
            <p class="text-slate-600 bn-font text-base">
                যেকোনো ধরনের স্কিনকেয়ার ব্যবসা—অনলাইন কসমেটিকস পেজ, রিটেল চেইন, পাইকারি আমদানিকারক অথবা স্কিন ক্লিনিক—সকলের জন্য প্রযোজ্য। আপনার প্রয়োজন অনুযায়ী যেকোনো মডিউল অন বা অফ রাখতে পারবেন।
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <!-- Feature 1 -->
            <div class="p-6 rounded-2xl bg-slate-50 hover:bg-emerald-50/40 border border-slate-200 transition space-y-3">
                <div class="w-12 h-12 bg-emerald-100 text-emerald-700 rounded-xl flex items-center justify-center text-2xl font-bold">
                    🏬
                </div>
                <h3 class="text-lg font-bold text-slate-900">মাল্টি-ব্রাঞ্চ ও ওয়্যারহাউস</h3>
                <p class="text-sm text-slate-600 bn-font leading-relaxed">
                    সেন্ট্রাল ওয়্যারহাউস এবং শাখা শোরুমসমূহের (বনানী, ধানমন্ডি, চট্টগ্রাম) স্বতন্ত্র স্টক নিয়ন্ত্রণ, স্টক রিকুইজিশন এবং চালান ট্র্যাকিং।
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="p-6 rounded-2xl bg-slate-50 hover:bg-emerald-50/40 border border-slate-200 transition space-y-3">
                <div class="w-12 h-12 bg-blue-100 text-blue-700 rounded-xl flex items-center justify-center text-2xl font-bold">
                    💻
                </div>
                <h3 class="text-lg font-bold text-slate-900">টাচস্ক্রিন ও বারকোড পিওএস</h3>
                <p class="text-sm text-slate-600 bn-font leading-relaxed">
                    আউটলেটের ক্যাশ কাউন্টারের জন্য দ্রুতগতির পিওএস (POS), বারকোড স্ক্যানার, মাল্টিপল পেমেন্ট স্প্লিট (ক্যাশ, বিকাশ, কার্ড) ও ক্যাশ ড্রয়ার নিয়ন্ত্রণ।
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="p-6 rounded-2xl bg-slate-50 hover:bg-emerald-50/40 border border-slate-200 transition space-y-3">
                <div class="w-12 h-12 bg-amber-100 text-amber-700 rounded-xl flex items-center justify-center text-2xl font-bold">
                    🚀
                </div>
                <h3 class="text-lg font-bold text-slate-900">হাই-কনভার্টিং ল্যান্ডিং পেজ</h3>
                <p class="text-sm text-slate-600 bn-font leading-relaxed">
                    ফেসবুক/টিকটক বিজ্ঞাপনের জন্য স্পেশাল সিঙ্গেল প্রোডাক্ট ফানেল। ১-ক্লিকেই নাম, ঠিকানা ও ফোন দিয়ে সরাসরি ক্যাশ অন ডেলিভারি অর্ডার।
                </p>
            </div>

            <!-- Feature 4 -->
            <div class="p-6 rounded-2xl bg-slate-50 hover:bg-emerald-50/40 border border-slate-200 transition space-y-3">
                <div class="w-12 h-12 bg-purple-100 text-purple-700 rounded-xl flex items-center justify-center text-2xl font-bold">
                    🚚
                </div>
                <h3 class="text-lg font-bold text-slate-900">স্টেডফাস্ট ও পাঠাও এপিআই</h3>
                <p class="text-sm text-slate-600 bn-font leading-relaxed">
                    অর্ডার কনফার্ম হলেই স্বয়ংক্রিয়ভাবে স্টেডফাস্ট কুরিয়ারে পার্সেল এন্ট্রি, কনসাইনমেন্ট ট্র্যাকিং কোড জেনারেশন ও রিয়েল-টাইম ডেলিভারি স্ট্যাটাস।
                </p>
            </div>

            <!-- Feature 5 -->
            <div class="p-6 rounded-2xl bg-slate-50 hover:bg-emerald-50/40 border border-slate-200 transition space-y-3">
                <div class="w-12 h-12 bg-rose-100 text-rose-700 rounded-xl flex items-center justify-center text-2xl font-bold">
                    📄
                </div>
                <h3 class="text-lg font-bold text-slate-900">বাংলা ইউনিকোড চালান ও ভ্যাট</h3>
                <p class="text-sm text-slate-600 bn-font leading-relaxed">
                    `laravel-unicode-pdf` ইন্টিগ্রেশনের মাধ্যমে খাঁটি বাংলা ফন্টে ট্যাক্স ইনভয়েস, ৮০মিমি থার্মাল পিওএস রসিদ ও আন্তঃশাখা স্টক চালান মুদ্রণ।
                </p>
            </div>

            <!-- Feature 6 -->
            <div class="p-6 rounded-2xl bg-slate-50 hover:bg-emerald-50/40 border border-slate-200 transition space-y-3">
                <div class="w-12 h-12 bg-teal-100 text-teal-700 rounded-xl flex items-center justify-center text-2xl font-bold">
                    ⏳
                </div>
                <h3 class="text-lg font-bold text-slate-900">ব্যাচ ও এক্সপায়ারি অ্যালার্ট</h3>
                <p class="text-sm text-slate-600 bn-font leading-relaxed">
                    কসমেটিকসের ব্যাচ নাম্বার ও মেয়াদোত্তীর্ণের তারিখ ট্র্যাকিং। ৩০/৬০/৯০ দিন আগে মেয়াদ শেষের আগাম সতর্কবার্তা দিয়ে নষ্ট হওয়ার ঝুঁকি রোধ।
                </p>
            </div>

            <!-- Feature 7 -->
            <div class="p-6 rounded-2xl bg-slate-50 hover:bg-emerald-50/40 border border-slate-200 transition space-y-3">
                <div class="w-12 h-12 bg-indigo-100 text-indigo-700 rounded-xl flex items-center justify-center text-2xl font-bold">
                    🤖
                </div>
                <h3 class="text-lg font-bold text-slate-900">এআই স্কিন কনসালট্যান্ট</h3>
                <p class="text-sm text-slate-600 bn-font leading-relaxed">
                    `laravel-ai-hub` চালিত অটোমেটিক স্কিন কেয়ার রুটিন জেনারেটর ও বাংলায় প্রোডাক্টের উপকারিতা লেখার কপিরাইটার অ্যাসিস্ট্যান্ট।
                </p>
            </div>

            <!-- Feature 8 -->
            <div class="p-6 rounded-2xl bg-slate-50 hover:bg-emerald-50/40 border border-slate-200 transition space-y-3">
                <div class="w-12 h-12 bg-emerald-100 text-emerald-700 rounded-xl flex items-center justify-center text-2xl font-bold">
                    ⏰
                </div>
                <h3 class="text-lg font-bold text-slate-900">বায়োমেট্রিক হাজিরা মেশিন</h3>
                <p class="text-sm text-slate-600 bn-font leading-relaxed">
                    `laravel-attendance-hub` চালিত ZKTeco ও ফিঙ্গারপ্রিন্ট মেশিনের মাধ্যমে প্রতিটি শাখার সেলস স্টাফদের লাইভ উপস্থিতি ও সেলস কমিশন ট্র্যাকিং।
                </p>
            </div>

            <!-- Feature 9 -->
            <div class="p-6 rounded-2xl bg-slate-50 hover:bg-emerald-50/40 border border-slate-200 transition space-y-3">
                <div class="w-12 h-12 bg-cyan-100 text-cyan-700 rounded-xl flex items-center justify-center text-2xl font-bold">
                    ⚡
                </div>
                <h3 class="text-lg font-bold text-slate-900">দ্রুতগতি (Drutogoti) স্পিড অপ্টিমাইজেশন</h3>
                <p class="text-sm text-slate-600 bn-font leading-relaxed">
                    `drutogoti` পারফরম্যান্স প্যাকেজের মাধ্যমে সুপার ফাস্ট ডেটাবেজ কোয়েরি ক্যাশিং এবং তাৎক্ষণিক লোডিং টাইম নিশ্চিতকরণ।
                </p>
            </div>

        </div>
    </div>
</section>

<!-- High-Converting Landing Page Funnel Showcase -->
<section class="py-16 bg-slate-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            <div class="lg:col-span-7 space-y-5">
                <span class="text-emerald-400 font-bold text-xs uppercase tracking-widest">High Conversion Rate</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight">
                    বিজ্ঞাপনের বিক্রয় ৩ গুণ বাড়িয়ে নিন হাই-কনভার্টিং ল্যান্ডিং পেজে
                </h2>
                <p class="text-slate-300 bn-font text-base leading-relaxed">
                    জটিল কার্ট কিংবা লগইনের ঝামেলা ছাড়াই গ্রাহক ১ ক্লিকে নাম, ফোন ও ঠিকানা লিখে সরাসরি অর্ডার কনফার্ম করতে পারে। ঢাকার ভেতর মাত্র ৬০ টাকা এবং ঢাকার বাইরে ১৩০ টাকা কুরিয়ার ডেলিভারি চার্জ অটোমেটিক হিসেব হয়ে যায়।
                </p>
                <div class="flex flex-wrap gap-4 pt-2">
                    @foreach($landingProducts as $lp)
                        <a href="{{ route('landing', $lp->slug) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-500 text-white rounded-lg text-sm font-bold transition">
                            <span>🔗 ল্যান্ডিং পেজ: {{ Str::limit($lp->name, 25) }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="lg:col-span-5 bg-slate-800 p-6 rounded-2xl border border-slate-700">
                <div class="text-xs text-emerald-400 font-bold mb-2">✓ লাইভ ল্যান্ডিং ফানেল প্রিভিউ</div>
                <div class="text-lg font-bold">COSRX Advanced Snail 96 Mucin Essence</div>
                <div class="text-sm text-slate-300 mt-1">৭ দিনে স্পষ্ট গ্লো ও ব্রণ মুক্ত ত্বকের কোরিয়ান সিক্রেট!</div>
                <div class="mt-4 pt-4 border-t border-slate-700 flex items-center justify-between">
                    <div>
                        <span class="text-xs text-slate-400 line-through">৳২,৪৫০</span>
                        <span class="text-xl font-black text-emerald-400 ml-2">৳১,৮৫০</span>
                    </div>
                    <span class="px-3 py-1 bg-emerald-500/20 text-emerald-300 text-xs font-bold rounded">ক্যাশ অন ডেলিভারি</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Popular Products Showcase -->
<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-end justify-between mb-12">
            <div>
                <span class="text-emerald-600 font-bold text-xs uppercase tracking-widest">Authentic Skincare</span>
                <h2 class="text-3xl font-extrabold text-slate-900 mt-1">জনপ্রিয় স্কিনকেয়ার ও কসমেটিকস</h2>
            </div>
            <a href="{{ route('shop') }}" class="text-emerald-700 font-bold hover:underline text-sm">
                সম্পূর্ণ ক্যাটালগ দেখুন ({{ count($featuredProducts) }}+ পণ্য) &rarr;
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredProducts as $product)
                <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-md transition flex flex-col justify-between">
                    <div class="p-4">
                        <div class="flex items-center justify-between text-xs text-slate-500 mb-2">
                            <span class="font-bold text-emerald-700">{{ $product->brand?->name ?? 'Genuine' }}</span>
                            <span class="bg-slate-100 px-2 py-0.5 rounded text-[11px] font-semibold">{{ $product->country_of_origin }}</span>
                        </div>
                        <h3 class="font-bold text-sm text-slate-900 line-clamp-2">{{ $product->name }}</h3>
                        @if($product->bangla_name)
                            <div class="text-xs text-slate-500 bn-font mt-1 line-clamp-1">{{ $product->bangla_name }}</div>
                        @endif

                        <div class="mt-3 flex flex-wrap gap-1">
                            @if($product->skin_types)
                                @foreach(array_slice($product->skin_types, 0, 2) as $st)
                                    <span class="text-[10px] bg-slate-100 text-slate-600 px-1.5 py-0.5 rounded font-medium">{{ ucfirst($st) }}</span>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="p-4 bg-slate-50/60 border-t border-slate-100 flex items-center justify-between">
                        <div>
                            @if($product->sale_price)
                                <span class="text-xs text-slate-400 line-through">৳{{ number_format($product->regular_price, 0) }}</span>
                                <span class="text-base font-extrabold text-emerald-700 block">৳{{ number_format($product->sale_price, 0) }}</span>
                            @else
                                <span class="text-base font-extrabold text-emerald-700">৳{{ number_format($product->regular_price, 0) }}</span>
                            @endif
                        </div>

                        <a href="{{ route('landing', $product->slug) }}" class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-bold transition">
                            অর্ডার করুন
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Skin Quiz Call to Action -->
<section class="py-16 bg-gradient-to-r from-emerald-600 to-teal-600 text-white text-center">
    <div class="max-w-4xl mx-auto px-4 space-y-4">
        <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight">আপনার ত্বকের উপযোগী স্কিনকেয়ার রুটিন খুঁজছেন?</h2>
        <p class="text-emerald-100 bn-font text-base max-w-2xl mx-auto">
            মাত্র ২ মিনিটে বিনামূল্যে আমাদের এআই স্কিন টেস্ট দিন। আপনার ত্বকের ধরন (তৈলাক্ত, শুষ্ক, মিশ্র বা সংবেদনশীল) অনুযায়ী নিখুঁত সকাল ও রাতের রুটিন জেনে নিন।
        </p>
        <div class="pt-4">
            <a href="{{ route('skin-quiz') }}" class="px-8 py-4 bg-white text-emerald-800 hover:bg-emerald-50 rounded-xl font-extrabold text-base shadow-lg transition inline-flex items-center gap-2">
                <span>✨ এখনই ফ্রি স্কিন টেস্ট শুরু করুন</span>
            </a>
        </div>
    </div>
</section>

@endsection
