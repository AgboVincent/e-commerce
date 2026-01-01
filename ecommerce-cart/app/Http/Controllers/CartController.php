<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CartItem;


class CartController extends Controller
{
    public function add(Product $product)
    {
        $cart = auth()->user()->cart()->firstOrCreate([
             'user_id' => auth()->id(),
        ]);

        $item = $cart->items()->where('product_id', $product->id)->first();

        if ($item) {
            $item->increment('quantity');
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return back();
    }

    public function update(CartItem $item)
    {
        $item->update([
            'quantity' => request('quantity'),
        ]);

        return back();
    }

    public function remove(CartItem $item)
    {
        $item->delete();

        return back();
    }

}
