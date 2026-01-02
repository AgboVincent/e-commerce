<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use App\Models\Product;
use App\Models\User;
use App\Mail\LowStockMail;

class LowStockNotificationJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Product $product)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $adminEmail = User::where('is_admin', true)->value('email');

        Mail::to($adminEmail)->send( new LowStockMail($this->product) );
    }
}
