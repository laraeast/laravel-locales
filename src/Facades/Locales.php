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

    /**
     * Get an array of locales codes.
     */
    public static function codes(): array
    {
        return array_map(fn($case) => $case->getCode(), config('locales.languages'));
    }

    /**
     * Get an array of locales names.
     */
    public static function names(): array
    {
        return array_map(fn($case) => $case->getName(), config('locales.languages'));
    }

    /**
     * Get an array of locales flags.
     */
    public static function flags(string|int $width = 30, string|int $height = 30): array
    {
        return array_map(fn($case) => $case->getSvgFlag($width, $height)->toHtml(), config('locales.languages'));
    }
}