<?php

namespace Laraeast\LaravelLocales\Providers;

use Illuminate\Support\ServiceProvider;
use Laraeast\LaravelLocales\Console\Commands\LocalesGenerateJsCommand;
use Laraeast\LaravelLocales\LocalesBuilder;

class LocalesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->commands([
            LocalesGenerateJsCommand::class,
        ]);
        $this->publishes([
            __DIR__.'/../../config/locales.php' => config_path('locales.php'),
        ], 'locales:config');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/locales.php', 'locales');

        $this->app->singleton('laraeast.locales', function ($app) {
            return new LocalesBuilder($app);
        });
    }
}
