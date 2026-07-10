<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $shops = Shop::orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        return view('admin.shops.index', compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.shops.form', [
            'shop' => new Shop([
                'platform' => 'tiktok',
                'is_active' => true,
            ]),
            'isEdit' => false,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'platform' => 'required|in:tiktok,whatsapp,instagram,blibli,tokopedia,taco',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Shop::create($validated);

        return redirect()
            ->route('admin.shops.index')
            ->with('success', 'Toko berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shop $shop): View
    {
        return view('admin.shops.form', [
            'shop' => $shop,
            'isEdit' => true,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shop $shop): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'platform' => 'required|in:tiktok,whatsapp,instagram,blibli,tokopedia,taco',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $shop->update($validated);

        return redirect()
            ->route('admin.shops.index')
            ->with('success', 'Toko berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shop $shop): RedirectResponse
    {
        $shop->delete();

        return redirect()
            ->route('admin.shops.index')
            ->with('success', 'Toko berhasil dihapus.');
    }
}
