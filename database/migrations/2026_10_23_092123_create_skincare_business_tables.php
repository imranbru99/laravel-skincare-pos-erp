<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Branches / Showrooms & Central Warehouse
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('address');
            $table->string('city')->default('Dhaka');
            $table->boolean('is_central_warehouse')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 2. Add columns to users table
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('cashier'); // super_admin, branch_manager, cashier, fulfillment, doctor, customer
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->string('phone')->nullable();
            $table->boolean('is_active')->default(true);
        });

        // 3. Categories
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('bangla_name')->nullable();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 4. Brands
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('country_of_origin')->default('South Korea');
            $table->string('logo')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 5. Products (Skincare Specific Attributes)
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->nullable()->constrained('brands')->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('name');
            $table->string('bangla_name')->nullable();
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->string('barcode')->nullable()->index();
            
            // Skincare parameters
            $table->json('skin_types')->nullable(); // ['oily', 'dry', 'combination', 'sensitive', 'normal']
            $table->json('skin_concerns')->nullable(); // ['acne', 'pigmentation', 'aging', 'dark_spots', 'hydration', 'pores']
            $table->text('ingredients')->nullable();
            $table->text('bangla_ingredients')->nullable();
            $table->string('country_of_origin')->default('South Korea');
            $table->boolean('bsti_certified')->default(true);
            $table->string('spf_rating')->nullable(); // SPF 50+ PA++++
            $table->string('volume_or_weight')->nullable(); // 50ml, 150ml, 30g
            
            // Financials & Stock alert
            $table->decimal('purchase_price', 10, 2)->default(0);
            $table->decimal('regular_price', 10, 2)->default(0);
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->integer('stock_alert_quantity')->default(5);
            
            // Content
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->longText('bangla_description')->nullable();
            $table->text('how_to_use')->nullable();
            $table->string('image')->nullable();
            $table->json('gallery')->nullable();
            
            // Funnel Landing Page & Status
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_landing_page_active')->default(false);
            $table->string('landing_headline')->nullable();
            $table->string('landing_video_url')->nullable();
            $table->text('landing_highlights')->nullable();
            
            $table->timestamps();
        });

        // 6. Product Batches (Batch & Expiry Management for genuine skincare)
        Schema::create('product_batches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->foreignId('branch_id')->constrained('branches')->cascadeOnDelete();
            $table->string('batch_number');
            $table->date('mfg_date')->nullable();
            $table->date('expiry_date');
            $table->integer('quantity')->default(0);
            $table->decimal('purchase_rate', 10, 2)->default(0);
            $table->timestamps();
        });

        // 7. Branch Inventory / Stocks
        Schema::create('branch_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained('branches')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->integer('stock_quantity')->default(0);
            $table->string('shelf_location')->nullable();
            $table->timestamps();

            $table->unique(['branch_id', 'product_id']);
        });

        // 8. Customers
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->string('district')->default('Dhaka');
            $table->string('skin_type')->nullable(); // oily, dry, combo, sensitive, normal
            $table->json('skin_concerns')->nullable();
            $table->integer('loyalty_points')->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // 9. Orders
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('customer_id')->nullable()->constrained('customers')->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete(); // created by / cashier
            
            // Customer Info Snapshot
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->text('delivery_address')->nullable();
            $table->string('delivery_zone')->default('inside_dhaka'); // inside_dhaka, sub_dhaka, outside_dhaka
            $table->string('delivery_city')->default('Dhaka');
            
            // Financials (BDT ৳)
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('delivery_charge', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->decimal('paid_amount', 10, 2)->default(0);
            $table->decimal('due_amount', 10, 2)->default(0);
            
            // Methods & Status
            $table->string('order_type')->default('online'); // online, landing_page, pos, wholesale
            $table->string('payment_method')->default('cod'); // cod, bkash, nagad, card, cash, split
            $table->string('payment_status')->default('pending'); // pending, paid, partially_paid
            $table->string('status')->default('pending'); // pending, confirmed, processing, packaged, in_transit, delivered, cancelled, returned, exchanged
            
            // Bangladeshi Courier Logistics
            $table->string('courier_name')->nullable(); // Steadfast, Pathao, RedX, In-house
            $table->string('courier_tracking_code')->nullable();
            $table->string('courier_consignment_id')->nullable();
            $table->string('courier_status')->nullable();
            
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // 10. Order Items
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->string('product_name');
            $table->decimal('unit_price', 10, 2);
            $table->integer('quantity');
            $table->decimal('total_price', 10, 2);
            $table->timestamps();
        });

        // 11. Stock Transfers (Requisition & Transfer Challan between Branches)
        Schema::create('stock_transfers', function (Blueprint $table) {
            $table->id();
            $table->string('transfer_number')->unique();
            $table->foreignId('from_branch_id')->constrained('branches')->cascadeOnDelete();
            $table->foreignId('to_branch_id')->constrained('branches')->cascadeOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status')->default('pending'); // pending, approved, dispatched, received, rejected
            $table->text('notes')->nullable();
            $table->timestamp('dispatched_at')->nullable();
            $table->timestamp('received_at')->nullable();
            $table->timestamps();
        });

        // 12. Stock Transfer Items
        Schema::create('stock_transfer_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_transfer_id')->constrained('stock_transfers')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->integer('quantity_requested');
            $table->integer('quantity_transferred')->default(0);
            $table->integer('quantity_received')->default(0);
            $table->timestamps();
        });

        // 13. Clinic & Dermatologist Appointments
        Schema::create('clinic_appointments', function (Blueprint $table) {
            $table->id();
            $table->string('appointment_number')->unique();
            $table->foreignId('customer_id')->nullable()->constrained('customers')->nullOnDelete();
            $table->foreignId('branch_id')->constrained('branches')->cascadeOnDelete();
            $table->foreignId('doctor_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->date('appointment_date');
            $table->string('appointment_time');
            $table->json('skin_concerns')->nullable();
            $table->text('symptoms')->nullable();
            $table->text('doctor_prescription')->nullable();
            $table->json('recommended_products')->nullable(); // Array of product IDs
            $table->decimal('consultation_fee', 10, 2)->default(500);
            $table->string('payment_status')->default('pending');
            $table->string('status')->default('scheduled'); // scheduled, in_consultation, completed, cancelled
            $table->timestamps();
        });

        // 14. POS Cash Registers (Daily Opening / Closing Balances per branch counter)
        Schema::create('pos_cash_registers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained('branches')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->decimal('opening_amount', 10, 2)->default(0);
            $table->decimal('closing_amount', 10, 2)->nullable();
            $table->decimal('total_cash_sales', 10, 2)->default(0);
            $table->decimal('total_digital_sales', 10, 2)->default(0); // bKash, Nagad, Card
            $table->string('status')->default('open'); // open, closed
            $table->timestamp('opened_at')->useCurrent();
            $table->timestamp('closed_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // 15. Modular System Feature Flags (Switchable modules)
        Schema::create('system_modules', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('name');
            $table->text('description');
            $table->string('icon')->default('heroicon-o-puzzle-piece');
            $table->string('category')->default('core');
            $table->boolean('is_enabled')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_modules');
        Schema::dropIfExists('pos_cash_registers');
        Schema::dropIfExists('clinic_appointments');
        Schema::dropIfExists('stock_transfer_items');
        Schema::dropIfExists('stock_transfers');
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('branch_stocks');
        Schema::dropIfExists('product_batches');
        Schema::dropIfExists('products');
        Schema::dropIfExists('brands');
        Schema::dropIfExists('categories');
        
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['branch_id']);
            $table->dropColumn(['role', 'branch_id', 'phone', 'is_active']);
        });
        
        Schema::dropIfExists('branches');
    }
};
