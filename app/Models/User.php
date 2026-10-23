<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'branch_id',
        'phone',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function cashRegisters(): HasMany
    {
        return $this->hasMany(PosCashRegister::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(ClinicAppointment::class, 'doctor_id');
    }

    // Role checks
    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    public function isBranchManager(): bool
    {
        return $this->role === 'branch_manager';
    }

    public function isCashier(): bool
    {
        return $this->role === 'cashier';
    }

    public function isFulfillment(): bool
    {
        return $this->role === 'fulfillment';
    }

    public function isDoctor(): bool
    {
        return $this->role === 'doctor';
    }

    public function isCustomer(): bool
    {
        return $this->role === 'customer';
    }

    public function canAccessPanel(Panel $panel): bool
    {
        // Active staff members can access the Filament panel
        return (bool) $this->is_active && $this->role !== 'customer';
    }
}
