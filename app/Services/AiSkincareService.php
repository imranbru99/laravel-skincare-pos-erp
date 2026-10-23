<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Log;
use ImranDevBd\AiHub\Facades\AIHub;

class AiSkincareService
{
    /**
     * Analyze skin profile and recommend targeted skincare routine
     */
    public function analyzeSkinAndRecommendRoutine(string $skinType, array $concerns, ?string $notes = null): array
    {
        $concernsList = implode(', ', $concerns);
        $prompt = "Act as an expert cosmetic dermatologist and Korean skincare consultant for Bangladeshi climate.
        Patient Profile:
        - Skin Type: {$skinType}
        - Skin Concerns: {$concernsList}
        - Notes: {$notes}
        
        Provide:
        1. Concise diagnostic summary in Bengali.
        2. Morning Routine (AM Steps in Bengali with recommended active ingredients).
        3. Night Routine (PM Steps in Bengali with recommended active ingredients).
        4. Important precautions for Bangladeshi humid/dusty environment.";

        try {
            // Check if AIHub is configured with an active key
            $apiKey = config('ai-hub.providers.openai.api_key') ?? config('ai-hub.providers.gemini.api_key');
            if (!empty($apiKey) && !str_starts_with($apiKey, 'demo_')) {
                $response = AIHub::prompt($prompt)->generate();
                $text = is_string($response) ? $response : ($response->content ?? '');
                if (!empty($text)) {
                    return [
                        'source' => 'ai_generated',
                        'analysis' => $text,
                        'recommended_product_ids' => $this->matchProductsToConcerns($skinType, $concerns),
                    ];
                }
            }
        } catch (\Throwable $e) {
            Log::warning('AIHub consultation fallback: ' . $e->getMessage());
        }

        // Intelligent deterministic specialist regimen fallback
        return [
            'source' => 'expert_engine',
            'analysis' => $this->getRuleBasedRegimen($skinType, $concerns),
            'recommended_product_ids' => $this->matchProductsToConcerns($skinType, $concerns),
        ];
    }

    /**
     * Generate Bengali product description & usage guide
     */
    public function generateBengaliProductCopy(Product $product): array
    {
        $prompt = "Generate authentic, high-converting skincare product details in Bengali for Bangladesh market:
        Product Name: {$product->name}
        Brand: {$product->brand?->name}
        Country of Origin: {$product->country_of_origin}
        Ingredients: {$product->ingredients}
        Skin Types: " . implode(', ', (array) $product->skin_types) . "
        
        Format as:
        1. Bangla Product Name
        2. Bangla Description (উপকারিতা ও কার্যকারিতা)
        3. How to Use (ব্যবহারের সঠিক নিয়ম)";

        try {
            $apiKey = config('ai-hub.providers.openai.api_key') ?? config('ai-hub.providers.gemini.api_key');
            if (!empty($apiKey) && !str_starts_with($apiKey, 'demo_')) {
                $response = AIHub::prompt($prompt)->generate();
                $text = is_string($response) ? $response : ($response->content ?? '');
                if (!empty($text)) {
                    return [
                        'bangla_name' => "{$product->name} - ১০০% অথেনটিক স্কিনকেয়ার",
                        'bangla_description' => $text,
                        'how_to_use' => "প্রতিদিন সকালে ও রাতে মুখ পরিষ্কার করে পরিমাণমতো নিয়ে আলতো করে ম্যাসাজ করুন।",
                    ];
                }
            }
        } catch (\Throwable $e) {
            Log::warning('AIHub product copy fallback: ' . $e->getMessage());
        }

        // High-converting cosmetic template
        $banglaName = "{$product->name} (" . ($product->brand?->name ?? 'অরিজিনাল') . ")";
        $banglaDescription = "এটি একটি প্রিমিয়াম " . ($product->country_of_origin ?? 'কোরিয়ান') . " স্কিনকেয়ার ফর্মুলেশন। এতে রয়েছে সক্রিয় উপাদান যা ত্বকের গভীর থেকে পুষ্টি যোগায় এবং ত্বককে করে তোলে মসৃণ, উজ্জ্বল ও দাগহীন। ত্বকের অতিরিক্ত তেল নিয়ন্ত্রণ এবং আর্দ্রতা ধরে রাখতে অত্যন্ত কার্যকর। বিএসটিআই ও আন্তর্জাতিক মানসম্মত।";
        $howToUse = "১. প্রথমে ভালো ক্লিনজার বা ফেসওয়াশ দিয়ে মুখ ধুয়ে নিন।\n২. ২-৩ ফোঁটা বা পরিমিত পরিমাণ নিয়ে আলতো করে মুখে ট্যাপ করে বসিয়ে দিন।\n৩. দিনের বেলা ব্যবহারের পর সানস্ক্রিন ব্যবহার আবশ্যক।";

        return [
            'bangla_name' => $banglaName,
            'bangla_description' => $banglaDescription,
            'how_to_use' => $howToUse,
        ];
    }

