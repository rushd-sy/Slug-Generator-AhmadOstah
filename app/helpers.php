<?php

if (!function_exists('get_slug_json')) {
    function get_slug_json($title)
    {
        $slug = strtolower($title);
        $slug = str_replace(' ', '-', $slug);
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);
        $slug = preg_replace('/[\s-]+/', '-', $slug);
       $slug = trim($slug, '-');
       return json_encode([
            'slug' => $slug
        ], JSON_PRETTY_PRINT);
    }
}