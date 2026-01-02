<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use App\Models\Sale;
use App\Mail\DailySalesReportMail;
use App\Models\User;

class SendDailySalesReportJob implements ShouldQueue
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
         $sales = Sale::with('product')
            ->whereDate('created_at', today())
            ->get();

        if ($sales->isEmpty()) {
            return;
        }

        $summary = $sales->groupBy('product_id')->map(function ($items) {
            return [
                'product' => $items->first()->product->name,
                'quantity_sold' => $items->sum('quantity'),
                'revenue' => $items->sum('total_price'),
            ];
        });

        $adminEmail = User::where('is_admin', true)->value('email');

        Mail::to($adminEmail)
            ->send(new DailySalesReportMail($summary));
    }
}
