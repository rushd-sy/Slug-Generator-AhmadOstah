<?php
namespace Tests\Unit;
use Tests\TestCase; 
class SlugGeneratorTest extends TestCase
{
    public function test_it_generates_a_slug_from_terminal_input(): void
    {
  
        $expectedJson = json_encode(['slug' => 'what-is-laravel-convention'], JSON_PRETTY_PRINT);

        $this->artisan('make:slug') 
             ->expectsQuestion('Please enter the title', 'What is Laravel Convention?')
             ->expectsOutput($expectedJson)
             ->assertExitCode(0);
    }
}