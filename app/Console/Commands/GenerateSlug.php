<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Stringable;
use Illuminate\Support\Facades\App;
use App\Models\sluged;


#[Signature('make:slug')]
#[Description('Prompts for a title and returns a string slug')]
class GenerateSlug extends Command
{
    public function handle()
    {
        $number = $this->ask('Please enter a number of slugs to generate');
        
        if (!is_numeric($number) || $number <= 0) {
            $this->error('Please enter a valid positive number.');
            return 1; // Exit 
        }

        $slugArray = sluged::pluck('slug')->toArray();
        $freq=[];
        
        for ($i = 1; $i <= $number; $i++) {
            $title = $this->ask('Please enter the title');
            $slug = App::make(Stringable::class)->slugify($title);

            $this->line("The slug for \"{$title}\" is <info>{$slug}</info>");
            $this->newline();

            $slugString=(string)$slug;
            $freq[$slugString] = ($freq[$slugString] ?? 0) + 1;

            if(!in_array($slugString, $slugArray)&&$freq[$slugString]==1){
                try {
                    sluged::create([
                        'string' => $title,
                        'slug' => $slug,
                    ]);
                } 
                    catch (\Exception $e) {
                    $this->error('Failed to save slug: ' . $e->getMessage());
                }
            } 
        }
        $this->newline();
        $this->line('-----your slug history-----');
        $slugHistory = sluged::orderBy('created_at', 'desc')->get();
        foreach ($slugHistory as $entry) {
            $this->line("String: <comment>{$entry->string}</comment> | 
            Slug: <info>{$entry->slug}</info> | Created At: {$entry->created_at}");            
        }
    }
}