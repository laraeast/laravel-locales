<?php

namespace Tests;

use Laraeast\LaravelLocales\Enums\Language;
use Laraeast\LaravelLocales\Facades\Locales;
use Laraeast\LaravelLocales\Providers\LocalesServiceProvider;
use Laraeast\LaravelLocales\Support\Html;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->app['config']->set([
            'locales' => [
                'languages' => [
                    Language::EN,
                    Language::AR,
                ],
            ],
        ]);
    }

    /**
     * Load package service provider
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [LocalesServiceProvider::class];
    }

    /**
     * Load package alias
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'Locales' => Locales::class,
        ];
    }

    /**
     * Minify html content.
     *
     * @return string|string[]|null
     */
    protected function minifyHtml($input): string|array|null
    {
        return Html::minify($input);
    }
}
