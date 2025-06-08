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

Locales::codes();
// return array of configured languages codes: ['en', 'ar', 'fr'. '...etc']

Locales::names();
// return array of configured languages names: ['English', 'العربية', 'Français'. '...etc']

Locales::flags(width: 30, height: 30);
// return array of configured languages svg flags with width=30 and height=30
```
#### Generate locales file in JS:

```shell
php artisan locales:generate-js
```

This command will generate javascript file contains the configured languages, So if you change the languages, You should rul this command to update the javascript file.

Example Generated file `resources/js/data/supported-locales.ts`:
```ts
export default [
    {
        "name": "English",
        "code": "en",
        "dir": "ltr",
        "flag": "<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"30\" height=\"30\" viewBox=\"0 0 7410 3900\"><path fill=\"#b22234\" d=\"M0 0h7410v3900H0z\"/><path d=\"M0 450h7410m0 600H0m0 600h7410m0 600H0m0 600h7410m0 600H0\" stroke=\"#fff\" stroke-width=\"300\"/><path fill=\"#3c3b6e\" d=\"M0 0h2964v2100H0z\"/><g fill=\"#fff\"><g id=\"d\"><g id=\"c\"><g id=\"e\"><g id=\"b\"><path id=\"a\" d=\"m247 90 70.534 217.082-184.66-134.164h228.253L176.466 307.082z\"/><use xlink:href=\"#a\" y=\"420\"/><use xlink:href=\"#a\" y=\"840\"/><use xlink:href=\"#a\" y=\"1260\"/></g><use xlink:href=\"#a\" y=\"1680\"/></g><use xlink:href=\"#b\" x=\"247\" y=\"210\"/></g><use xlink:href=\"#c\" x=\"494\"/></g><use xlink:href=\"#d\" x=\"988\"/><use xlink:href=\"#c\" x=\"1976\"/><use xlink:href=\"#e\" x=\"2470\"/></g></svg>"
    },
    {
        "name": "French",
        "code": "fr",
        "dir": "ltr",
        "flag": "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"30\" height=\"30\" viewBox=\"0 0 900 600\"><path fill=\"#ED2939\" d=\"M0 0h900v600H0z\"/><path fill=\"#fff\" d=\"M0 0h600v600H0z\"/><path fill=\"#002395\" d=\"M0 0h300v600H0z\"/></svg>"
    }
];
```

It recommended to use [locales-manager](https://www.npmjs.com/package/locales-manager) js plugin to works with javascript.

```shell
npm i locales-manager --save-dev
```

```js
import Locales from "locales-manager";
import supportedLocales from "./data/supported-locales";

let locales = new Locales(supportedLocales);

locales.setLocale('ar')

console.log(locales.current().getName()) // Arabic
```