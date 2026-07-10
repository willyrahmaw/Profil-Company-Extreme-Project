<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            // Open Graph / Social
            $table->string('og_title')->nullable()->after('meta_keywords');
            $table->text('og_description')->nullable()->after('og_title');
            $table->string('og_image')->nullable()->after('og_description');
            $table->string('og_type')->default('website')->after('og_image');

            // Twitter Card
            $table->string('twitter_card')->default('summary_large_image')->after('og_type');
            $table->string('twitter_site')->nullable()->after('twitter_card'); // @handle
            $table->string('twitter_image')->nullable()->after('twitter_site');

            // Technical SEO
            $table->string('canonical_url')->nullable()->after('twitter_image');
            $table->string('robots')->default('index, follow')->after('canonical_url');

            // Business / Schema
            $table->string('business_name')->nullable()->after('robots');
            $table->string('business_type')->default('LocalBusiness')->after('business_name');
            $table->string('business_phone')->nullable()->after('business_type');
            $table->string('business_city')->nullable()->after('business_phone');
            $table->string('business_country')->default('ID')->after('business_city');

            // Analytics
            $table->string('google_analytics_id')->nullable()->after('business_country');
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'og_title', 'og_description', 'og_image', 'og_type',
                'twitter_card', 'twitter_site', 'twitter_image',
                'canonical_url', 'robots',
                'business_name', 'business_type', 'business_phone', 'business_city', 'business_country',
                'google_analytics_id',
            ]);
        });
    }
};
