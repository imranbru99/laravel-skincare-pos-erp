<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'district',
        'skin_type',
        'skin_concerns',
        'loyalty_points',
        'notes',
    ];

    protected $casts = [
        'skin_concerns' => 'array',
        'loyalty_points' => 'integer',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(ClinicAppointment::class);
    }
}
