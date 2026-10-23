<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use ImranDev\UniversalSlug\SlugOptions;
use ImranDev\UniversalSlug\Traits\HasUniversalSlug;

class Product extends Model
{
    use HasFactory, HasUniversalSlug;

    protected $fillable = [
        'brand_id',
        'category_id',
        'name',
        'bangla_name',
        'slug',
        'sku',
        'barcode',
        'skin_types',
        'skin_concerns',
        'ingredients',
        'bangla_ingredients',
        'country_of_origin',
        'bsti_certified',
        'spf_rating',
        'volume_or_weight',
        'purchase_price',
        'regular_price',
        'sale_price',
        'stock_alert_quantity',
        'short_description',
        'description',
        'bangla_description',
        'how_to_use',
        'image',
        'gallery',
        'is_active',
        'is_featured',
        'is_landing_page_active',
        'landing_headline',
        'landing_video_url',
        'landing_highlights',
    ];

    protected $casts = [
        'skin_types' => 'array',
        'skin_concerns' => 'array',
        'gallery' => 'array',
        'bsti_certified' => 'boolean',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'is_landing_page_active' => 'boolean',
        'purchase_price' => 'decimal:2',
        'regular_price' => 'decimal:2',
        'sale_price' => 'decimal:2',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function batches(): HasMany
    {
        return $this->hasMany(ProductBatch::class);
    }

    public function branchStocks(): HasMany
    {
        return $this->hasMany(BranchStock::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getTotalStockAttribute(): int
    {
        return (int) $this->branchStocks()->sum('stock_quantity');
    }

    public function getEffectivePriceAttribute(): float
    {
        return (float) ($this->sale_price && $this->sale_price > 0 ? $this->sale_price : $this->regular_price);
    }

    public function getStockForBranch(int $branchId): int
    {
        return (int) ($this->branchStocks()->where('branch_id', $branchId)->value('stock_quantity') ?? 0);
    }
}
