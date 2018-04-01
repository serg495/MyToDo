<?php

namespace App\Providers;

use App\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('tasks._navbar', function ($view){
            $view->with('activeExternalCount', Task::where('performer_id', Auth::user()->id)->where('status', 0)->count());
            $view->with('activePersonalCount', Task::where('user_id', Auth::user()->id)->where('status', 0)->count());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
