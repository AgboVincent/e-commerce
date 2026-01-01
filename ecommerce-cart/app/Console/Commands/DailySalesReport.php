<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Order;
use App\Mail\DailySalesReportMail;
use Illuminate\Console\Scheduling\Schedule;

class DailySalesReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:daily-sales-report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $orders = Order::whereDate('created_at', today())->with('items.product')->get();

        Mail::to('admin@example.com')->send(
            new DailySalesReportMail($orders)
        );
    }

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('sales:daily')->dailyAt('18:00');
    }

    

}
