<?php

namespace Laraeast\LaravelLocales;

use Illuminate\Foundation\Application;
use Illuminate\Support\HtmlString;
use Laraeast\LaravelLocales\Enums\Language;
use Laraeast\LaravelLocales\Exceptions\NotSupportedLocaleException;

class LocalesBuilder
{
    /**
     * Application locales.
     *
     * @var \Laraeast\LaravelLocales\Enums\Language[]
     */
    protected array $locales = [];

    /**
     * Create application instance.
     *
     * @param \Illuminate\Foundation\Application $app
     * @throws \Laraeast\LaravelLocales\Exceptions\NotSupportedLocaleException
     */
    public function __construct(protected Application $app)
    {
        $this->setLocales();
    }

    /**
     * Get the supported locales.
     *
     * @return \Laraeast\LaravelLocales\Enums\Language[]
     */
    public function get(): array
    {
        return $this->locales;
    }

    /**
     * Get the application locale.
     *
     * @return Language|null
     */
    public function current(): ?Language
    {
        $locales = array_filter($this->locales, function (Language $locale) {
            return $locale->getCode() === $this->app->getLocale();
        });

        return reset($locales);
    }

    /**
     * Set the supported locales.
     *
     * @throws \Laraeast\LaravelLocales\Exceptions\NotSupportedLocaleException
     */
    protected function setLocales(): void
    {
        $supportedLocales = $this->app['config']->get('locales.languages');

        $locales = [];

        if (is_array($supportedLocales)) {
            foreach ($supportedLocales as $locale) {
                if ($locale instanceof Language) {
                    $locales[] = $locale;
                    continue;
                }

                throw new NotSupportedLocaleException('There is not supported language in your config file.');
            }
        }

        $this->locales = $locales;
    }

    /**
     * Set the application language.
     *
     * @throws \Laraeast\LaravelLocales\Exceptions\NotSupportedLocaleException
     */
    public function set(string|Language $locale): void
    {
        $filteredLocales = array_filter($this->locales, function (Language $language) use ($locale) {
            if ($locale instanceof Language) {
                return $language->getCode() === $locale->getCode();
            }

            return $language->getCode() === $locale;
        });

        $language = reset($filteredLocales);

        if ($language) {
            $this->app->setLocale($language->getCode());

            return;
        }

        throw new NotSupportedLocaleException('The language is not supported.');
    }

    /**
     * The code of current locale.
     */
    public function getCode(): string
    {
        return $this->current()->getCode();
    }

    /**
     * The name of current locale.
     */
    public function getName(): string
    {
        return $this->current()->getName();
    }

    /**
     * The direction of current locale.
     */
    public function getDir(): string
    {
        return $this->current()->getDir();
    }

    /**
     * The flag url of current locale.
     */
    public function getSvgFlag(string|int $width = 30, string|int $height = 30): HtmlString
    {
        return $this->current()
            ->getSvgFlag(
                width: $width,
                height: $height
            );
    }
}