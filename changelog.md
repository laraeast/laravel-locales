# Release Notes for Laravel Locales

## v4.1.0
- Add `from(string|Language $locale)` method.
## v4.0.0
- Add minimum version of php ^8.0.
- Add minimum version of laravel framework v9.x.
- Use `Language` enum as a language entity instead of `stdClass`.
- Remove publishing flags icons.
- Config file structure was changed to support array of `Language` enum.
- `getFlag()` method was renamed to `getSvgFlag($width = 30, $height = 30)` and it returns html svg as an `HtmlString` instance instead of flag path