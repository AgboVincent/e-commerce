<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;


class CartController extends Controller
{

    public function index()
    {
        $cart = Auth::user()
            ->cart
            ->with('items.product')
            ->first();

        return Inertia::render('Cart/Index', [
            'cart' => $cart,
        ]);
    }


    public function add(Request $request)
    {
        $user = $request->user();
        $cart = $user->cart()->firstOrCreate([
              'user_id' => $user->id,
        ]);

        $cart->items()->updateOrCreate(
            ['product_id' => $request->product_id],
            ['quantity' => DB::raw('quantity + 1')]
        );

        return back();
    }

    public function update(Request $request, CartItem $item)
    {
        $request->validate([
           'quantity' => 'required|integer|min:1',
        ]);
        $item->update(['quantity' => $request->quantity]);
        return back();
    }

    public function remove(CartItem $item)
    {
        $item->delete();
        return back();
    }

}
