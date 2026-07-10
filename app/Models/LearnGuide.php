<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearnGuide extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'order_position',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order_position' => 'integer',
    ];
}
