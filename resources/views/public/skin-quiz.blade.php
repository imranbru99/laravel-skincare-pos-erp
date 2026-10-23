@extends('layouts.public')

@section('title', 'অনলাইন এআই স্কিন টেস্ট ও ডার্মাটোলজি কনসালট্যান্ট - Glow & Care')

@section('content')

<div class="py-12 bg-gradient-to-b from-emerald-50/50 via-white to-slate-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center space-y-3 mb-10">
            <span class="text-emerald-700 bg-emerald-100 text-xs font-bold px-3.5 py-1.5 rounded-full inline-block">
                ✨ ২ মিনিটের ফ্রি ডার্মাটোলজি টেস্ট
            </span>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                আপনার ত্বকের ধরন ও সঠিক স্কিনকেয়ার রুটিন জানুন
            </h1>
            <p class="text-slate-600 bn-font text-base max-w-xl mx-auto">
                সঠিক উপাদান ছাড়া ভুল স্কিনকেয়ার ব্যবহারে ত্বকের ব্যারিয়ার নষ্ট হতে পারে। প্রশ্নের উত্তর দিন এবং বিশেষজ্ঞ পরামর্শ জেনে নিন।
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-xl p-6 sm:p-10" id="quizContainer">
            
            <!-- Step 1: Skin Type -->
            <div id="step1" class="space-y-6">
                <div class="text-xs font-bold text-emerald-600 uppercase tracking-wider">ধাপ ১ / ৩</div>
                <h2 class="text-xl sm:text-2xl font-bold text-slate-900">ঘুম থেকে ওঠার পর আপনার মুখের ত্বকের অনুভূতি কেমন থাকে?</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <button type="button" onclick="selectSkinType('oily')" class="p-4 rounded-xl border-2 border-slate-200 hover:border-emerald-500 hover:bg-emerald-50/30 text-left transition flex items-start gap-3">
                        <span class="text-2xl">💧</span>
                        <div>
                            <div class="font-bold text-slate-900 text-sm">তৈলাক্ত ত্বক (Oily Skin)</div>
                            <div class="text-xs text-slate-500 mt-1">পুরো মুখ চকচক করে এবং অতিরিক্ত তেল নিঃসরিত হয়।</div>
                        </div>
                    </button>

                    <button type="button" onclick="selectSkinType('dry')" class="p-4 rounded-xl border-2 border-slate-200 hover:border-emerald-500 hover:bg-emerald-50/30 text-left transition flex items-start gap-3">
                        <span class="text-2xl">🍂</span>
                        <div>
                            <div class="font-bold text-slate-900 text-sm">শুষ্ক ত্বক (Dry Skin)</div>
                            <div class="text-xs text-slate-500 mt-1">মুখ টানটান ভাব লাগে, রুক্ষ ও ত্বক ফেটে যাওয়ার অনুভূতি হয়।</div>
                        </div>
                    </button>

                    <button type="button" onclick="selectSkinType('combination')" class="p-4 rounded-xl border-2 border-slate-200 hover:border-emerald-500 hover:bg-emerald-50/30 text-left transition flex items-start gap-3">
                        <span class="text-2xl">⚖️</span>
                        <div>
                            <div class="font-bold text-slate-900 text-sm">মিশ্র ত্বক (Combination Skin)</div>
                            <div class="text-xs text-slate-500 mt-1">কপাল ও নাক (T-Zone) তেলতেলে, কিন্তু গাল স্বাভাবিক বা শুষ্ক।</div>
                        </div>
                    </button>

                    <button type="button" onclick="selectSkinType('sensitive')" class="p-4 rounded-xl border-2 border-slate-200 hover:border-emerald-500 hover:bg-emerald-50/30 text-left transition flex items-start gap-3">
                        <span class="text-2xl">🌸</span>
                        <div>
                            <div class="font-bold text-slate-900 text-sm">সংবেদনশীল ত্বক (Sensitive Skin)</div>
                            <div class="text-xs text-slate-500 mt-1">রোদে গেলে বা নতুন পণ্য লাগালেই লাল হয়ে যায় বা চুলকায়।</div>
                        </div>
                    </button>
                </div>
            </div>

            <!-- Step 2: Concerns -->
            <div id="step2" class="space-y-6 hidden">
                <div class="text-xs font-bold text-emerald-600 uppercase tracking-wider">ধাপ ২ / ৩</div>
                <h2 class="text-xl sm:text-2xl font-bold text-slate-900">আপনার ত্বকের প্রধান সমস্যা কোনটি দূর করতে চান?</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <button type="button" onclick="selectConcern('acne')" class="p-4 rounded-xl border-2 border-slate-200 hover:border-emerald-500 hover:bg-emerald-50/30 text-left transition flex items-start gap-3">
                        <span class="text-2xl">🔴</span>
                        <div>
                            <div class="font-bold text-slate-900 text-sm">ব্রণ ও অ্যাকনে (Acne & Pimples)</div>
                            <div class="text-xs text-slate-500 mt-1">ঘন ঘন ফুসকুড়ি, লালচে ব্রণ ও বড় লোমকূপ।</div>
                        </div>
                    </button>

                    <button type="button" onclick="selectConcern('pigmentation')" class="p-4 rounded-xl border-2 border-slate-200 hover:border-emerald-500 hover:bg-emerald-50/30 text-left transition flex items-start gap-3">
                        <span class="text-2xl">☀️</span>
                        <div>
                            <div class="font-bold text-slate-900 text-sm">মেছতা ও রোদে পোড়া দাগ (Pigmentation)</div>
                            <div class="text-xs text-slate-500 mt-1">গালে বাদামী বা কালো ছোপ ছোপ দাগ ও আনইভেন টোন।</div>
                        </div>
                    </button>

                    <button type="button" onclick="selectConcern('hydration')" class="p-4 rounded-xl border-2 border-slate-200 hover:border-emerald-500 hover:bg-emerald-50/30 text-left transition flex items-start gap-3">
                        <span class="text-2xl">💧</span>
                        <div>
                            <div class="font-bold text-slate-900 text-sm">ত্বকের মলিনতা ও গ্লো কমে যাওয়া (Dull Skin)</div>
                            <div class="text-xs text-slate-500 mt-1">ন্যাচারাল গ্লো নেই, ত্বক দেখতে ক্লান্ত ও নির্জীব লাগে।</div>
                        </div>
                    </button>

                    <button type="button" onclick="selectConcern('aging')" class="p-4 rounded-xl border-2 border-slate-200 hover:border-emerald-500 hover:bg-emerald-50/30 text-left transition flex items-start gap-3">
                        <span class="text-2xl">⏳</span>
                        <div>
                            <div class="font-bold text-slate-900 text-sm">বয়সের ছাপ ও বলিরেখা (Anti-Aging)</div>
                            <div class="text-xs text-slate-500 mt-1">চোখের কোণে বা কপালে ফাইন লাইনস ও চামড়া ঢিলা হওয়া।</div>
                        </div>
                    </button>
                </div>
            </div>

            <!-- Step 3: Loading & Result -->
            <div id="stepResult" class="space-y-6 hidden">
                <div class="bg-emerald-50 border border-emerald-200 p-6 rounded-2xl space-y-4">
                    <div class="flex items-center gap-2">
                        <span class="text-2xl">🎉</span>
                        <h3 class="text-xl font-extrabold text-emerald-900">আপনার পারসোনালাইজড স্কিনকেয়ার রুটিন প্রস্তুত!</h3>
                    </div>

                    <div id="routineText" class="text-sm text-slate-800 bn-font leading-relaxed whitespace-pre-line bg-white p-5 rounded-xl border border-emerald-100 shadow-sm">
                        <!-- Filled by JS -->
                    </div>

                    <div class="pt-2 flex flex-wrap gap-3">
                        <a href="{{ route('shop') }}" class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl text-sm transition">
                            সুপারিশকৃত পণ্যসমূহ শপে দেখুন &rarr;
                        </a>
                        <button type="button" onclick="location.reload()" class="px-4 py-3 bg-white border border-slate-300 text-slate-700 font-bold rounded-xl text-sm transition">
                            পুনরায় টেস্ট দিন
                        </button>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<script>
    let userSkinType = '';
    let userConcern = '';

    function selectSkinType(type) {
        userSkinType = type;
        document.getElementById('step1').classList.add('hidden');
        document.getElementById('step2').classList.remove('hidden');
    }

    function selectConcern(concern) {
        userConcern = concern;
        document.getElementById('step2').classList.add('hidden');
        document.getElementById('stepResult').classList.remove('hidden');

        renderRegimen(userSkinType, userConcern);
    }

    function renderRegimen(type, concern) {
        let typeBangla = type === 'oily' ? 'তৈলাক্ত ত্বক' : (type === 'dry' ? 'শুষ্ক ত্বক' : (type === 'combination' ? 'মিশ্র ত্বক' : 'সংবেদনশীল ত্বক'));
        let concernBangla = concern === 'acne' ? 'ব্রণ নিয়ন্ত্রণ ও পোরস মিনিমাইজেশন' : (concern === 'pigmentation' ? 'মেছতা ও রোদে পোড়া দাগ দূরীকরণ' : 'গ্লো বৃদ্ধি ও ব্যারিয়ার রিপেয়ার');

        let text = `✓ আপনার ত্বকের ধরণ: ${typeBangla}\n✓ প্রধান লক্ষ্য: ${concernBangla}\n\n` +
                   `☀️ সকালের রুটিন (AM Steps):\n` +
                   `১. জেন্টল ফোমিং ক্লিনজার (COSRX Low pH Good Morning Gel Cleanser)\n` +
                   `২. হাইড্রেটিং টোনার (Centella Asiatica / Niacinamide)\n` +
                   `৩. হালকা জেল ময়েশ্চারাইজার\n` +
                   `৪. সানস্ক্রিন (Beauty of Joseon Relief Sun SPF 50+ PA++++) - অন্তত ২ আঙুল পরিমাণ\n\n` +
                   `🌙 রাতের রুটিন (PM Steps):\n` +
                   `১. ডাবল ক্লিনজিং (ধুলোবালি ও সানস্ক্রিন সম্পূর্ণ পরিষ্কার করার জন্য)\n` +
                   `২. অ্যাক্টিভ সিরাম (স্যালিসিলিক এসিড অথবা নায়াসিনামাইড ১০% সিরাম)\n` +
                   `৩. সেরেমায়েড সমৃদ্ধ ব্যারিয়ার রিপেয়ারিং নাইট ক্রিম\n\n` +
                   `💡 জরুরি পরামর্শ: রোদে যাওয়ার অন্তত ২০ মিনিট আগে সানস্ক্রিন ব্যবহার করবেন এবং প্রচুর পানি পান করবেন।`;

        document.getElementById('routineText').innerText = text;
    }
</script>

@endsection
