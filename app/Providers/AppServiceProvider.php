<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;
use App\Models\Shop;
use App\Models\Event;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            try {
                $siteSettings = null;
                $defaultWaUrl = 'https://wa.me/628123456789';
                $hasActiveEvent = false;
                $discountPercentage = 0;
                $activeEvent = null;

                if (Schema::hasTable('settings')) {
                    $siteSettings = Setting::first();
                }

                if (Schema::hasTable('shops')) {
                    $firstWhatsapp = Shop::where('platform', 'whatsapp')->where('is_active', true)->first();
                    if ($firstWhatsapp) {
                        $defaultWaUrl = $firstWhatsapp->url;
                    }
                }

                if (Schema::hasTable('events')) {
                    $now = now();
                    $activeEvent = Event::where('is_active', true)
                        ->where(function ($query) use ($now) {
                            $query->whereNull('start_date')
                                  ->orWhere('start_date', '<=', $now);
                        })
                        ->where(function ($query) use ($now) {
                            $query->whereNull('end_date')
                                  ->orWhere('end_date', '>=', $now);
                        })
                        ->first();
                    
                    if ($activeEvent) {
                        $hasActiveEvent = true;
                        $discountPercentage = $activeEvent->discount_percentage;
                    }
                }

                $view->with(compact('siteSettings', 'defaultWaUrl', 'hasActiveEvent', 'discountPercentage', 'activeEvent'));
            } catch (\Exception $e) {
                $view->with([
                    'siteSettings' => null,
                    'defaultWaUrl' => 'https://wa.me/628123456789',
                    'hasActiveEvent' => false,
                    'discountPercentage' => 0,
                    'activeEvent' => null,
                ]);
            }
        });
    }
}
