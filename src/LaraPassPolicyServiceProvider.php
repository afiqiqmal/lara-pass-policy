<?php

namespace Afiqiqmal\LaraPassPolicy;

use Afiqiqmal\LaraPassPolicy\Commands\LaraPasswordChangeReminder;
use Illuminate\Support\ServiceProvider;

class LaraPassPolicyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/lara-pass-policy.php' => config_path('lara-pass-policy.php'),
            ], 'config');

            $migrationFileName = 'create_password_history_table.php';
            if (! $this->migrationFileExists($migrationFileName)) {
                $this->publishes([
                    __DIR__ . "/../database/migrations/{$migrationFileName}.stub" => database_path('migrations/' . date('Y_m_d_His', time()) . '_' . $migrationFileName),
                ], 'migrations');
            }

            $this->commands([
                LaraPasswordChangeReminder::class,
            ]);
        }

        $this->loadRoutesFrom(__DIR__.'/../routes/lara-pass.php');

        $this->loadViewsFrom(__DIR__.'/../resources/views/auth', 'lara-pass-policy');

        $this->publishes([
            __DIR__.'/../resources/views/auth' => resource_path('views/auth'),
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/lara-pass-policy.php', 'lara-pass-policy');
    }

    public static function migrationFileExists(string $migrationFileName): bool
    {
        $len = strlen($migrationFileName);
        foreach (glob(database_path("migrations/*.php")) as $filename) {
            if ((substr($filename, -$len) === $migrationFileName)) {
                return true;
            }
        }

        return false;
    }
}