<?php

namespace Laraeast\LaravelLocales\Console\Commands;

use Illuminate\Console\Command;
use Laraeast\LaravelLocales\Enums\Language;

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
    public function handle()
    {
        $path = config('locales.js.file_path');

        $directory = dirname($path);

        if (! is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        $locales = array_map(function (Language $locale) {
            return [
                'name' => $locale->getName(),
                'code' => $locale->getCode(),
                'dir' => $locale->getDir(),
                'flag' => $this->qualifySvg($locale->getSvgFlag()->toHtml()),
            ];
        }, config('locales.languages'));

        $content = sprintf("export default %s;",
            json_encode($locales, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));

        file_put_contents($path, $content);

        $this->components->success(sprintf('"%s" was generated.', $path));
    }

    protected function qualifySvg($input): string|array|null
    {
        if (trim($input) === '') {
            return $input;
        }
        // Remove extra white-space(s) between HTML attribute(s)
        $input = preg_replace_callback('#<([^\/\s<>!]+)(?:\s+([^<>]*?)\s*|\s*)(\/?)>#s', function ($matches) {
            return '<'.$matches[1].preg_replace('#([^\s=]+)(\=([\'"]?)(.*?)\3)?(\s+|$)#s', ' $1$2',
                    $matches[2]).$matches[3].'>';
        }, str_replace("\r", '', $input));

        return preg_replace(
            [
                // t = text
                // o = tag open
                // c = tag close
                // Keep important white-space(s) after self-closing HTML tag(s)
                '#<(img|input)(>| .*?>)#s',
                // Remove a line break and two or more white-space(s) between tag(s)
                '#(<!--.*?-->)|(>)(?:\n*|\s{2,})(<)|^\s*|\s*$#s',
                '#(<!--.*?-->)|(?<!\>)\s+(<\/.*?>)|(<[^\/]*?>)\s+(?!\<)#s',
                // t+c || o+t
                '#(<!--.*?-->)|(<[^\/]*?>)\s+(<[^\/]*?>)|(<\/.*?>)\s+(<\/.*?>)#s',
                // o+o || c+c
                '#(<!--.*?-->)|(<\/.*?>)\s+(\s)(?!\<)|(?<!\>)\s+(\s)(<[^\/]*?\/?>)|(<[^\/]*?\/?>)\s+(\s)(?!\<)#s',
                // c+t || t+o || o+t -- separated by long white-space(s)
                '#(<!--.*?-->)|(<[^\/]*?>)\s+(<\/.*?>)#s',
                // empty tag
                '#<(img|input)(>| .*?>)<\/\1>#s',
                // reset previous fix
                '#(&nbsp;)&nbsp;(?![<\s])#',
                // clean up ...
                '#(?<=\>)(&nbsp;)(?=\<)#',
                // --ibid
                // Remove HTML comment(s) except IE comment(s)
                '#\s*<!--(?!\[if\s).*?-->\s*|(?<!\>)\n+(?=\<[^!])#s',
            ],
            [
                '<$1$2</$1>',
                '$1$2$3',
                '$1$2$3',
                '$1$2$3$4$5',
                '$1$2$3$4$5$6$7',
                '$1$2$3',
                '<$1$2',
                '$1 ',
                '$1',
                '',
            ],
            $input);
    }
}
