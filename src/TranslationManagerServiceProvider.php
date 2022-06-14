<?php

namespace Dlogon\TranslationManager;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;


class TranslationManagerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('translationmanager', function($app) {
            return new TranslationManager();
        });

        $this->mergeConfigFrom(__DIR__.'/../config/translation-manager.php', 'translation-manager');
    }

    public function boot()
    {
        $viewPath = __DIR__.'/../resources/views';
        $migrationsPath = __DIR__.'/../database/migrations';
        $this->loadViewsFrom($viewPath, 'translation-manager');
        $this->loadMigrationsFrom($migrationsPath);
        $this->registerRoutes();

        $this->publishes([
            __DIR__.'/../resources/assets' => public_path('dlogon/translation-manager'),
        ], 'public');

        if ($this->app->runningInConsole())
        {
            $this->publishes([
                $migrationsPath    => base_path('database/migrations'),
            ], 'migrations');

            $this->publishes([
              __DIR__.'/../config/translation-manager.php' => config_path('translation-manager.php'),
            ], 'config');

            $this->publishes([
                $viewPath => base_path('resources/views/vendor/dlogon/translation-manager'),
            ], 'views');
        }
    }

    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }

    protected function routeConfiguration()
    {
        return [
            'prefix' => config('translation-manager.route.prefix'),
            'middleware' => config('translation-manager.route.middleware'),
        ];
    }
}
