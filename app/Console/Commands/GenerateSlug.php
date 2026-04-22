<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Stringable;
use Illuminate\Support\Facades\App;
use App\Models\Sluged;

#[Signature('make:slug')]
#[Description('Prompts for a title and returns a string slug')]
class GenerateSlug extends Command
{
    public function handle()
    {
        $number = $this->inputNumber();
        $freq = [];
        $storeInput = [];
        
        for ($i = 1; $i <= $number; $i++)
        {
            $title = $this->inputTitle();
            $slug = App::make(Stringable::class)->slugify($title);
            $this->outputSlug($title, $slug);

            $slugString = (string) $slug;

            $this->checkFrequency($slugString, $freq);
            if ($freq[$slugString] == 1) 
            {
                $this->storeInputs($title, $slugString, $storeInput);
            }
        }
        $existedSlug = $this->existedSluges($storeInput);
        $finalInputp = [];

        foreach($storeInput as $input)
        {
            $this->inputs($slug, $title, $input);

            if(!in_array($slug, $existedSlug))
            {
                $this->finalInputs($finalInputp, $title, $slug);    
            }
        }
        if(!empty($finalInputp))
        {
            $this->storeInDB($finalInputp);   
        }
        $this->slugHistory();
    }
     public function inputNumber(): int//good
    {
        $number = $this->ask('Please enter a number of slugs to generate');

        if (!is_numeric($number) || $number <= 0) {
            $this->error('Please enter a valid positive number.');

            return (int) $this->inputNumber();
        }
        return (int) $number;

    }
    public function inputTitle(): string//good
    {
        $title = $this->ask('Please enter the title');

        if (empty($title)) {
            $this->error('Title cannot be empty.');

            return $this->inputTitle();
        }

        return $title;
    }
    public function outputSlug($title, $slug)//good
    {
        $this->line("The slug for \"{$title}\" is <info>{$slug}</info>");
        $this->newline();
    }
    public function checkFrequency($slugString, &$freq)//good
    {
        $freq[$slugString] = ($freq[$slugString] ?? 0) + 1;
    }
    public function storeInputs($title, $slugString, &$storeInput)//good
    {
         $storeInput[] = [
                    'title' => $title,
                    
                    'slug' => $slugString,
                ];
    }
    public function existedSluges($storeInput)//good
    {
        $existedSluge=Sluged::whereIn('slug', array_column($storeInput, 'slug'))->pluck('slug')->toArray();
        return $existedSluge;
    }
    public function inputs(&$slug,&$title,&$input)//good
    {
        $title = $input['title'];
        $slug = $input['slug'];
    }
    public function finalInputs(&$finalInputp,$title, $slug)//good
    {
        $finalInputp[] = [
                    'string' => $title,
                    'slug' => $slug,
                ];
    }
    public function storeInDB($finalInputp)//good
    {
        try {
            Sluged::insert($finalInputp);
        } catch (\Exception $e) {
            $this->error('Failed to save slugs: ' . $e->getMessage());
        }
    }
    public function slugHistory() //good
    {
        $this->newline();
        $this->line('-----your slug history-----');
        $slugHistory = Sluged::orderBy('created_at', 'desc')->get();
        foreach ($slugHistory as $entry) {
            $this->line("String: <comment>{$entry->string}</comment> | 
            Slug: <info>{$entry->slug}</info> ");            
        }
    }
}