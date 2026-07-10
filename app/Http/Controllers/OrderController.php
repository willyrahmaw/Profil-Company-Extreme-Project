<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Store a newly created order log in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'buyer_name'    => 'required|string|max:255',
            'buyer_address' => 'required|string',
            'total_price'   => 'required|numeric|min:0',
            'items'         => 'required|array|min:1',
            'items.*.product_title' => 'required|string|max:255',
            'items.*.quantity'      => 'required|integer|min:1',
            'items.*.price'         => 'required|numeric|min:0',
            'items.*.total_price'   => 'required|numeric|min:0',
        ]);

        $order = \DB::transaction(function () use ($validated) {
            $order = Order::create([
                'buyer_name'    => $validated['buyer_name'],
                'buyer_address' => $validated['buyer_address'],
                'total_price'   => $validated['total_price'],
            ]);

            foreach ($validated['items'] as $item) {
                $order->items()->create([
                    'product_title' => $item['product_title'],
                    'quantity'      => $item['quantity'],
                    'price'         => $item['price'],
                    'total_price'   => $item['total_price'],
                ]);
            }

            return $order;
        });

        return response()->json([
            'success' => true,
            'message' => 'Pesanan berhasil dicatat.',
            'order'   => $order->load('items')
        ], 201);
    }
}
