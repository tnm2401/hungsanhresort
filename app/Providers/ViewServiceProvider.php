<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['category', 'product'], function ($view) {
            $navItems = [
                'Shawshank redemption',
                'Forrest Gump',
                'The Matrix',
                'Pirates of the Carribean',
                'Back to the future',
            ];
            $view->with('navItems', $navItems);
        });
    }
}
