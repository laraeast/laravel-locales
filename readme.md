# Laravel Multi Locales Package
<p align="center">
<a href="https://github.com/laraeast/laravel-locales/actions/workflows/tests.yml"><img src="https://github.com/laraeast/laravel-locales/actions/workflows/tests.yml/badge.svg?branch=master" alt="Build Status"></a>
<a href="https://packagist.org/packages/laraeast/laravel-locales"><img src="https://poser.pugx.org/laraeast/laravel-locales/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laraeast/laravel-locales"><img src="https://poser.pugx.org/laraeast/laravel-locales/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laraeast/laravel-locales"><img src="https://poser.pugx.org/laraeast/laravel-locales/license.svg" alt="License"></a>
</p>

> The package used to support multi locales in your application.
## Installation
 
1. Install package
 
    ```bash
    composer require laraeast/laravel-locales
    ```

2. Edit config/app.php (Skip this step if you are using laravel 5.5+)
 
    service provider:
 
    ```php
    Laraeast\LaravelLocales\Providers\LocalesServiceProvider::class,
    ```
 
    class aliases:
 
    ```php
    'Locales' => Laraeast\LaravelLocales\Facades\Locales::class,
    ```
 
 3. Configure your custom locales:
  
    ```bash
    php artisan vendor:publish --tag="locales:config"
    ```
    
## Usage

#### Locales selector dropdown:
```blade
<div class="dropdown">
  <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button" id="languageDropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
    {{ Locales::getSvgFlag(width: 25, height: 25) }}
    <span class="ms-2">{{ Locales::getName() }}</span>
  </a>

  <ul class="dropdown-menu" aria-labelledby="languageDropdownMenuLink">
    @foreach(Locales::get() as $locale)
        <li>
            <a class="dropdown-item" href="{{ url('locale/'. $locale->getCode()) }}">
                {{ $locale->getName() }}
            </a>
        </li>
    @endforeach
  </ul>
</div>
```
#### API
```php
Locales::get();
// array of supported locales

Locales::set('en');

Locales::current();
// the current locale instance

Locales::current()->getCode();
// or 
Locales::getCode();
// return : en

Locales::current()->getName();
// or 
Locales::getName();
// return : English

Locales::current()->getName();
// or
Locales::getDir();
// return : ltr

Locales::current()->getSvgFlag();
// or
Locales::getSvgFlag();
// return : svg (html)

Locales::from('en');
// return : \Laraeast\LaravelLocales\Enums\Language::EN
```