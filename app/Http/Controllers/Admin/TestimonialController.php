<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $testimonials = Testimonial::orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.testimonials.form', [
            'testimonial' => new Testimonial([
                'stars' => 5,
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
            'content' => 'required|string',
            'stars' => 'required|integer|min:1|max:5',
            'avatar_initial' => 'nullable|string|max:2',
        ]);

        // Auto fill avatar initial if empty
        if (empty($validated['avatar_initial'])) {
            $validated['avatar_initial'] = strtoupper(substr($validated['name'], 0, 1));
        }

        $validated['is_active'] = $request->has('is_active');

        Testimonial::create($validated);

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimoni berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial): View
    {
        return view('admin.testimonials.form', [
            'testimonial' => $testimonial,
            'isEdit' => true,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimonial $testimonial): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'stars' => 'required|integer|min:1|max:5',
            'avatar_initial' => 'nullable|string|max:2',
        ]);

        // Auto fill avatar initial if empty
        if (empty($validated['avatar_initial'])) {
            $validated['avatar_initial'] = strtoupper(substr($validated['name'], 0, 1));
        }

        $validated['is_active'] = $request->has('is_active');

        $testimonial->update($validated);

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimoni berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->delete();

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimoni berhasil dihapus.');
    }
}
