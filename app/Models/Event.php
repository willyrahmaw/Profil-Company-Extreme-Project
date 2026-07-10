<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'discount_percentage',
        'start_date',
        'end_date',
        'is_active',
        'image_path',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'discount_percentage' => 'integer',
            'start_date' => 'datetime',
            'end_date' => 'datetime',
        ];
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::saving(function (Event $event) {
            if ($event->is_active) {
                // Deactivate all other events when this one is set to active
                static::where('id', '!=', $event->id)->update(['is_active' => false]);
            }
        });
    }
}
