<?php

namespace App\Jobs;

use App\Enums\SubscribePaymentStatusEnum;
use App\Models\Subscribe;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class Payment implements ShouldQueue
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
        $data = Subscribe::query()->where(['payment_status' => SubscribePaymentStatusEnum::PENDING])->get();
        foreach ($data as $item) {
            $plan = $item->plan;
            if ($item->created_at->diffInDays(now()) > $plan->free_trial) {
                $item->payment_status = SubscribePaymentStatusEnum::PAID;
                $item->save();
                echo "Pul yechib olindi";
            }
        }
    }
}
