<?php

namespace App\Observers;

use App\Models\Cart;

class CartObserver
{
    /**
     * Handle the Cart "created" event.
     */
    public function created(Cart $cart): void
    {
        $original_price = $cart->bundle->items()->selectRaw("sum(price * count) as total")->value("total");
        $cart->original_price = $original_price;
        $cart->price = $original_price - ($original_price / 100 * $cart->discount);
        $cart->save();
    }

    /**
     * Handle the Cart "updated" event.
     */
    public function updated(Cart $cart): void
    {
        //
    }

    /**
     * Handle the Cart "deleted" event.
     */
    public function deleted(Cart $cart): void
    {
        //
    }

    /**
     * Handle the Cart "restored" event.
     */
    public function restored(Cart $cart): void
    {
        //
    }

    /**
     * Handle the Cart "force deleted" event.
     */
    public function forceDeleted(Cart $cart): void
    {
        //
    }
}
