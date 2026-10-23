<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductBatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'branch_id',
        'batch_number',
        'mfg_date',
        'expiry_date',
        'quantity',
        'purchase_rate',
    ];

    protected $casts = [
        'mfg_date' => 'date',
        'expiry_date' => 'date',
        'quantity' => 'integer',
        'purchase_rate' => 'decimal:2',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function isExpiringSoon(int $days = 60): bool
    {
        return $this->expiry_date->isFuture() && $this->expiry_date->diffInDays(now()) <= $days;
    }

    public function isExpired(): bool
    {
        return $this->expiry_date->isPast();
    }
}
