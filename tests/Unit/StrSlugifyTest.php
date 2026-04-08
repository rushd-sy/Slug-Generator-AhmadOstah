<?php

namespace Tests\Unit;

use Tests\TestCase;
use Mockery\MockInterface;
use Illuminate\Support\Stringable;
// use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Str;
use Illuminate\Support\ServiceProvider;


class StrSlugifyTest extends TestCase
{
    public function test_slugify_is_called(): void
    {
        $this->mock(Stringable::class, function (MockInterface $mock) {
            $mock->shouldReceive('slugify')
                 ->once()
                 ->with('Mocked Slug')
                 ->andReturn('mocked-slug');
        });
        // $result = app(Stringable::class)::slugify('Mocked Ssssslug');
        // $this->assertEquals('mocked-slug', $result);
        $this->artisan('make:slug')
             ->expectsQuestion('Please enter the title', 'Mocked Slug')
             ->expectsOutputToContain('mocked-slug')
             ->assertExitCode(0);
    }
}



