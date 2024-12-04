<?php

namespace App\Providers;

use App\Services\RequestTypeService;
use Illuminate\Support\ServiceProvider;
use App\Repositories\RequestTypeRepository;
use Illuminate\Auth\Notifications\ResetPassword;
use App\Interfaces\Services\RequestTypeServiceInterface;
use App\Interfaces\Repositories\RequestTypeRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(RequestTypeRepositoryInterface::class, RequestTypeRepository::class);
        $this->app->bind(RequestTypeServiceInterface::class, RequestTypeService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });
    }
}
