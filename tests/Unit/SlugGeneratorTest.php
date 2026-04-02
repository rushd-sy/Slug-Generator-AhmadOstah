<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Str;

class SlugGeneratorTest extends TestCase
{ 
    public function test_standard_title_conversion(): void
    {
        $this->artisan('make:slug')
             ->expectsQuestion('Please enter the title', 'Hello World')
             ->expectsOutputToContain('hello-world')
             ->assertExitCode(0);
    }
    public function test_removes_special_characters(): void
    {
        $input = 'What is Laravel?!';
        $expected = 'what-is-laravel';
        $this->artisan('make:slug')
             ->expectsQuestion('Please enter the title', $input)
             ->expectsOutputToContain($expected)
             ->assertExitCode(0);
    }
    public function test_handles_multiple_spaces_and_existing_hyphens(): void
    {
        $this->artisan('make:slug')
             ->expectsQuestion('Please enter the title', 'Slow   Moving---Train')
             ->expectsOutputToContain('slow-moving-train')
             ->assertExitCode(0);
    }
    public function test_trims_extending_hyphens(): void
    {
        $this->artisan('make:slug')
             ->expectsQuestion('Please enter the title', '---Clean Me Up---')
             ->expectsOutputToContain('clean-me-up')
             ->assertExitCode(0);
    }
    public function test_empty_string_input(): void
    {
        $this->artisan('make:slug')
             ->expectsQuestion('Please enter the title', '')
             ->assertExitCode(0);
    }
}