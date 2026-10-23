<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClinicAppointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_number',
        'customer_id',
        'branch_id',
        'doctor_id',
        'customer_name',
        'customer_phone',
        'appointment_date',
        'appointment_time',
        'skin_concerns',
        'symptoms',
        'doctor_prescription',
        'recommended_products',
        'consultation_fee',
        'payment_status',
        'status',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'skin_concerns' => 'array',
        'recommended_products' => 'array',
        'consultation_fee' => 'decimal:2',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public static function generateAppointmentNumber(): string
    {
        return 'APT-' . now()->format('ymd') . '-' . strtoupper(substr(uniqid(), -4));
    }
}
