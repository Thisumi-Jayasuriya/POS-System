<?php

namespace App\Providers;
use App\Repositories\All\User\UserRepository;
use App\Repositories\All\User\UserRepositoryInterface;
use App\Repositories\Base\BaseRepository;
use App\Repositories\Base\EloquentRepositoryInterface;
use Illuminate\Support\ServiceProvider;

/**
 * RepositoryServiceProvider
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);

    }
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
