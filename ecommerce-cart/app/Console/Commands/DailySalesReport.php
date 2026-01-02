<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendDailySalesReportJob;


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
       SendDailySalesReportJob::dispatch();

       $this->info('Daily sales report job dispatched.');
    }

    

}
