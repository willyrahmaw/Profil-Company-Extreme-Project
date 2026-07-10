<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Helpers\ImageHelper;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $events = Event::orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.events.form', [
            'event' => new Event([
                'discount_percentage' => 10,
                'is_active' => true,
                'start_date' => now(),
                'end_date' => now()->addDays(7),
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
            'discount_percentage' => 'required|integer|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
        ], [
            'name.required' => 'Nama event wajib diisi.',
            'name.string' => 'Nama event harus berupa teks.',
            'name.max' => 'Nama event maksimal berisi 255 karakter.',
            'discount_percentage.required' => 'Persentase diskon wajib diisi.',
            'discount_percentage.integer' => 'Persentase diskon harus berupa angka.',
            'discount_percentage.min' => 'Persentase diskon minimal 0%.',
            'discount_percentage.max' => 'Persentase diskon maksimal 100%.',
            'start_date.required' => 'Tanggal mulai wajib diisi.',
            'start_date.date' => 'Format tanggal mulai tidak valid.',
            'end_date.required' => 'Tanggal selesai wajib diisi.',
            'end_date.date' => 'Format tanggal selesai tidak valid.',
            'end_date.after' => 'Tanggal selesai harus jatuh setelah tanggal mulai.',
            'image.image' => 'Berkas harus berupa gambar.',
            'image.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg, webp, gif.',
            'image.max' => 'Ukuran gambar maksimal adalah 2MB.',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $path = ImageHelper::storeAsWebp($request->file('image'), 'events');
            $validated['image_path'] = '/storage/' . $path;
        }

        Event::create($validated);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event): View
    {
        return view('admin.events.form', [
            'event' => $event,
            'isEdit' => true,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'discount_percentage' => 'required|integer|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
        ], [
            'name.required' => 'Nama event wajib diisi.',
            'name.string' => 'Nama event harus berupa teks.',
            'name.max' => 'Nama event maksimal berisi 255 karakter.',
            'discount_percentage.required' => 'Persentase diskon wajib diisi.',
            'discount_percentage.integer' => 'Persentase diskon harus berupa angka.',
            'discount_percentage.min' => 'Persentase diskon minimal 0%.',
            'discount_percentage.max' => 'Persentase diskon maksimal 100%.',
            'start_date.required' => 'Tanggal mulai wajib diisi.',
            'start_date.date' => 'Format tanggal mulai tidak valid.',
            'end_date.required' => 'Tanggal selesai wajib diisi.',
            'end_date.date' => 'Format tanggal selesai tidak valid.',
            'end_date.after' => 'Tanggal selesai harus jatuh setelah tanggal mulai.',
            'image.image' => 'Berkas harus berupa gambar.',
            'image.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg, webp, gif.',
            'image.max' => 'Ukuran gambar maksimal adalah 2MB.',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($event->image_path) {
                $oldPath = str_replace('/storage/', '', $event->image_path);
                Storage::disk('public')->delete($oldPath);
            }
            $path = ImageHelper::storeAsWebp($request->file('image'), 'events');
            $validated['image_path'] = '/storage/' . $path;
        }

        $event->update($validated);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event): RedirectResponse
    {
        if ($event->image_path) {
            $oldPath = str_replace('/storage/', '', $event->image_path);
            Storage::disk('public')->delete($oldPath);
        }

        $event->delete();

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event berhasil dihapus.');
    }
}
