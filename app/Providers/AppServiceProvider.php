<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // << penting
use App\Models\Perwira;
use App\Models\User;

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
        // Semua view admin/* otomatis punya $perwira & $users
        View::composer('admin.*', function ($view) {
            $view->with('perwira', Perwira::all());
            $view->with('users', User::all());
        });
    }
}
