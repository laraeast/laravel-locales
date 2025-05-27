<?php

namespace Laraeast\LaravelLocales\Facades;

use Illuminate\Support\Facades\Facade;
use Laraeast\LaravelLocales\Enums\Language;

/**
 * Class Locales
 *
 * @method static \Laraeast\LaravelLocales\Enums\Language[] get()
 * @method static \Laraeast\LaravelLocales\Enums\Language current()
 * @method static void set(string|\Laraeast\LaravelLocales\Enums\Language $locale)
 * @method static string getCode()
 * @method static string getName()
 * @method static string getDir()
 * @method static \Illuminate\Support\HtmlString getSvgFlag(string|int $width = 30, string|int $height = 30)
 * @method static \Laraeast\LaravelLocales\Enums\Language|null from(string|Language $locale)
 * @package Laraeast\LaravelLocales\Facades
 */
class Locales extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laraeast.locales';
    }
}