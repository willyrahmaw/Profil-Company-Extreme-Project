<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Helpers\ImageHelper;

class SettingController extends Controller
{
    /**
     * Show the form for editing the settings.
     */
    public function edit(): View
    {
        $setting = Setting::first();
        return view('admin.settings.edit', compact('setting'));
    }

    /**
     * Update the settings in storage.
     */
    public function update(Request $request): RedirectResponse
    {
        $setting = Setting::firstOrCreate([], [
            'website_name' => 'Extreme Project',
            'meta_title' => 'Extreme Project - Why Choose Me',
        ]);

        $validated = $request->validate([
            // Core
            'website_name'         => 'required|string|max:255',
            'meta_title'           => 'required|string|max:255',
            'meta_description'     => 'nullable|string',
            'meta_keywords'        => 'nullable|string',
            // Files
            'favicon'              => 'nullable|file|mimes:ico,png,jpg,jpeg|max:1024',
            'logo'                 => 'nullable|file|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'logo_light'           => 'nullable|file|mimes:png,jpg,jpeg,svg,webp|max:2048',
            // Open Graph
            'og_title'             => 'nullable|string|max:255',
            'og_description'       => 'nullable|string',
            'og_image'             => 'nullable|file|mimes:png,jpg,jpeg,webp|max:2048',
            'og_type'              => 'nullable|string|in:website,article,product',
            // Twitter Card
            'twitter_card'         => 'nullable|string|in:summary,summary_large_image',
            'twitter_site'         => 'nullable|string|max:100',
            'twitter_image'        => 'nullable|url|max:500',
            // Technical SEO
            'canonical_url'        => 'nullable|url|max:500',
            'robots'               => [
                'nullable',
                'string',
                \Illuminate\Validation\Rule::in(['index, follow', 'noindex, nofollow', 'index, nofollow', 'noindex, follow'])
            ],
            // Business / Schema
            'business_name'        => 'nullable|string|max:255',
            'business_type'        => 'nullable|string|in:LocalBusiness,Store,Organization',
            'business_phone'       => 'nullable|string|max:50',
            'business_city'        => 'nullable|string|max:100',
            // Analytics
            'google_analytics_id'  => 'nullable|string|max:50',
            // WhatsApp Template
            'wa_template'          => 'nullable|string',
        ]);

        $data = [
            'website_name'        => $validated['website_name'],
            'meta_title'          => $validated['meta_title'],
            'meta_description'    => $validated['meta_description']    ?? null,
            'meta_keywords'       => $validated['meta_keywords']       ?? null,
            // Open Graph
            'og_title'            => $validated['og_title']            ?? null,
            'og_description'      => $validated['og_description']      ?? null,
            'og_type'             => $validated['og_type']             ?? 'website',
            // Twitter Card
            'twitter_card'        => $validated['twitter_card']        ?? 'summary_large_image',
            'twitter_site'        => $validated['twitter_site']        ?? null,
            'twitter_image'       => $validated['twitter_image']       ?? null,
            // Technical SEO
            'canonical_url'       => $validated['canonical_url']       ?? null,
            'robots'              => $validated['robots']              ?? 'index, follow',
            // Business / Schema
            'business_name'       => $validated['business_name']       ?? null,
            'business_type'       => $validated['business_type']       ?? 'LocalBusiness',
            'business_phone'      => $validated['business_phone']      ?? null,
            'business_city'       => $validated['business_city']       ?? null,
            // Analytics
            'google_analytics_id' => $validated['google_analytics_id'] ?? null,
            // WhatsApp Template
            'wa_template'         => $validated['wa_template']         ?? null,
        ];

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            if ($setting->favicon_path) {
                $oldFavicon = str_replace('/storage/', '', $setting->favicon_path);
                Storage::disk('public')->delete($oldFavicon);
            }
            $path = ImageHelper::storeAsWebp($request->file('favicon'), 'settings');
            $data['favicon_path'] = '/storage/' . $path;
        }

        // Handle logo upload
        if ($request->hasFile('logo')) {
            if ($setting->logo_path) {
                $oldLogo = str_replace('/storage/', '', $setting->logo_path);
                Storage::disk('public')->delete($oldLogo);
            }
            $path = ImageHelper::storeAsWebp($request->file('logo'), 'settings');
            $data['logo_path'] = '/storage/' . $path;
        }

        // Handle logo light upload
        if ($request->hasFile('logo_light')) {
            if ($setting->logo_light_path) {
                $oldLogoLight = str_replace('/storage/', '', $setting->logo_light_path);
                Storage::disk('public')->delete($oldLogoLight);
            }
            $path = ImageHelper::storeAsWebp($request->file('logo_light'), 'settings');
            $data['logo_light_path'] = '/storage/' . $path;
        }

        // Handle OG Image file upload
        if ($request->hasFile('og_image')) {
            if ($setting->og_image) {
                $oldOgImage = str_replace('/storage/', '', $setting->og_image);
                // Only delete if it starts with the local storage prefix
                if (strpos($setting->og_image, '/storage/') === 0) {
                    Storage::disk('public')->delete($oldOgImage);
                }
            }
            $path = ImageHelper::storeAsWebp($request->file('og_image'), 'settings');
            $data['og_image'] = '/storage/' . $path;
        }

        $setting->update($data);

        return redirect()->route('admin.settings.edit')->with('success', 'Pengaturan website berhasil diperbarui.');
    }
}
