<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Subscribe;
use App\Observers\CartObserver;
use App\Observers\SubscribeObserver;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

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
        JsonResource::withoutWrapping();
        Cart::observe(CartObserver::class);
        Subscribe::observe(SubscribeObserver::class);
    }
}
