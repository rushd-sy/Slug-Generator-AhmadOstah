<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Str; 
#[Signature('make:slug')]
#[Description('Prompts for a title and returns a JSON slug')]
class GenerateSlug extends Command
{
    public function handle()
    {
        $title = $this->ask('Please enter the title');
        $slug = Str::slugify($title); 
        $this->line("The slug for \"{$title}\" is <info>{$slug}</info>");
    }
}