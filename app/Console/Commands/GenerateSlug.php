<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('make:slug')]
#[Description('Prompts for a title and returns a JSON slug')]
class GenerateSlug extends Command
{
    public function handle()
    {
        $title = $this->ask('Please enter the title');
        $this->line(get_slug_json($title));
    }
}
