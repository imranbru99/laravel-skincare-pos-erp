<x-filament-panels::page>
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        <!-- Left Form: Skin Profile Input -->
        <div class="lg:col-span-5 bg-white dark:bg-gray-800 p-5 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm space-y-4">
            <h2 class="font-bold text-base text-gray-800 dark:text-gray-100 flex items-center gap-2">
                <span>🤖 AI Skin Analyzer Parameters</span>
            </h2>

            <div>
                <label class="text-xs font-semibold text-gray-700 dark:text-gray-300 block mb-1">Customer Skin Type</label>
                <select wire:model="skinType" class="w-full text-sm rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    <option value="oily">Oily Skin (তৈলাক্ত ত্বক)</option>
                    <option value="dry">Dry Skin (শুষ্ক ত্বক)</option>
                    <option value="combination">Combination Skin (মিশ্র ত্বক)</option>
                    <option value="sensitive">Sensitive Skin (সংবেদনশীল ত্বক)</option>
                    <option value="normal">Normal Skin (স্বাভাবিক ত্বক)</option>
                </select>
            </div>

            <div>
                <label class="text-xs font-semibold text-gray-700 dark:text-gray-300 block mb-1.5">Target Skin Concerns</label>
                <div class="grid grid-cols-2 gap-2 text-xs">
                    @foreach([
                        'acne' => 'Acne & Blemishes (ব্রণ)',
                        'pigmentation' => 'Pigmentation (মেছতা)',
                        'aging' => 'Aging & Wrinkles (বয়সের ছাপ)',
                        'dark_spots' => 'Dark Spots & Tan (কালো দাগ)',
                        'hydration' => 'Dehydration (পানিশূন্যতা)',
                        'pores' => 'Enlarged Pores (বড় পোরস)',
                    ] as $key => $label)
                        <label class="flex items-center gap-2 p-2 rounded border border-gray-200 dark:border-gray-700 cursor-pointer">
                            <input type="checkbox" wire:model="concerns" value="{{ $key }}" class="rounded text-emerald-600 focus:ring-emerald-500" />
                            <span class="text-gray-700 dark:text-gray-300">{{ $label }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div>
                <label class="text-xs font-semibold text-gray-700 dark:text-gray-300 block mb-1">Specific Symptoms / Allergies</label>
                <textarea wire:model="notes" rows="3" placeholder="e.g. Sensitive to strong fragrance, spends 4 hours outdoors in Dhaka sun daily..." class="w-full text-sm rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"></textarea>
            </div>

            <button 
                wire:click="generateConsultation" 
                class="w-full py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-lg shadow-sm transition text-sm flex items-center justify-center gap-2">
                <span>✨ Generate Routine with AI Skincare Hub</span>
            </button>
        </div>

        <!-- Right Output: AI Analysis & Recommended Regimen -->
        <div class="lg:col-span-7 bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm flex flex-col justify-between">
            @if($generatedRoutine)
                <div class="space-y-4">
                    <div class="flex items-center justify-between border-b border-gray-100 dark:border-gray-700 pb-3">
                        <h3 class="font-bold text-base text-emerald-700 dark:text-emerald-400">
                            📋 AI Consultation Prescription
                        </h3>
                        <span class="text-xs bg-emerald-100 text-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-300 px-2.5 py-1 rounded-full font-bold">Bangla Regimen Ready</span>
                    </div>

                    <div class="prose prose-sm dark:prose-invert max-w-none text-gray-800 dark:text-gray-200 whitespace-pre-line bg-gray-50 dark:bg-gray-900/50 p-4 rounded-lg border border-gray-100 dark:border-gray-800">
                        {!! nl2br(e($generatedRoutine)) !!}
                    </div>

                    @if(count($recommendedProducts) > 0)
                        <div class="mt-4 pt-3 border-t border-gray-100 dark:border-gray-700">
                            <h4 class="font-bold text-xs uppercase tracking-wider text-gray-500 mb-2">Prescribed Database Products</h4>
                            <div class="grid grid-cols-2 gap-2">
                                @foreach($recommendedProducts as $p)
                                    <div class="p-2.5 rounded-lg border border-gray-200 dark:border-gray-700 flex items-center justify-between text-xs">
                                        <div>
                                            <div class="font-bold text-gray-800 dark:text-gray-100">{{ $p->name }}</div>
                                            <div class="text-[11px] text-gray-400">{{ $p->brand?->name }} | SKU: {{ $p->sku }}</div>
                                        </div>
                                        <div class="font-bold text-emerald-600">৳{{ number_format($p->effective_price, 0) }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <div class="py-24 text-center text-gray-400 flex flex-col items-center justify-center">
                    <div class="text-4xl mb-3">✨</div>
                    <div class="font-semibold text-sm">No analysis generated yet.</div>
                    <div class="text-xs mt-1 text-gray-500">Select parameters on the left and click "Generate Routine" to produce a dermatological regimen.</div>
                </div>
            @endif
        </div>

    </div>
</x-filament-panels::page>
