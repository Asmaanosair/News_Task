<?php

namespace App\Providers;

use App\Http\Repository\ArticleRepository;
use App\Interfaces\ArticleInterface;
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
