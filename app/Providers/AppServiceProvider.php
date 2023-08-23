<?php

namespace App\Providers;

use App\Contracts\StudentCardRepositoryInterface;
use App\Repository\StudentCardRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(StudentCardRepositoryInterface::class, StudentCardRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
