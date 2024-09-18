<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Models\Post;
use App\Models\Category;

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
        $settings = Setting::checkSetting();
        $lastFivePosts = Post::with('category', 'user')
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();
        $categories = Category::with('children', 'posts')->get();
        View()->share([
            'settings' => $settings,
            'lastFivePosts' => $lastFivePosts,
            'categories' => $categories,
        ]);

        Paginator::useBootstrapFour();
    }
}
