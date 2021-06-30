<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;
use App\Observers\UserObserver;
use App\Observers\RsvObserver;
use App\Observers\PaymentObserver;
use App\Observers\DiaryObserver;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Payment;
use App\Models\Diary;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        User::observe(UserObserver::class);
        Reservation::observe(RsvObserver::class);
        Payment::observe(PaymentObserver::class);
        Diary::observe(DiaryObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local', 'testing') && class_exists(DuskServiceProvider::class)) {
            $this->app->register(DuskServiceProvider::class);
        }
    }
}
