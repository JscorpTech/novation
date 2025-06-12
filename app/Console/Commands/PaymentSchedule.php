<?php

namespace App\Console\Commands;

use App\Jobs\Payment;
use Illuminate\Console\Command;

class PaymentSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:payment';

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
        Payment::dispatch();
    }
}
