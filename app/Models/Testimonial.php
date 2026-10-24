<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'trip',
        'avatar',
        'comment',
        'rating',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];
}
