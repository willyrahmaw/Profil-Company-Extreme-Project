<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('website_name');
            $table->string('meta_title');
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('favicon_path')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('logo_light_path')->nullable();
            $table->timestamps();
        });

        // Insert default initial setting
        DB::table('settings')->insert([
            'website_name' => 'Extreme Project',
            'meta_title' => 'Extreme Project - Why Choose Me',
            'meta_description' => 'Koleksi coil vape handmade premium dan kapas wicking organik 100% kimia bebas dari Extreme Project. Dirancang khusus untuk memecah layer rasa liquid secara maksimal.',
            'meta_keywords' => 'extreme project, handmade coil, vape cotton, alien fused clapton, reaktor rasa, coil building indonesia',
            'favicon_path' => null,
            'logo_path' => null,
            'logo_light_path' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
