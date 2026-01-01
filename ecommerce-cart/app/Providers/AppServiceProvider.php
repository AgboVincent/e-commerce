<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Inertia::share([
        'cart' => function () {
            $user = auth()->user();

                if (!$user) {
                    return null;
                }

                return $user->cart?->load('items.product');
            },
        'cartCount' => function () {
            $user = auth()->user();

            if (!$user) {
                return 0;
            }

            return $user->cart?->items()->sum('quantity') ?? 0;
        },
        ]);

    }
}
