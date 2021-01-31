<?php

namespace App\Providers;

use App\Models\Page;
use App\Models\Profile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        Schema::defaultStringLength(191);

        $suggestions = Cache::remember('suggestions', 22 * 60, function () {
            return Profile::pluck('name');
        });

        view()->share('suggestions', $suggestions);
        View::composer('website_layouts.footer', function ($view) {
            $pages = Page::all();
            $view->with('pages', $pages);
        });
    }
}
