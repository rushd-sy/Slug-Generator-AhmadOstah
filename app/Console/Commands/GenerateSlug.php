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
        $slugStoringArray = [];
        
        for ($i = 1; $i <= $number; $i++)
        {
            $title = $this->inputTitle();
            $slug = App::make(Stringable::class)->slugify($title);
            $this->outputSlug($title, $slug);

            $slugString = (string) $slug;

            if ($this->checkFrequency($slugString, $freq)) 
            {
                $this->storeInArray($title, $slugString, $slugStoringArray);
            }
        }
        $existedSlug = $this->existedSluges($slugStoringArray);
        $finalStoringArray = [];

        foreach($slugStoringArray as $input)
        {
            $this->inputs($slug, $title, $input);

            if(!in_array($slug, $existedSlug))
            {
                $this->finalStoreInArray($finalStoringArray, $title, $slug);    
            }
        }
        if(!empty($finalStoringArray))
        {
            $this->storeInDB($finalStoringArray);   
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
    public function checkFrequency($slugString, &$freq):bool//good
    {
        $freq[$slugString] = ($freq[$slugString] ?? 0) + 1;

        return $freq[$slugString] ==1?true:false;   
    }
    public function storeInArray($title, $slugString, &$slugStoringArray)//good
    {
         $slugStoringArray[] = [
                    'title' => $title,
                    
                    'slug' => $slugString,
                ];
    }
    public function existedSluges($slugStoringArray)//good
    {
        $existedSluge=Sluged::whereIn('slug', array_column($slugStoringArray, 'slug'))->pluck('slug')->toArray();
        return $existedSluge;
    }
    public function inputs(&$slug,&$title,&$input)//good
    {
        $title = $input['title'];
        $slug = $input['slug'];
    }
    public function finalStoreInArray(&$finalStoringArray,$title, $slug)//good
    {
        $finalStoringArray[] = [
                    'string' => $title,
                    'slug' => $slug,
                ];
    }
    public function storeInDB($finalStoringArray)//good
    {
        try {
            Sluged::insert($finalStoringArray);
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