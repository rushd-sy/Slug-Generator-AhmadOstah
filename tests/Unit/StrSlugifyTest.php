<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Str;

class StrSlugifyTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_slugify(): void
    {
        $this->assertEquals('hello-world', Str::slugify('Hello World'));
        $this->assertEquals('php-is-awesome', Str::slugify('PHP is awesome!'));
        $this->assertEquals('laravel10', Str::slugify('Laravel&10'));
        $this->assertEquals('trimmed-result', Str::slugify('!!! Trimmed Result ???'));
        $this->assertEquals('multiple-spaces', Str::slugify('Multiple   Spaces'));
    }
}
