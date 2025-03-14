<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Modules\Blog\App\Providers\BlogServiceProvider;

use App\Models\Article;
use App\Policies\ArticlePolicy;

class AppServiceProvider extends ServiceProvider
{

    protected $policies = [
        Article::class => ArticlePolicy::class,
    ];
    
    public function register(): void
    {
        $this->app->register(BlogServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Paginator::useBootstrap();
    }
}
