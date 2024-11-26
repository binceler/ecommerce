<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Requests\OrderRequest;

class OrderController extends Controller
{
    public function store(OrderRequest $request)
    {
        \DB::beginTransaction();

        try {
            $order = Order::create(['total_amount' => 0]);

            $totalAmount = 0;

            foreach ($request->items as $item) {
                $subtotal = ($item['price'] + $item['tax']) - $item['discount'];
                $totalAmount += $subtotal;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_name' => $item['product_name'],
                    'price' => $item['price'],
                    'tax' => $item['tax'],
                    'discount' => $item['discount'],
                ]);
            }

            $order->update(['total_amount' => $totalAmount]);

            \DB::commit();

            return response()->json(['message' => 'Order created successfully'], 201);
        } catch (\Exception $e) {
            \DB::rollBack();

            return response()->json(['message' => 'Order creation failed', 'error' => $e->getMessage()], 500);
        }
    }
}
