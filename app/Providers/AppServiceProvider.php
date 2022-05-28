<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use CartHelper;
use Order;
use Carbon;
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
        if(session()->get('locale') == null){
            session()->put('locale','vi');
        }
        // ->where([['from_date', '<=', $date], ['to_date', '>=', $date]])
        $date =  Carbon::parse(now()->today()->toDateString());
        Order::with('room')
        ->get()->filter(function($item) {
            if (Carbon::now()->between(Carbon::parse($item->from_date)->startOfDay()
            , Carbon::parse($item->to_date)->addHours(12))) {
                $item->room->update(['hide_show'=> 0]);
            }
            else{
                $item->room->update(['hide_show'=> 1]);
            }
            });
        // Sharing Data With All Views
        view()->composer('*', function($view){
            $view->with([
                'order' => new CartHelper()
            ]);
        });

    }
}
