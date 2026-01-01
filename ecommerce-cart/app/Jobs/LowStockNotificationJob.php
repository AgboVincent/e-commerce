<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use App\Models\Product;
use App\Mail\LowStockMail;

class LowStockNotificationJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $products = Product::where('stock_quantity', '<=', 2)->get();

        if ($products->isEmpty()) return;

        Mail::to('admin@example.com')->send(
            new LowStockMail($products)
        );
    }
}
