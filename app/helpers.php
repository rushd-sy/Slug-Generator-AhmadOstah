<?php
 use Illuminate\Support\Str;
if (!function_exists('get_slug')) {  
    function get_slug($title)
    {
        $slug=Str::of($title)
            ->lower()
            ->replace(' ', '-')
            ->replaceMatches('/[^a-z0-9\-]/', '')
            ->replaceMatches('/-+/', '-')
            ->trim('-');
        return (['slug' => $slug]);
    }
}
