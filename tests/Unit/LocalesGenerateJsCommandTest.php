<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\File;
use Tests\TestCase;

class LocalesGenerateJsCommandTest extends TestCase
{
    protected string $path;

    protected function setUp(): void
    {
        parent::setUp();

        $this->path = sys_get_temp_dir().'/laravel-locales-tests/supported-locales.ts';

        $this->app['config']->set('locales.js.file_path', $this->path);
    }

    protected function tearDown(): void
    {
        File::deleteDirectory(dirname($this->path));

        parent::tearDown();
    }

    public function test_it_generates_the_javascript_file()
    {
        $this->artisan('locales:generate-js')->assertSuccessful();

        $this->assertFileExists($this->path);

        $content = File::get($this->path);

        $this->assertStringStartsWith('export default [', $content);
        $this->assertStringContainsString('"code": "en"', $content);
        $this->assertStringContainsString('"code": "ar"', $content);
        $this->assertStringContainsString('"name": "English"', $content);
        $this->assertStringContainsString('"dir": "rtl"', $content);
    }

    public function test_it_creates_missing_directories()
    {
        $this->assertDirectoryDoesNotExist(dirname($this->path));

        $this->artisan('locales:generate-js');

        $this->assertDirectoryExists(dirname($this->path));
    }
}
