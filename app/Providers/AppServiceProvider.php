<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\MaintInReview;

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
         // Using a view composer to share $totalRecordCount with a view
         View::composer('*', function ($view) {
            $totalRecordCount = MaintInReview::count();
            $view->with('totalRecordCount', $totalRecordCount);
        });
    }
}
