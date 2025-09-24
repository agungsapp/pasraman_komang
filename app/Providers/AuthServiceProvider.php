<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Akses untuk Admin saja
        Gate::define('access-master', fn($user) => $user->role === 'admin');

        // Akses untuk Admin dan Staff
        Gate::define('access-pembayaran', fn($user) => in_array($user->role, ['admin', 'staff']));

        // Akses untuk Admin dan Guru
        Gate::define('access-nilai', fn($user) => in_array($user->role, ['admin', 'guru']));
    }
}
