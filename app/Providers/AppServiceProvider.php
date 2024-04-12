<?php

namespace App\Providers;

use App\Repositories\AuthRepository;
use App\Repositories\AuthRepositoryInterface;

use Illuminate\Support\ServiceProvider;
use App\Models\Sanctum\PersonalAccessToken;
use App\Repositories\WorkspaceRepository;
use App\Repositories\WorkspaceRepositoryInterface;
use Illuminate\Foundation\AliasLoader;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            AuthRepositoryInterface::class,
            AuthRepository::class,

        );

        $this->app->bind(
            WorkspaceRepositoryInterface::class,
            WorkspaceRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Loader Alias
        $loader = AliasLoader::getInstance();

        // SANCTUM CUSTOM PERSONAL-ACCESS-TOKEN
        $loader->alias(\Laravel\Sanctum\PersonalAccessToken::class, \App\Models\Sanctum\PersonalAccessToken::class);
    }
}
