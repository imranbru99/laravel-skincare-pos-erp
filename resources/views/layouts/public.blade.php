<!DOCTYPE html>
<html lang="bn" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Glow & Care - Bangladeshi Skincare Business Platform')</title>
    <meta name="description" content="@yield('meta_description', 'Complete End-to-End ERP, eCommerce, Multi-Branch POS & Clinic Platform for Bangladeshi Skincare Brands')">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Hind+Siliguri:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', 'Hind Siliguri', sans-serif;
        }
        .bn-font {
            font-family: 'Hind Siliguri', 'SolaimanLipi', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased flex flex-col min-h-screen">

    <!-- Top Announcement Bar -->
    <div class="bg-emerald-900 text-emerald-100 text-xs py-2 px-4 text-center font-medium">
        <span class="inline-block bg-emerald-700 text-white text-[10px] uppercase font-bold px-2 py-0.5 rounded-full mr-2">New Release</span>
        <span>সম্পূর্ণ বাংলাদেশি স্কিনকেয়ার ও কসমেটিকস ব্যবসার অল-ইন-ওয়ান সমাধান (ERP + POS + কুরিয়ার + এআই)</span>
        <a href="{{ route('demo') }}" class="underline ml-2 font-bold hover:text-white">লাইভ ডেমো দেখুন &rarr;</a>
    </div>

    <!-- Navigation Header -->
    <header class="bg-white/95 backdrop-blur sticky top-0 z-50 border-b border-slate-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-11 h-11 bg-gradient-to-tr from-emerald-600 to-teal-500 rounded-xl flex items-center justify-center text-white font-black text-xl shadow-md">
                    GC
                </div>
                <div>
                    <span class="font-extrabold text-xl text-slate-900 tracking-tight flex items-center gap-1.5">
                        Glow & Care <span class="text-xs bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded font-bold">ERP</span>
                    </span>
                    <span class="text-xs text-slate-500 block -mt-1 bn-font">গ্লো অ্যান্ড কেয়ার স্কিনকেয়ার স্যুট</span>
                </div>
            </a>

            <!-- Desktop Nav Menu -->
            <nav class="hidden md:flex items-center gap-8 text-sm font-semibold text-slate-600">
                <a href="{{ route('home') }}" class="hover:text-emerald-600 transition {{ request()->routeIs('home') ? 'text-emerald-600 font-bold' : '' }}">হোম (Home)</a>
                <a href="{{ route('features') }}" class="hover:text-emerald-600 transition {{ request()->routeIs('features') ? 'text-emerald-600 font-bold' : '' }}">ফিচারসমূহ (Features)</a>
                <a href="{{ route('shop') }}" class="hover:text-emerald-600 transition {{ request()->routeIs('shop') ? 'text-emerald-600 font-bold' : '' }}">অনলাইন শপ (Shop)</a>
                <a href="{{ route('skin-quiz') }}" class="text-emerald-700 font-bold hover:text-emerald-800 flex items-center gap-1">
                    <span>✨ স্কিন টেস্ট (Skin Quiz)</span>
                </a>
                <a href="{{ route('pricing') }}" class="hover:text-emerald-600 transition {{ request()->routeIs('pricing') ? 'text-emerald-600 font-bold' : '' }}">প্রাইসিং (Pricing)</a>
                <a href="{{ route('contact') }}" class="hover:text-emerald-600 transition {{ request()->routeIs('contact') ? 'text-emerald-600 font-bold' : '' }}">যোগাযোগ (Branches)</a>
            </nav>

            <!-- Right CTA Buttons -->
            <div class="flex items-center gap-3">
                <a href="{{ route('demo') }}" class="px-4 py-2 text-sm font-bold text-emerald-700 bg-emerald-50 hover:bg-emerald-100 rounded-lg transition border border-emerald-200">
                    🚀 লাইভ ডেমো
                </a>
                <a href="/admin" class="px-4 py-2 text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg shadow-sm transition">
                    অ্যাডমিন প্যানেল &rarr;
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @if(session('error'))
            <div class="max-w-7xl mx-auto px-4 mt-4">
                <div class="bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3 rounded-lg text-sm font-medium">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-300 pt-16 pb-12 border-t border-slate-800 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-10">
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <div class="w-9 h-9 bg-emerald-500 rounded-lg flex items-center justify-center text-white font-bold text-lg">
                        GC
                    </div>
                    <span class="font-extrabold text-xl text-white">Glow & Care Suite</span>
                </div>
                <p class="text-sm text-slate-400 bn-font leading-relaxed">
                    বাংলাদেশের স্কিনকেয়ার ও ডার্মাটোলজি ব্র্যান্ড, রিটেল শোরুম এবং মাল্টি-ব্রাঞ্চ আউটলেটের জন্য পূর্ণাঙ্গ ক্লাউড ইআরপি ও সেলস অটোমেশন সফটওয়্যার।
                </p>
                <div class="text-xs text-emerald-400 font-semibold">
                    ✓ বিএসটিআই অনুবর্তী | ১০০% খাঁটি স্কিনকেয়ার
                </div>
            </div>

            <div>
                <h4 class="text-white font-bold text-sm mb-4">ব্যবসার মডিউলসমূহ</h4>
                <ul class="space-y-2 text-sm text-slate-400">
                    <li><a href="{{ route('features') }}" class="hover:text-emerald-400">মাল্টি-ব্রাঞ্চ পিওএস (POS)</a></li>
                    <li><a href="{{ route('features') }}" class="hover:text-emerald-400">ল্যান্ডিং পেজ অর্ডার ফানেল</a></li>
                    <li><a href="{{ route('features') }}" class="hover:text-emerald-400">স্টেডফাস্ট ও পাঠাও কুরিয়ার</a></li>
                    <li><a href="{{ route('features') }}" class="hover:text-emerald-400">বাংলা ইউনিকোড চালান ও ভ্যাট</a></li>
                    <li><a href="{{ route('features') }}" class="hover:text-emerald-400">এক্সপায়ারি ও ব্যাচ ট্র্যাকিং</a></li>
                    <li><a href="{{ route('features') }}" class="hover:text-emerald-400">বায়োমেট্রিক হাজিরা মেশিন</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-bold text-sm mb-4">দ্রুত লিংক</h4>
                <ul class="space-y-2 text-sm text-slate-400">
                    <li><a href="{{ route('shop') }}" class="hover:text-emerald-400">প্রোডাক্ট ক্যাটালগ</a></li>
                    <li><a href="{{ route('skin-quiz') }}" class="hover:text-emerald-400">অনলাইন স্কিন অ্যানালাইজার</a></li>
                    <li><a href="{{ route('demo') }}" class="hover:text-emerald-400">ডেমো অ্যাকাউন্ট সমূহ</a></li>
                    <li><a href="{{ route('pricing') }}" class="hover:text-emerald-400">প্যাকেজ ও মূল্য তালিকা</a></li>
                    <li><a href="{{ route('docs') }}" class="hover:text-emerald-400">ডকুমেন্টেশন ও এপিআই</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-bold text-sm mb-4">শোরুম ও অফিস</h4>
                <div class="space-y-2 text-sm text-slate-400">
                    <div><strong>বনানী শাখা:</strong> হাউজ ১২, রোড ১১, ব্লক এফ, বনানী, ঢাকা।</div>
                    <div><strong>ধানমন্ডি শাখা:</strong> সীমান্ত স্কয়ার, লেভেল ৩, ধানমন্ডি, ঢাকা।</div>
                    <div><strong>চট্টগ্রাম শাখা:</strong> সানমার ওশান সিটি, জিইসি মোড়, চট্টগ্রাম।</div>
                    <div class="pt-2 text-emerald-400 font-bold">হটলাইন: ০১৭১১-০০০০০০</div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 mt-12 pt-6 border-t border-slate-800 text-center text-xs text-slate-500">
            &copy; {{ date('Y') }} Glow & Care Skincare Business Suite (Bangladesh). All rights reserved. Powered by Laravel 11 & Filament v3.
        </div>
    </footer>

</body>
</html>
