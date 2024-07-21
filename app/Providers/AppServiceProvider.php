<?php

namespace App\Providers;

use App\Repositories\Credit\CreditTransactionRepository;
use App\Services\CurrencyService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CreditTransactionRepository::class, function($app) {
            return new CreditTransactionRepository();
        });

        $this->app->singleton(CurrencyService::class, function($app) {
            return new CurrencyService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
