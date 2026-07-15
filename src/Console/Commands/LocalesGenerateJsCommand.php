<?php

namespace Laraeast\LaravelLocales\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Laraeast\LaravelLocales\Enums\Language;
use Laraeast\LaravelLocales\LocalesBuilder;
use Laraeast\LaravelLocales\Support\Html;

class LocalesGenerateJsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'locales:generate-js';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate locales javascript file.';

    /**
     * Execute the console command.
     */
    public function handle(LocalesBuilder $locales): void
    {
        $path = config('locales.js.file_path');

        $directory = dirname($path);

        if (! File::isDirectory($directory)) {
            File::makeDirectory($directory, 0777, true);
        }

        $locales = array_map(fn (Language $locale) => [
            'name' => $locale->getName(),
            'code' => $locale->getCode(),
            'dir' => $locale->getDir(),
            'flag' => Html::minify($locale->getSvgFlag()->toHtml()),
        ], $locales->get());

        $content = sprintf('export default %s;',
            json_encode($locales, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));

        File::put($path, $content);

        $this->components->success(sprintf('"%s" was generated.', $path));
    }
}
