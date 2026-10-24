<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'region',
        'location',
        'category',
        'rating',
        'reviews_count',
        'price',
        'duration',
        'best_time',
        'image',
        'description',
        'highlights',
        'is_featured',
    ];

    protected $casts = [
        'highlights' => 'array',
        'rating' => 'float',
        'price' => 'integer',
        'reviews_count' => 'integer',
        'is_featured' => 'boolean',
    ];

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }
}
