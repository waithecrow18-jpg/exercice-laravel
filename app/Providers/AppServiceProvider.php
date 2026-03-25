<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('database.default') !== 'sqlite') {
            return;
        }

        $databasePath = config('database.connections.sqlite.database');

        if (! $databasePath || $databasePath === ':memory:' || File::exists($databasePath)) {
            return;
        }

        File::ensureDirectoryExists(dirname($databasePath));
        File::put($databasePath, '');
    }
}
