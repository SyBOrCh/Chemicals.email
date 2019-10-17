<?php

namespace App\Providers;
use BeyondCode\Mailbox\Facades\Mailbox;
use App\SyborchMailHandler;
use App\MedchemMailHandler;

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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Mailbox::to('syborch@chemicals.email', SyborchMailHandler::class);
        Mailbox::to('medchem@chemicals.email', MedchemMailHandler::class);
    }
}
