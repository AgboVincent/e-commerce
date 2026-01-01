<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use App\Jobs\LowStockNotificationJob;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = auth()->user()->cart;

        DB::transaction(function () use ($cart) {
            $order = Order::create([
                'user_id' => auth()->id(),
                'total' => $cart->items->sum(fn ($i) => $i->quantity * $i->product->price),
            ]);

            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);

                $item->product->decrement('stock_quantity', $item->quantity);
            }

            $cart->items()->delete();
        });

        LowStockNotificationJob::dispatch();

        return redirect()->route('dashboard');
    }

}
