<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Store a newly created order log in storage.
     *
     * Prices are always taken from the database (including the active event
     * discount); any price sent by the client is ignored.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'buyer_name'         => 'required|string|max:255',
            'buyer_address'      => 'required|string|max:1000',
            'items'              => 'required|array|min:1|max:50',
            'items.*.product_id' => 'required|integer|distinct|exists:products,id',
            'items.*.quantity'   => 'required|integer|min:1|max:1000',
        ]);

        $products = Product::whereIn('id', array_column($validated['items'], 'product_id'))->get()->keyBy('id');
        $discountPercentage = Event::active()->value('discount_percentage') ?? 0;

        $order = DB::transaction(function () use ($validated, $products, $discountPercentage) {
            $lines = array_map(function (array $item) use ($products, $discountPercentage) {
                $product = $products[$item['product_id']];
                $price = round((float) $product->price * (1 - $discountPercentage / 100), 2);

                return [
                    'product_title' => $product->title,
                    'quantity'      => $item['quantity'],
                    'price'         => $price,
                    'total_price'   => round($price * $item['quantity'], 2),
                ];
            }, $validated['items']);

            $order = Order::create([
                'buyer_name'    => $validated['buyer_name'],
                'buyer_address' => $validated['buyer_address'],
                'total_price'   => array_sum(array_column($lines, 'total_price')),
            ]);

            $order->items()->createMany($lines);

            return $order;
        });

        return response()->json([
            'success' => true,
            'message' => 'Pesanan berhasil dicatat.',
            'order'   => $order->load('items'),
        ], 201);
    }
}
