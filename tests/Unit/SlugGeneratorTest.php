<?php
namespace Tests\Unit;
use Tests\TestCase; 
class SlugGeneratorTest extends TestCase
{
    public function test_standard_title_conversion(): void
    {
        $this->artisan('make:slug')
             ->expectsQuestion('Please enter the title', 'Hello World')
             ->expectsOutput(json_encode(['slug' => 'hello-world'], JSON_PRETTY_PRINT))
             ->assertExitCode(0);
    }
    public function test_removes_special_characters(): void
    {
        $this->artisan('make:slug')
             ->expectsQuestion('Please enter the title', 'What is "Laravel"?! @2026')
             ->expectsOutput(json_encode(['slug' => 'what-is-laravel-2026'], JSON_PRETTY_PRINT))
             ->assertExitCode(0);
    }
    public function test_handles_multiple_spaces_and_existing_hyphens(): void
    {
        $this->artisan('make:slug')
             ->expectsQuestion('Please enter the title', 'Slow   Moving---Train')
             ->expectsOutput(json_encode(['slug' => 'slow-moving-train'], JSON_PRETTY_PRINT))
             ->assertExitCode(0);
    }
    public function test_trims_extending_hyphens(): void
    {
        $this->artisan('make:slug')
             ->expectsQuestion('Please enter the title', '---Clean Me Up---')
             ->expectsOutput(json_encode(['slug' => 'clean-me-up'], JSON_PRETTY_PRINT))
             ->assertExitCode(0);
    }
    public function test_empty_string_input(): void
    {
        $this->artisan('make:slug')
             ->expectsQuestion('Please enter the title', '')
             ->expectsOutput(json_encode(['slug' => ''], JSON_PRETTY_PRINT))
             ->assertExitCode(0);
    }
    public function test_only_special_characters_input(): void
    {
        $this->artisan('make:slug')
             ->expectsQuestion('Please enter the title', '@#$%^&*()')
             ->expectsOutput(json_encode(['slug' => ''], JSON_PRETTY_PRINT))
             ->assertExitCode(0);
    }
    public function test_mixed_case_and_numbers(): void
    {
        $this->artisan('make:slug')
             ->expectsQuestion('Please enter the title', 'Laravel 9.x is Great!')
             ->expectsOutput(json_encode(['slug' => 'laravel-9x-is-great'], JSON_PRETTY_PRINT))
             ->assertExitCode(0);
    }
    public function test_title_is_slug_friendly_already(): void
    {
        $this->artisan('make:slug')
             ->expectsQuestion('Please enter the title', 'already-slug-friendly')
             ->expectsOutput(json_encode(['slug' => 'already-slug-friendly'], JSON_PRETTY_PRINT))
             ->assertExitCode(0);
    }
}