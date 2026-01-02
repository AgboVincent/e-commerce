<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use App\Jobs\LowStockNotificationJob;


class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $user = $request->user();
        $cart = $user->cart()->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return back()->withErrors(['cart' => 'Cart is empty']);
        }

        DB::transaction(function () use ($cart, $user) {

            $total = $cart->items->sum(
                fn ($item) => $item->quantity * $item->product->price
            );

            $order = Order::create([
                'user_id' => $user->id,
                'total' => $total,
            ]);

            foreach ($cart->items as $item) {
                $lineTotal = $item->quantity * $item->product->price;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->product->price,
                    'total_price' => $lineTotal,
                ]);

                Sale::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->product->price,
                    'total_price' => $lineTotal,
                ]);

                $item->product->decrement('stock_quantity', $item->quantity);

                if ($item->product->stock_quantity <= 5) {
                    LowStockNotificationJob::dispatch($item->product);
                }
            }

            $cart->items()->delete();
        });

        return redirect()->route('dashboard')
            ->with('success', 'Order placed successfully');
        }

}
