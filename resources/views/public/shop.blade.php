@extends('layouts.public')

@section('title', 'অনলাইন স্কিনকেয়ার শপ ও পণ্য ক্যাটালগ - Glow & Care')

@section('content')

<div class="py-12 bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight">স্কিনকেয়ার প্রোডাক্ট ক্যাটালগ</h1>
                <p class="text-xs text-slate-500 bn-font mt-1">১০০% আসল ও বিএসটিআই মানসম্মত কোরিয়ান ও আন্তর্জাতিক স্কিনকেয়ার</p>
            </div>
            
            <!-- Quick Search Bar -->
            <form action="{{ route('shop') }}" method="GET" class="flex items-center gap-2">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="পণ্য বা ব্র্যান্ড খুঁজুন..." 
                    class="text-xs rounded-xl border-slate-300 w-56 sm:w-72 focus:ring-emerald-500 focus:border-emerald-500"
                />
                <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold transition">
                    সার্চ
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Filters Sidebar -->
            <div class="lg:col-span-3 bg-white p-5 rounded-2xl border border-slate-200 shadow-sm space-y-6">
                <div>
                    <h3 class="font-bold text-xs uppercase tracking-wider text-slate-500 mb-3">ত্বকের ধরন (Skin Type)</h3>
                    <div class="space-y-1.5 text-xs">
                        <a href="{{ route('shop') }}" class="block px-2.5 py-1.5 rounded-lg {{ !request('skin_type') ? 'bg-emerald-100 text-emerald-800 font-bold' : 'text-slate-600 hover:bg-slate-50' }}">
                            সকল ধরনের ত্বক
                        </a>
                        @foreach([
                            'oily' => 'তৈলাক্ত ত্বক (Oily)',
                            'dry' => 'শুষ্ক ত্বক (Dry)',
                            'combination' => 'মিশ্র ত্বক (Combination)',
                            'sensitive' => 'সংবেদনশীল (Sensitive)',
                        ] as $val => $lbl)
                            <a href="{{ route('shop', array_merge(request()->query(), ['skin_type' => $val])) }}" class="block px-2.5 py-1.5 rounded-lg {{ request('skin_type') === $val ? 'bg-emerald-100 text-emerald-800 font-bold' : 'text-slate-600 hover:bg-slate-50' }}">
                                {{ $lbl }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <div>
                    <h3 class="font-bold text-xs uppercase tracking-wider text-slate-500 mb-3">ত্বকের সমস্যা (Skin Concern)</h3>
                    <div class="space-y-1.5 text-xs">
                        @foreach([
                            'acne' => 'ব্রণ ও ফুসকুড়ি (Acne)',
                            'pigmentation' => 'মেছতা ও কালো ছোপ (Melasma)',
                            'dark_spots' => 'রোদে পোড়া দাগ (Dark Spots)',
                            'hydration' => 'পানিশূন্যতা ও নিস্তেজ ত্বক (Dehydration)',
                            'aging' => 'বলিরেখা ও বয়সের ছাপ (Anti-Aging)',
                        ] as $val => $lbl)
                            <a href="{{ route('shop', array_merge(request()->query(), ['skin_concern' => $val])) }}" class="block px-2.5 py-1.5 rounded-lg {{ request('skin_concern') === $val ? 'bg-emerald-100 text-emerald-800 font-bold' : 'text-slate-600 hover:bg-slate-50' }}">
                                {{ $lbl }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <div>
                    <h3 class="font-bold text-xs uppercase tracking-wider text-slate-500 mb-3">শীর্ষ ব্র্যান্ডসমূহ</h3>
                    <div class="space-y-1.5 text-xs">
                        @foreach($brands as $brand)
                            <a href="{{ route('shop', array_merge(request()->query(), ['brand_id' => $brand->id])) }}" class="block px-2.5 py-1.5 rounded-lg {{ request('brand_id') == $brand->id ? 'bg-emerald-100 text-emerald-800 font-bold' : 'text-slate-600 hover:bg-slate-50' }}">
                                {{ $brand->name }} ({{ $brand->country_of_origin }})
                            </a>
                        @endforeach
                    </div>
                </div>

                @if(request()->hasAny(['skin_type', 'skin_concern', 'brand_id', 'search']))
                    <a href="{{ route('shop') }}" class="block text-center text-xs text-rose-600 hover:underline pt-2 border-t border-slate-100 font-bold">
                        ফিল্টার রিসেট করুন (Clear Filters)
                    </a>
                @endif
            </div>

            <!-- Products Grid -->
            <div class="lg:col-span-9 space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($products as $product)
                        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-md transition flex flex-col justify-between">
                            <div class="p-5">
                                <div class="flex items-center justify-between text-xs text-slate-500 mb-2">
                                    <span class="font-bold text-emerald-700">{{ $product->brand?->name ?? 'Genuine' }}</span>
                                    <span class="text-[11px] bg-slate-100 px-2 py-0.5 rounded font-semibold">{{ $product->country_of_origin }}</span>
                                </div>
                                <h3 class="font-bold text-sm text-slate-900 line-clamp-2 leading-snug">{{ $product->name }}</h3>
                                @if($product->bangla_name)
                                    <div class="text-xs text-slate-500 bn-font mt-1 line-clamp-1">{{ $product->bangla_name }}</div>
                                @endif

                                <div class="mt-3 flex flex-wrap gap-1">
                                    @if($product->skin_types)
                                        @foreach(array_slice($product->skin_types, 0, 2) as $st)
                                            <span class="text-[10px] bg-emerald-50 text-emerald-700 px-2 py-0.5 rounded font-medium">{{ ucfirst($st) }}</span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="p-4 bg-slate-50/80 border-t border-slate-100 flex items-center justify-between">
                                <div>
                                    @if($product->sale_price)
                                        <span class="text-xs text-slate-400 line-through">৳{{ number_format($product->regular_price, 0) }}</span>
                                        <span class="text-base font-black text-emerald-800 block">৳{{ number_format($product->sale_price, 0) }}</span>
                                    @else
                                        <span class="text-base font-black text-emerald-800">৳{{ number_format($product->regular_price, 0) }}</span>
                                    @endif
                                </div>

                                <a href="{{ route('landing', $product->slug) }}" class="px-3.5 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-bold transition shadow-sm">
                                    অর্ডার করুন &rarr;
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center py-20 bg-white rounded-2xl border border-slate-200 text-slate-400">
                            কোনো পণ্য পাওয়া যায়নি। দয়া করে ভিন্ন ফিল্টার বা সার্চ দিয়ে চেষ্টা করুন।
                        </div>
                    @endforelse
                </div>

                <div class="pt-4">
                    {{ $products->links() }}
                </div>
            </div>

        </div>

    </div>
</div>

@endsection
