<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Illuminate\Support\Facades\Route;

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
        // Ép Livewire sử dụng URL Gateway chuyên nghiệp
        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/api/v1/internal/gateway/execute', $handle)
                ->middleware('web');
        });
    }
}
