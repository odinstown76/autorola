<?php

namespace App\Providers;

use Domain\Model\CarRepository;
use Domain\SimpleUuidFactory;
use Domain\SimpleUuidInterFace;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Repositories\CarRepositoryUsesInMemory;
use Infrastructure\Support\SimpleUuidFactoryUsingRamsey;
use Infrastructure\Support\SimpleUuidUsingRamsey;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(CarRepository::class, CarRepositoryUsesInMemory::class);
        $this->app->bind(SimpleUuidInterFace::class, SimpleUuidUsingRamsey::class);
    }
}
