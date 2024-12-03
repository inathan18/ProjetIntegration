<?php

namespace App\Providers;
use App\Models\Fournisseur;
use Illuminate\Support\ServiceProvider;
use App\Observers\FournisseurObserver;

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
        Fournisseur::observe(FournisseurObserver::class);
    }
}
