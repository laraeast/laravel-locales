# Release Notes for Laravel Locales

## v4.4.0
- Add support for Laravel framework v13.x.
- Remove unused `robinncode/onubadok` dependency.
- `LocalesBuilder` now throws `NotSupportedLocaleException` when `locales.languages` is missing, empty, or not an array, instead of silently continuing with no supported locales.
- `Locales::codes()`, `Locales::names()` and `Locales::flags()` now read from the validated locales list instead of the raw config value.
- Extract the duplicated HTML-minifying logic used by `locales:generate-js` and the test suite into `Laraeast\LaravelLocales\Support\Html`.
## v4.2.0
- Add codes() & names() and flags() methods.
## v4.1.0
- Add `from(string|Language $locale)` method.
## v4.0.0
- Add minimum version of php ^8.0.
- Add minimum version of laravel framework v9.x.
- Use `Language` enum as a language entity instead of `stdClass`.
- Remove publishing flags icons.
- Config file structure was changed to support array of `Language` enum.
- `getFlag()` method was renamed to `getSvgFlag($width = 30, $height = 30)` and it returns html svg as an `HtmlString` instance instead of flag path