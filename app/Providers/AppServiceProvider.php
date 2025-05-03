<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Observers\ModelActivityObserver;
use Illuminate\Support\ServiceProvider;

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
        Post::observe(ModelActivityObserver::class);
        Category::observe(ModelActivityObserver::class);
    }
}
