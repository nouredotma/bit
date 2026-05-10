<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('shop.checkout');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'nullable|string|max:30',
            'address' => 'required|string|max:1000',
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|integer|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        try {
            $order = DB::transaction(function () use ($validated) {
                $total = 0;
                $orderItems = [];

                foreach ($validated['items'] as $item) {
                    $product = Product::lockForUpdate()->find($item['id']);

                    if (!$product || $product->stock < $item['quantity']) {
                        throw new \Exception("Insufficient stock for: {$product->name}");
                    }

                    $lineTotal = $product->price * $item['quantity'];
                    $total += $lineTotal;

                    $orderItems[] = [
                        'product_id' => $product->id,
                        'quantity' => $item['quantity'],
                        'price' => $product->price,
                    ];

                    $product->decrement('stock', $item['quantity']);
                }

                $order = Order::create([
                    'customer_name' => $validated['customer_name'],
                    'customer_email' => $validated['customer_email'],
                    'customer_phone' => $validated['customer_phone'] ?? null,
                    'address' => $validated['address'],
                    'total' => $total,
                    'status' => 'pending',
                ]);

                foreach ($orderItems as $oi) {
                    $order->items()->create($oi);
                }

                return $order;
            });

            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully!',
                'order_id' => $order->id,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
