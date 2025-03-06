<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

use App\Models\Article;
use App\Policies\ArticlePolicy;

class AppServiceProvider extends ServiceProvider
{

    protected $policies = [
        Article::class => ArticlePolicy::class,
    ];
    
    public function register(): void
    {

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
