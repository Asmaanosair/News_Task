<?php

namespace App\Providers;

use App\Interfaces\ArticleInterface;
use App\Repository\ArticleRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ArticleInterface::class, ArticleRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
