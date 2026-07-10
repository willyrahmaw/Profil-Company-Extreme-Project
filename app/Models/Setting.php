<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'website_name',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'favicon_path',
        'logo_path',
        'logo_light_path',
        // Open Graph
        'og_title',
        'og_description',
        'og_image',
        'og_type',
        // Twitter Card
        'twitter_card',
        'twitter_site',
        'twitter_image',
        // Technical SEO
        'canonical_url',
        'robots',
        // Business / Schema
        'business_name',
        'business_type',
        'business_phone',
        'business_city',
        'business_country',
        // Analytics
        'google_analytics_id',
        // WhatsApp Template
        'wa_template',
    ];
}
