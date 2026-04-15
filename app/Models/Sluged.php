<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

class Sluged extends Model
{
    // #[Fillable('string', 'slug')]
    protected $fillable = ['string', 'slug'];
}
