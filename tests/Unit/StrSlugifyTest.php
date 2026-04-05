<?php

namespace Tests\Unit;
use App\Service;
use Tests\TestCase;
use Illuminate\Support\facades\Str;
use Mockery;
use Illuminate\Support\Facades\Cache;
use Mockery\MockInterface;

class StrSlugifyTest extends TestCase
{
    
    /**
     * A basic unit test example.
     */
    /*public function test_slugify(): void
    {
        $this->assertEquals('hello-world', Str::slugify('Hello World'));
        $this->assertEquals('php-is-awesome', Str::slugify('PHP is awesome!'));
        $this->assertEquals('laravel10', Str::slugify('Laravel&10'));
        $this->assertEquals('trimmed-result', Str::slugify('!!! Trimmed Result ???'));
        $this->assertEquals('multiple-spaces', Str::slugify('Multiple   Spaces'));

    }*/
    //  public function test_mock_slugify(): void
    // {
    //     $mock = \Mockery::mock('alias:Illuminate\Support\Str');
    //     $mock->shouldReceive('slugify')
    //     //  ->once()
    //         ->with('Mocked String')
    //         ->andReturn('mocked-string');

    //     $result = Str::slugify('Mocked String');
    //     $this->assertEquals('mocked-string', $result);
    // }
        
    // public function test_mock_slugify():void
    // {
    //         Str::shouldReceive('slugify')
    //         ->once()
    //         ->with('Mocked String')
    //         ->andReturn('mocked-string');
    //         $result = \Illuminate\Support\Str::slugify('Mocked String');
    //         $this->assertEquals('mocked-string', $result);
    // }
    public function test_mock_slugify(): void
    {
        Cache::expects('slugify')
            ->once()
            ->with('Mocked String')
            ->andReturn('mocked-string');
            $result = $this->app->make('cache')->slugify('Mocked String');
            $this->assertEquals('mocked-string', $result);
    }
    

}
