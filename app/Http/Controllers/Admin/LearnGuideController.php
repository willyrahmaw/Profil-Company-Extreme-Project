<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LearnGuide;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class LearnGuideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $guides = LearnGuide::orderBy('order_position', 'asc')->paginate(10)->withQueryString();
        return view('admin.guides.index', compact('guides'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.guides.form', [
            'guide' => new LearnGuide([
                'order_position' => 0,
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
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'order_position' => 'required|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_active'] = $request->has('is_active');

        LearnGuide::create($validated);

        return redirect()
            ->route('admin.guides.index')
            ->with('success', 'Panduan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LearnGuide $guide): View
    {
        return view('admin.guides.form', [
            'guide' => $guide,
            'isEdit' => true,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LearnGuide $guide): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'order_position' => 'required|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_active'] = $request->has('is_active');

        $guide->update($validated);

        return redirect()
            ->route('admin.guides.index')
            ->with('success', 'Panduan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LearnGuide $guide): RedirectResponse
    {
        $guide->delete();

        return redirect()
            ->route('admin.guides.index')
            ->with('success', 'Panduan berhasil dihapus.');
    }
}
