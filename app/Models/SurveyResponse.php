<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyResponse extends Model
{
    protected $fillable = [
        'ip_address',
        'session_id',
        'answers',
    ];

    protected $casts = [
        'answers' => 'array',
    ];
}
