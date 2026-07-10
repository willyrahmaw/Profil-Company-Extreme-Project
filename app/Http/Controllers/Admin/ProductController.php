<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageHelper;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.products.form', [
            'product' => new Product([
                'category' => 'coil',
                'specifications' => [
                    'flavor' => 3,
                    'sweetness' => 3,
                    'throat_hit' => 3,
                ]
            ]),
            'isEdit' => false,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $path = ImageHelper::storeAsWebp($request->file('image'), 'products');
            $data['image_path'] = '/storage/' . $path;
        }

        Product::create($data);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        return view('admin.products.form', [
            'product' => $product,
            'isEdit' => true,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($product->image_path) {
                $oldPath = str_replace('/storage/', '', $product->image_path);
                Storage::disk('public')->delete($oldPath);
            }
            $path = ImageHelper::storeAsWebp($request->file('image'), 'products');
            $data['image_path'] = '/storage/' . $path;
        }

        $product->update($data);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        if ($product->image_path) {
            $oldPath = str_replace('/storage/', '', $product->image_path);
            Storage::disk('public')->delete($oldPath);
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }

    /**
     * Update the stock of the specified product via AJAX.
     */
    public function updateStock(\Illuminate\Http\Request $request, Product $product): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validate([
            'stock' => 'required|integer|min:0',
        ]);

        $product->update([
            'stock' => $validated['stock'],
        ]);

        return response()->json([
            'success' => true,
            'stock' => $product->stock,
        ]);
    }
}