    /**
     * Match database products according to skin type and concerns
     */
    protected function matchProductsToConcerns(string $skinType, array $concerns): array
    {
        return Product::query()
            ->where('is_active', true)
            ->where(function ($query) use ($skinType, $concerns) {
                $query->whereJsonContains('skin_types', $skinType);
                foreach ($concerns as $concern) {
                    $query->orWhereJsonContains('skin_concerns', $concern);
                }
            })
            ->limit(4)
            ->pluck('id')
            ->toArray();
    }

    /**
     * Deterministic Expert Regimen in Bengali
     */
    protected function getRuleBasedRegimen(string $skinType, array $concerns): string
    {
        $concernsBangla = match (true) {
            in_array('acne', $concerns) => 'ব্রণ ও পোরস নিয়ন্ত্রণ',
            in_array('pigmentation', $concerns) => 'মেছতা ও রোদে পোড়া দাগ দূরীকরণ',
            in_array('aging', $concerns) => 'বয়সের ছাপ ও ফাইন লাইনস প্রতিরোধ',
            default => 'ত্বকের উজ্জ্বলতা ও গ্লো বৃদ্ধি',
        };

        return "### বিশেষজ্ঞ ডার্মাটোলজি পরামর্শ ও স্কিনকেয়ার রুটিন

**আপনার ত্বকের ধরন:** " . ucfirst($skinType) . "
**প্রধান লক্ষ্য:** {$concernsBangla}

---

#### ☀️ সকালের রুটিন (Morning AM Routine):
1. **জেন্টল ফোমিং ক্লিনজার:** ত্বকের ন্যাচারাল ব্যারিয়ার ঠিক রেখে অতিরিক্ত সিবাম পরিষ্কার করবে।
2. **হাইড্রেটিং টোনার/এসেন্স:** সেন্টেলা বা হায়ালুরোনিক অ্যাসিড সমৃদ্ধ টোনার ত্বককে ময়েশ্চারাইজ করবে।
3. **নায়াসিনামাইড সিরাম (২%-৫%):** ত্বকের পোরস টাইট করবে এবং রোদের কালো দাগ দূর করবে।
4. **হালকা জেল ময়েশ্চারাইজার:** কোনো ভারী ভাব ছাড়াই দীর্ঘক্ষণ ত্বকের আর্দ্রতা ধরে রাখবে।
5. **ব্রড স্পেকট্রাম সানস্ক্রিন (SPF 50+ PA++++):** সূর্যের ক্ষতিকর ইউভিএ এবং ইউভিবি রশ্মি থেকে রক্ষা করতে অন্তত ২ আঙুল পরিমাণ ব্যবহার করুন।

---

#### 🌙 রাতের রুটিন (Night PM Routine):
1. **মাইসেলার ওয়াটার বা ক্লিনজিং অয়েল:** মেকআপ, ধুলোবালি ও সানস্ক্রিনের অবশিষ্টাংশ তুলে ফেলার জন্য ডাবল ক্লিনজিং করুন।
2. **সক্রিয় ট্রিটমেন্ট সিরাম:** স্যালিসিলিক এসিড (BHA) বা রেটিনল সিরাম সপ্তাহে ৩ রাত ব্যবহার করুন।
3. **ব্যারিয়ার রিপেয়ারিং নাইট ক্রিম:** সেরামাইড ও পেপটাইড সমৃদ্ধ ক্রিম দিয়ে ত্বক লক করুন।

> 💡 **বাংলাদেশের আবহাওয়ার জন্য বিশেষ টিপস:** অতিরিক্ত আর্দ্রতার কারণে কখনোই সানস্ক্রিন বাদ দেবেন না এবং প্রচুর পরিমাণ পানি পান করুন।";
    }
}
