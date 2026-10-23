<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\BranchStock;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ClinicAppointment;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductBatch;
use App\Models\SystemModule;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('Seeding Bangladeshi Skincare Business Suite...');

        // 1. System Modules (Feature Flags)
        $modules = [
            ['key' => 'module_catalog', 'name' => 'কোর ক্যাটালগ ও ইনভেন্টরি', 'description' => 'পণ্য ক্যাটালগ, ব্যাচ নম্বর ও স্টক ট্র্যাকিং', 'icon' => 'heroicon-o-cube', 'category' => 'core', 'is_enabled' => true],
            ['key' => 'module_online_store', 'name' => 'অনলাইন স্টোর ও শপ', 'description' => 'পাবলিক ইকমার্স ক্যাটালগ ও কার্ট অর্ডার', 'icon' => 'heroicon-o-shopping-bag', 'category' => 'sales', 'is_enabled' => true],
            ['key' => 'module_landing_funnels', 'name' => 'হাই-কনভার্টিং ল্যান্ডিং ফানেল', 'description' => 'বিজ্ঞাপনের জন্য সিঙ্গেল প্রোডাক্ট চেকআউট ফানেল', 'icon' => 'heroicon-o-rocket-launch', 'category' => 'sales', 'is_enabled' => true],
            ['key' => 'module_multi_branch_pos', 'name' => 'মাল্টি-ব্রাঞ্চ পিওএস (POS)', 'description' => 'শোরুম টাচস্ক্রিন ক্যাশ কাউন্টার ও রসিদ প্রিন্টিং', 'icon' => 'heroicon-o-calculator', 'category' => 'pos', 'is_enabled' => true],
            ['key' => 'module_courier_logistics', 'name' => 'স্টেডফাস্ট ও পাঠাও কুরিয়ার এপিআই', 'description' => 'স্বয়ংক্রিয় পার্সেল বুকিং ও ট্র্যাকিং সিঙ্ক', 'icon' => 'heroicon-o-truck', 'category' => 'logistics', 'is_enabled' => true],
            ['key' => 'module_clinic_appointments', 'name' => 'ডার্মাটোলজি ক্লিনিক ও কনসালট্যান্ট', 'description' => 'ডাক্তার অ্যাপয়েন্টমেন্ট ও প্রেসক্রিপশন শিডিউলিং', 'icon' => 'heroicon-o-academic-cap', 'category' => 'clinic', 'is_enabled' => true],
            ['key' => 'module_ai_skincare_hub', 'name' => 'এআই স্কিনকেয়ার ও রুটিন হাব', 'description' => 'স্কিন ডায়াগনোসিস ও বাংলা কপিরাইটিং অ্যাসিস্ট্যান্ট', 'icon' => 'heroicon-o-sparkles', 'category' => 'ai', 'is_enabled' => true],
            ['key' => 'module_biometric_attendance', 'name' => 'বায়োমেট্রিক হাজিরা মেশিন', 'description' => 'ZKTeco ডিভাইসের মাধ্যমে শোরুম স্টাফ উপস্থিতি', 'icon' => 'heroicon-o-finger-print', 'category' => 'hrm', 'is_enabled' => true],
            ['key' => 'module_wholesale_b2b', 'name' => 'হোলসেল ও বিটুবি ডিলারশিপ', 'description' => 'পাইকারি বিক্রেতাদের বাল্ক অর্ডার ও ক্রেডিট লিমিট', 'icon' => 'heroicon-o-building-office', 'category' => 'b2b', 'is_enabled' => true],
            ['key' => 'module_loyalty_rewards', 'name' => 'লয়্যালটি পয়েন্টস ও এসএমএস', 'description' => 'গ্রাহকের পয়েন্ট রিওয়ার্ড ও এসএমএস মার্কেটিং', 'icon' => 'heroicon-o-gift', 'category' => 'marketing', 'is_enabled' => true],
        ];

        foreach ($modules as $m) {
            SystemModule::updateOrCreate(['key' => $m['key']], $m);
        }

        // 2. Branches
        $warehouse = Branch::create([
            'name' => 'সেন্ট্রাল ওয়্যারহাউস (Tejgaon Central)',
            'code' => 'CWH-01',
            'phone' => '01711000001',
            'email' => 'warehouse@skincare.com',
            'address' => 'প্লট ২৪, তেজগাঁও শিল্প এলাকা, ঢাকা-১২০৮',
            'city' => 'Dhaka',
            'is_central_warehouse' => true,
            'is_active' => true,
        ]);

        $bananiBranch = Branch::create([
            'name' => 'বনানী ১১ ফ্ল্যাগশিপ শোরুম',
            'code' => 'BNN-01',
            'phone' => '01711000002',
            'email' => 'banani@skincare.com',
            'address' => 'হাউজ ১২, রোড ১১, ব্লক এফ, বনানী, ঢাকা-১২১৩',
            'city' => 'Dhaka',
            'is_central_warehouse' => false,
            'is_active' => true,
        ]);

        $dhanmondiBranch = Branch::create([
            'name' => 'ধানমন্ডি শোরুম (Shimanto Square)',
            'code' => 'DHN-01',
            'phone' => '01711000003',
            'email' => 'dhanmondi@skincare.com',
            'address' => 'শপ ৩০৫, লেভেল ৩, সীমান্ত স্কয়ার, ধানমন্ডি ২৭, ঢাকা',
            'city' => 'Dhaka',
            'is_central_warehouse' => false,
            'is_active' => true,
        ]);

        $ctgBranch = Branch::create([
            'name' => 'চট্টগ্রাম সানমার শোরুম',
            'code' => 'CTG-01',
            'phone' => '01711000004',
            'email' => 'ctg@skincare.com',
            'address' => 'সানমার ওশান সিটি, লেভেল ৪, জিইসি মোড়, চট্টগ্রাম',
            'city' => 'Chittagong',
            'is_central_warehouse' => false,
            'is_active' => true,
        ]);

        // 3. Demo Users (Password: password123 for all)
        $defaultPassword = Hash::make('password123');

        $superAdmin = User::create([
            'name' => 'Super Admin (ইমরান মাহমুদ)',
            'email' => 'superadmin@skincare.com',
            'password' => $defaultPassword,
            'role' => 'super_admin',
            'branch_id' => $warehouse->id,
            'phone' => '01711000000',
            'is_active' => true,
        ]);

        $bananiManager = User::create([
            'name' => 'নাসরিন আক্তার (Banani Manager)',
            'email' => 'banani.manager@skincare.com',
            'password' => $defaultPassword,
            'role' => 'branch_manager',
            'branch_id' => $bananiBranch->id,
            'phone' => '01711000002',
            'is_active' => true,
        ]);

        $cashier = User::create([
            'name' => 'সাদিয়া ইসলাম (Counter Cashier)',
            'email' => 'cashier@skincare.com',
            'password' => $defaultPassword,
            'role' => 'cashier',
            'branch_id' => $bananiBranch->id,
            'phone' => '01711000005',
            'is_active' => true,
        ]);

        $fulfillment = User::create([
            'name' => 'আরিফুল হক (Courier Dispatch Lead)',
            'email' => 'delivery@skincare.com',
            'password' => $defaultPassword,
            'role' => 'fulfillment',
            'branch_id' => $warehouse->id,
            'phone' => '01711000006',
            'is_active' => true,
        ]);

        $doctor = User::create([
            'name' => 'ডাঃ শারমিন জাহান (Dermatologist)',
            'email' => 'doctor@skincare.com',
            'password' => $defaultPassword,
            'role' => 'doctor',
            'branch_id' => $bananiBranch->id,
            'phone' => '01711000007',
            'is_active' => true,
        ]);

        $demoCustomerUser = User::create([
            'name' => 'তানিয়া রহমান (Customer)',
            'email' => 'customer@skincare.com',
            'password' => $defaultPassword,
            'role' => 'customer',
            'branch_id' => null,
            'phone' => '01711000008',
            'is_active' => true,
        ]);

        // 4. Brands
        $cosrx = Brand::create(['name' => 'COSRX', 'slug' => 'cosrx', 'country_of_origin' => 'South Korea', 'description' => 'বিশ্ববিখ্যাত কোরিয়ান স্কিনকেয়ার ব্র্যান্ড']);
        $boj = Brand::create(['name' => 'Beauty of Joseon', 'slug' => 'beauty-of-joseon', 'country_of_origin' => 'South Korea', 'description' => 'ঐতিহ্যবাহী কোরিয়ান হার্বাল হ্যানবাং উপাদান']);
        $ordinary = Brand::create(['name' => 'The Ordinary', 'slug' => 'the-ordinary', 'country_of_origin' => 'Canada', 'description' => 'ক্লিনিক্যাল অ্যাক্টিভ ফর্মুলেশন']);
        $cerave = Brand::create(['name' => 'CeraVe', 'slug' => 'cerave', 'country_of_origin' => 'USA', 'description' => 'ডার্মাটোলজিস্ট ডেভেলপড সেরেমায়েড কেয়ার']);
        $anua = Brand::create(['name' => 'Anua', 'slug' => 'anua', 'country_of_origin' => 'South Korea', 'description' => 'হার্টলিফ ও সুদিং স্কিনকেয়ার']);
        $roundLab = Brand::create(['name' => 'Round Lab', 'slug' => 'round-lab', 'country_of_origin' => 'South Korea', 'description' => 'ডকডো ও বার্চ জুস হাইড্রেটিং লাইন']);

        // 5. Categories
        $catCleanser = Category::create(['name' => 'Cleanser & Face Wash', 'bangla_name' => 'ক্লিনজার ও ফেসওয়াশ', 'slug' => 'cleanser']);
        $catToner = Category::create(['name' => 'Toner & Mist', 'bangla_name' => 'টোনার ও মিস্ট', 'slug' => 'toner']);
        $catSerum = Category::create(['name' => 'Serum & Essence', 'bangla_name' => 'সিরাম ও এসেন্স', 'slug' => 'serum-essence']);
        $catMoisturizer = Category::create(['name' => 'Moisturizer & Cream', 'bangla_name' => 'ময়েশ্চারাইজার ও ক্রিম', 'slug' => 'moisturizer']);
        $catSunscreen = Category::create(['name' => 'Sunscreen & Sun Stick', 'bangla_name' => 'সানস্ক্রিন ও সানস্টিক', 'slug' => 'sunscreen']);

        // 6. Products (Authentic Skincare formulations)
        $productsData = [
            [
                'brand_id' => $cosrx->id,
                'category_id' => $catSerum->id,
                'name' => 'COSRX Advanced Snail 96 Mucin Power Essence (100ml)',
                'bangla_name' => 'কোসআরএক্স স্নেল মিউসিন ৯৬ এসেন্স (১০০ মি.লি.)',
                'sku' => 'COS-SNL-96',
                'barcode' => '8809416470009',
                'skin_types' => ['all', 'dry', 'combination', 'sensitive'],
                'skin_concerns' => ['hydration', 'acne', 'dark_spots', 'barrier_damage'],
                'ingredients' => 'Snail Secretion Filtrate 96.3%, Betaine, Butylene Glycol, Sodium Hyaluronate, Panthenol, Arginine, Allantoin',
                'bangla_ingredients' => '৯৬.৩% স্নেল মিউসিন ফিলট্রেট, হায়ালুরোনিক অ্যাসিড, প্যান্থেনল ও অ্যালানটয়েন।',
                'country_of_origin' => 'South Korea',
                'bsti_certified' => true,
                'spf_rating' => null,
                'volume_or_weight' => '100ml',
                'purchase_price' => 1250.00,
                'regular_price' => 2100.00,
                'sale_price' => 1750.00,
                'stock_alert_quantity' => 10,
                'short_description' => 'কোরিয়ার এক নম্বর হাইড্রেটিং ও স্কিন রিপেয়ারিং এসেন্স।',
                'description' => 'Lightweight essence which absorbs into skin fast to give skin natural glow from inside. Formulated with 96% snail secretion filtrate.',
                'bangla_description' => 'ত্বকের গভীরে আর্দ্রতা পৌঁছে দিয়ে ক্ষতিগ্রস্ত স্কিন ব্যারিয়ার রিপেয়ার করে। ব্রণের কালো দাগ ও রোদে পোড়া ভাব দূর করে ত্বককে করে কোমল ও উজ্জ্বল।',
                'how_to_use' => 'ক্লিনজিং ও টোনারের পর ২-৩ পাম্প নিয়ে পুরো মুখে আলতো করে ট্যাপ করে মিলিয়ে দিন।',
                'is_active' => true,
                'is_featured' => true,
                'is_landing_page_active' => true,
                'landing_headline' => 'কোরিয়ান স্নেল মিউসিন ৯৬ এসেন্স - ৭ দিনে স্পষ্ট গ্লো ও সুস্থ স্কিন ব্যারিয়ার!',
                'landing_highlights' => "✓ ৯৬.৩% আসল স্নেল সিক্রেশন সমৃদ্ধ কোরিয়ান বেস্টসেলার\n✓ সব ধরনের ত্বকে ব্যবহারের উপযোগী ও নন-স্টিকি\n✓ ব্রণের গর্ত ও কালো দাগ দ্রুত দূর করে\n✓ সারা বাংলাদেশে ক্যাশ অন ডেলিভারি সুবিধা",
            ],
            [
                'brand_id' => $boj->id,
                'category_id' => $catSunscreen->id,
                'name' => 'Beauty of Joseon Relief Sun: Rice + Probiotics SPF50+ PA++++ (50ml)',
                'bangla_name' => 'বিউটি অফ জোসন রাইস প্লাস প্রোবায়োটিক সানস্ক্রিন (৫০ মি.লি.)',
                'sku' => 'BOJ-SUN-50',
                'barcode' => '8809657114977',
                'skin_types' => ['dry', 'combination', 'sensitive', 'normal'],
                'skin_concerns' => ['pigmentation', 'dark_spots', 'aging'],
                'ingredients' => 'Rice extract 30%, Grain fermented extracts, Niacinamide, Camellia Sinensis, Adenosine, Tocopherol',
                'bangla_ingredients' => '৩০% চালের নির্যাস, প্রোবায়োটিকস, নায়াসিনামাইড এবং ভিটামিন ই।',
                'country_of_origin' => 'South Korea',
                'bsti_certified' => true,
                'spf_rating' => 'SPF 50+ PA++++',
                'volume_or_weight' => '50ml',
                'purchase_price' => 950.00,
                'regular_price' => 1650.00,
                'sale_price' => 1350.00,
                'stock_alert_quantity' => 8,
                'short_description' => 'কোনো হোয়াইট কাস্ট ছাড়া হালকা অর্গানিক সানস্ক্রিন।',
                'description' => 'Gentle chemical sunscreen enriched with 30% Rice Extract and Grain Probiotics that calms and moisturizes skin.',
                'bangla_description' => 'কোনো আঠালো ভাব বা সাদা কাস্ট ফেলে না। চালের নির্যাস ত্বকের উজ্জ্বলতা বাড়ায় এবং কড়া রোদেও ইউভি রশ্মি থেকে ত্বককে সুরক্ষিত রাখে।',
                'how_to_use' => 'রোদে যাওয়ার অন্তত ২০ মিনিট আগে মুখ ও গলায় ২ আঙুল পরিমাণ নিয়ে ম্যাসাজ করুন।',
                'is_active' => true,
                'is_featured' => true,
                'is_landing_page_active' => true,
                'landing_headline' => 'কোরিয়ার ভাইরাল রাইস সানস্ক্রিন - কোনো সাদা দাগ ছাড়া পারফেক্ট সান প্রোটেকশন!',
                'landing_highlights' => "✓ এসপিএফ ৫০+ পিএ++++ সর্বোচ্চ সূর্যের ক্ষতিকর রশ্মি থেকে সুরক্ষা\n✓ কোনো সাদা দাগ (White Cast) বা আঠালো ভাব ফেলে না\n✓ মেকআপের নিচে প্রাইমার হিসেবে চমৎকার কাজ করে\n✓ অরিজিনাল বিএসটিআই ও বারকোড ভেরিফায়েড",
            ],
            [
                'brand_id' => $anua->id,
                'category_id' => $catToner->id,
                'name' => 'Anua Heartleaf 77% Soothing Toner (250ml)',
                'bangla_name' => 'আনুয়া হার্টলিফ ৭৭% সুদিং টোনার (২৫০ মি.লি.)',
                'sku' => 'ANU-TON-77',
                'barcode' => '8809640730085',
                'skin_types' => ['oily', 'acne_prone', 'sensitive', 'combination'],
                'skin_concerns' => ['acne', 'redness', 'pores'],
                'ingredients' => 'Houttuynia Cordata Extract (77%), Centella Asiatica, Chamomilla Recutita, Betaine, Panthenol, Portulaca Oleracea',
                'bangla_ingredients' => '৭৭% হার্টলিফ এক্সট্রাক্ট, সেন্টেলা এশিয়াটিকা ও ক্যামোমাইল।',
                'country_of_origin' => 'South Korea',
                'bsti_certified' => true,
                'spf_rating' => null,
                'volume_or_weight' => '250ml',
                'purchase_price' => 1400.00,
                'regular_price' => 2200.00,
                'sale_price' => 1890.00,
                'stock_alert_quantity' => 6,
                'short_description' => 'ব্রণ ও লালচে ভাব দূর করার জন্য কোরিয়ার বেস্ট সুদিং টোনার।',
                'description' => 'Sub-acidic soothing toner formulated with 77% Heartleaf extract that calms irritated and acne-prone skin.',
                'bangla_description' => 'ব্রণের প্রদাহ, লালচে ভাব ও বড় লোমকূপ শান্ত করে ত্বকের পিএইচ ব্যালান্স ঠিক রাখে।',
                'how_to_use' => 'তুলা বা হাতের তালুতে নিয়ে আলতোভাবে চেপে চেপে মুখে বসিয়ে দিন।',
                'is_active' => true,
                'is_featured' => true,
                'is_landing_page_active' => true,
                'landing_headline' => 'আনুয়া ৭৭% হার্টলিফ টোনার - এক রাতেই শান্ত করুন লালচে ব্রণ ও অ্যালার্জি!',
                'landing_highlights' => "✓ ৭৭% প্রাকৃতিক হার্টলিফ এক্সট্রাক্ট সমৃদ্ধ অ্যান্টি-অ্যাকনে টোনার\n✓ ত্বকের অতিরিক্ত তেল ও বড় পোরস নিয়ন্ত্রণ করে\n✓ সংবেদনশীল ত্বকের জন্য শতভাগ নিরাপদ\n✓ ফ্রি ডেলিভারি ও দ্রুততম হোম ডেলিভারি",
            ],
            [
                'brand_id' => $ordinary->id,
                'category_id' => $catSerum->id,
                'name' => 'The Ordinary Niacinamide 10% + Zinc 1% (30ml)',
                'bangla_name' => 'দি অর্ডিনারি নায়াসিনামাইড ১০% প্লাস জিংক ১% (৩০ মি.লি.)',
                'sku' => 'ORD-NIA-10',
                'barcode' => '769915190312',
                'skin_types' => ['oily', 'combination', 'acne_prone'],
                'skin_concerns' => ['acne', 'dark_spots', 'pores'],
                'ingredients' => 'Niacinamide 10%, Zinc PCA 1%, Tamarindus Indica Seed Gum, Pentylene Glycol',
                'bangla_ingredients' => '১০% নায়াসিনামাইড এবং ১% জিংক পিসিএ।',
                'country_of_origin' => 'Canada',
                'bsti_certified' => true,
                'spf_rating' => null,
                'volume_or_weight' => '30ml',
                'purchase_price' => 850.00,
                'regular_price' => 1450.00,
                'sale_price' => 1190.00,
                'stock_alert_quantity' => 10,
                'short_description' => 'পোরস মিনিমাইজ ও ব্রণের দাগ কমাতে কানাডার সেরা সিরাম।',
                'description' => 'High-strength vitamin and mineral blemish formula that reduces skin blemishes and signs of congestion.',
                'bangla_description' => 'ত্বকের অতিরিক্ত তেল উৎপাদন হ্রাস করে, বড় লোমকূপ সংকুচিত করে এবং পুরোনো ব্রণের দাগ দূর করে।',
                'how_to_use' => 'সকালে ও রাতে ক্রিম ব্যবহারের পূর্বে ২-৩ ফোঁটা নিয়ে মুখে লাগান।',
                'is_active' => true,
                'is_featured' => true,
                'is_landing_page_active' => false,
            ],
            [
                'brand_id' => $cerave->id,
                'category_id' => $catCleanser->id,
                'name' => 'CeraVe Foaming Facial Cleanser for Normal to Oily Skin (236ml)',
                'bangla_name' => 'সেরাভে ফোমিং ফেসিয়াল ক্লিনজার (২৩৬ মি.লি.)',
                'sku' => 'CER-FOAM-236',
                'barcode' => '3337875597180',
                'skin_types' => ['oily', 'normal', 'combination'],
                'skin_concerns' => ['acne', 'pores'],
                'ingredients' => 'Ceramides 1, 3, 6-II, Hyaluronic Acid, Niacinamide, Phytosphingosine',
                'bangla_ingredients' => '৩টি এসেনশিয়াল সেরামাইড, হায়ালুরোনিক অ্যাসিড ও নায়াসিনামাইড।',
                'country_of_origin' => 'USA',
                'bsti_certified' => true,
                'spf_rating' => null,
                'volume_or_weight' => '236ml',
                'purchase_price' => 1350.00,
                'regular_price' => 2100.00,
                'sale_price' => 1850.00,
                'stock_alert_quantity' => 5,
                'short_description' => 'আমেরিকান ডার্মাটোলজিস্ট রিকমেন্ডেড জেন্টল ফোমিং ক্লিনজার।',
                'description' => 'Cleanses and removes oil without disrupting the protective skin barrier. Contains 3 essential ceramides.',
                'bangla_description' => 'ত্বক না শুকিয়ে ভেতর থেকে তেল ও ধুলোবালি পরিষ্কার করে এবং ত্বকের সুরক্ষা স্তর অটুট রাখে।',
                'how_to_use' => 'ভেজা মুখে সামান্য পরিমাণ ফেনা তৈরি করে ৩০-৬০ সেকেন্ড ম্যাসাজ করে ধুয়ে ফেলুন।',
                'is_active' => true,
                'is_featured' => true,
                'is_landing_page_active' => false,
            ],
            [
                'brand_id' => $roundLab->id,
                'category_id' => $catMoisturizer->id,
                'name' => 'Round Lab 1025 Dokdo Cream (80ml)',
                'bangla_name' => 'রাউন্ড ল্যাব ১০২৫ ডকডো ময়েশ্চারাইজিং ক্রিম (৮০ মি.লি.)',
                'sku' => 'RND-DOK-80',
                'barcode' => '8809657116032',
                'skin_types' => ['dry', 'sensitive', 'normal'],
                'skin_concerns' => ['hydration', 'barrier_damage'],
                'ingredients' => 'Ulleungdo Deep Sea Water, 5 kinds of Ceramides, Panthenol, Allantoin',
                'bangla_ingredients' => 'উলুংদো ডিপ সি মিনারেলস, ৫ ধরনের সেরামাইড এবং প্যান্থেনল।',
                'country_of_origin' => 'South Korea',
                'bsti_certified' => true,
                'spf_rating' => null,
                'volume_or_weight' => '80ml',
                'purchase_price' => 1300.00,
                'regular_price' => 2050.00,
                'sale_price' => 1790.00,
                'stock_alert_quantity' => 6,
                'short_description' => '২৪ ঘণ্টা ডিপ হাইড্রেশন ও স্কিন ব্যারিয়ার সুরক্ষাকারী ক্রিম।',
                'description' => 'Rich moisturizing cream packed with deep sea water minerals and 5 types of ceramides for long-lasting hydration.',
                'bangla_description' => 'শুষ্ক ও খসখসে ত্বককে মুহূর্তেই প্রাণবন্ত ও মসৃণ করে। মেকআপের পূর্বে নিখুঁত বেইস তৈরি করে।',
                'how_to_use' => 'রুটিনের শেষ ধাপে পরিমাণমতো নিয়ে মুখে ও গলায় সমানভাবে ম্যাসাজ করুন।',
                'is_active' => true,
                'is_featured' => true,
                'is_landing_page_active' => false,
            ],
        ];

        foreach ($productsData as $pData) {
            $product = Product::create($pData);

            // Seed batches with manufacturing & expiry dates
            ProductBatch::create([
                'product_id' => $product->id,
                'branch_id' => $warehouse->id,
                'batch_number' => 'LOT-KOR-' . rand(1000, 9999),
                'mfg_date' => now()->subMonths(3),
                'expiry_date' => now()->addMonths(24),
                'quantity' => 150,
                'purchase_rate' => $product->purchase_price,
            ]);

            // Seed stock across 4 branches
            BranchStock::create(['branch_id' => $warehouse->id, 'product_id' => $product->id, 'stock_quantity' => 120, 'shelf_location' => 'Row-A1']);
            BranchStock::create(['branch_id' => $bananiBranch->id, 'product_id' => $product->id, 'stock_quantity' => 35, 'shelf_location' => 'Front-Rack-2']);
            BranchStock::create(['branch_id' => $dhanmondiBranch->id, 'product_id' => $product->id, 'stock_quantity' => 25, 'shelf_location' => 'Display-C']);
            BranchStock::create(['branch_id' => $ctgBranch->id, 'product_id' => $product->id, 'stock_quantity' => 20, 'shelf_location' => 'Zone-B']);
        }

        // 7. Customers
        $customers = [
            ['name' => 'ফারজানা ববি', 'phone' => '01711223344', 'district' => 'Dhaka', 'address' => 'হাউজ ৫, রোড ৮, সেক্টর ৪, উত্তরা, ঢাকা', 'skin_type' => 'oily', 'loyalty_points' => 120],
            ['name' => 'সাবরিনা আক্তার', 'phone' => '01811334455', 'district' => 'Dhaka', 'address' => 'ব্লক সি, লালমাটিয়া, ঢাকা', 'skin_type' => 'dry', 'loyalty_points' => 340],
            ['name' => 'মেহজাবিন চৌধুরী', 'phone' => '01911445566', 'district' => 'Chittagong', 'address' => 'হালিশহর হাউজিং এস্টেট, চট্টগ্রাম', 'skin_type' => 'combination', 'loyalty_points' => 80],
            ['name' => 'নুসরাত জাহান', 'phone' => '01611556677', 'district' => 'Sylhet', 'address' => 'কুমারপাড়া, সিলেট সদর', 'skin_type' => 'sensitive', 'loyalty_points' => 210],
        ];

        foreach ($customers as $cData) {
            Customer::create($cData);
        }

        // 8. Orders across all pipelines
        $firstCustomer = Customer::first();
        $sampleProduct = Product::first();

        // Pending Online Order
        $order1 = Order::create([
            'order_number' => 'ORD-261023-A101',
            'branch_id' => $warehouse->id,
            'customer_id' => $firstCustomer->id,
            'user_id' => null,
            'customer_name' => $firstCustomer->name,
            'customer_phone' => $firstCustomer->phone,
            'delivery_address' => $firstCustomer->address,
            'delivery_zone' => 'inside_dhaka',
            'delivery_city' => 'Dhaka',
            'subtotal' => 1750.00,
            'discount' => 0,
            'delivery_charge' => 60.00,
            'total_amount' => 1810.00,
            'paid_amount' => 0,
            'due_amount' => 1810.00,
            'order_type' => 'online',
            'payment_method' => 'cod',
            'payment_status' => 'pending',
            'status' => 'pending',
            'notes' => 'ডেলিভারির পূর্বে ফোন দেবেন দয়া করে।',
        ]);
        OrderItem::create([
            'order_id' => $order1->id,
            'product_id' => $sampleProduct->id,
            'product_name' => $sampleProduct->name,
            'unit_price' => 1750.00,
            'quantity' => 1,
            'total_price' => 1750.00,
        ]);

        // Dispatched Steadfast Courier Order
        $order2 = Order::create([
            'order_number' => 'ORD-261023-B202',
            'branch_id' => $warehouse->id,
            'customer_id' => $firstCustomer->id,
            'user_id' => $fulfillment->id,
            'customer_name' => 'সাবরিনা আক্তার',
            'customer_phone' => '01811334455',
            'delivery_address' => 'ব্লক সি, লালমাটিয়া, ঢাকা',
            'delivery_zone' => 'inside_dhaka',
            'delivery_city' => 'Dhaka',
            'subtotal' => 3100.00,
            'discount' => 100.00,
            'delivery_charge' => 60.00,
            'total_amount' => 3060.00,
            'paid_amount' => 0,
            'due_amount' => 3060.00,
            'order_type' => 'landing_page',
            'payment_method' => 'cod',
            'payment_status' => 'pending',
            'status' => 'in_transit',
            'courier_name' => 'Steadfast',
            'courier_tracking_code' => 'SF82910482',
            'courier_consignment_id' => '948102',
            'courier_status' => 'in_transit',
        ]);
        OrderItem::create([
            'order_id' => $order2->id,
            'product_id' => $sampleProduct->id,
            'product_name' => $sampleProduct->name,
            'unit_price' => 1750.00,
            'quantity' => 1,
            'total_price' => 1750.00,
        ]);

        // POS Counter Sale in Banani
        $order3 = Order::create([
            'order_number' => 'POS-261023-C303',
            'branch_id' => $bananiBranch->id,
            'customer_id' => null,
            'user_id' => $cashier->id,
            'customer_name' => 'ওয়াক-ইন কাস্টমার (বনানী)',
            'customer_phone' => '01700000000',
            'delivery_address' => 'বনানী কাউন্টার ক্যাশ সেল',
            'delivery_zone' => 'inside_dhaka',
            'delivery_city' => 'Dhaka',
            'subtotal' => 1350.00,
            'discount' => 50.00,
            'delivery_charge' => 0,
            'total_amount' => 1300.00,
            'paid_amount' => 1300.00,
            'due_amount' => 0,
            'order_type' => 'pos',
            'payment_method' => 'bkash',
            'payment_status' => 'paid',
            'status' => 'delivered',
        ]);
        OrderItem::create([
            'order_id' => $order3->id,
            'product_id' => 2,
            'product_name' => 'Beauty of Joseon Relief Sun: Rice + Probiotics SPF50+',
            'unit_price' => 1350.00,
            'quantity' => 1,
            'total_price' => 1350.00,
        ]);

        // 9. Clinic Appointment
        ClinicAppointment::create([
            'appointment_number' => 'APT-261023-901',
            'customer_id' => $firstCustomer->id,
            'branch_id' => $bananiBranch->id,
            'doctor_id' => $doctor->id,
            'customer_name' => $firstCustomer->name,
            'customer_phone' => $firstCustomer->phone,
            'appointment_date' => now()->addDays(2),
            'appointment_time' => '05:30 PM',
            'skin_concerns' => ['severe_acne', 'hyperpigmentation'],
            'symptoms' => 'গালে লালচে ব্রণ ও রোদ লাগলেই চুলকানি ও পোড়া ভাব।',
            'doctor_prescription' => 'প্রতিদিন রাতে জেন্টল ফোমিং ক্লিনজার ও দিনে এসপিএফ ৫০ সানস্ক্রিন ব্যবহার করবেন। কড়া রোদে ছাতা ব্যবহার বাধ্যতামূলক।',
            'recommended_products' => [$sampleProduct->id],
            'consultation_fee' => 800.00,
            'payment_status' => 'paid',
            'status' => 'scheduled',
        ]);

        $this->command->info('Database seeded successfully with all demo users, products, branches, and orders!');
    }
}
