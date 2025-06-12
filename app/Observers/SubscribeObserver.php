<?php

namespace App\Observers;

use App\Enums\SubscribeStatusEnum;
use App\Models\Subscribe;

class SubscribeObserver
{
    /**
     * Handle the Subscribe "created" event.
     */
    public function created(Subscribe $subscribe): void
    {
        //
    }

    /**
     * Handle the Subscribe "updated" event.
     */
    public function updated(Subscribe $subscribe): void
    {
        if ($subscribe->quantity === 0 && $subscribe->wasChanged('quantity') && $subscribe->status !== SubscribeStatusEnum::EXPIRED->value) {
            $subscribe->status = SubscribeStatusEnum::EXPIRED;
            $subscribe->saveQuietly();
        }
    }

    /**
     * Handle the Subscribe "deleted" event.
     */
    public function deleted(Subscribe $subscribe): void
    {
        //
    }

    /**
     * Handle the Subscribe "restored" event.
     */
    public function restored(Subscribe $subscribe): void
    {
        //
    }

    /**
     * Handle the Subscribe "force deleted" event.
     */
    public function forceDeleted(Subscribe $subscribe): void
    {
        //
    }
}
