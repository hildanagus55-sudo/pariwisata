<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_code',
        'item_name',
        'customer_name',
        'customer_phone',
        'customer_email',
        'travel_date',
        'pax',
        'addon_drone',
        'addon_vip',
        'promo_code',
        'discount_amount',
        'total_price',
        'status',
        'notes',
    ];

    protected $casts = [
        'travel_date' => 'date',
        'pax' => 'integer',
        'addon_drone' => 'boolean',
        'addon_vip' => 'boolean',
        'discount_amount' => 'integer',
        'total_price' => 'integer',
    ];

    public function getFormattedTotalPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->total_price, 0, ',', '.');
    }

    public function getFormattedDiscountAttribute(): string
    {
        return 'Rp ' . number_format($this->discount_amount, 0, ',', '.');
    }
}
