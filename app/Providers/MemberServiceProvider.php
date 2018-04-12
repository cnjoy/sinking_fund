<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MemberServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->share('member_id',1);
        // View::share('member_id', Auth::user()->member->id);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
