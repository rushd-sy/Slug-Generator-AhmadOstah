<?php

use Illuminate\Support\Str;

if (!function_exists('get_slug_json')) {
    function get_slug_json($title)
    {
        $slug = Str::slug($title, '-');
        
        return json_encode([
            'slug' => $slug
        ], JSON_PRETTY_PRINT);
    }
}