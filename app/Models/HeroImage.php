<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroImage extends Model

{
    use HasFactory;

    protected $fillable = ['images'];

    protected $casts = [
        'images' => 'array', // automatically converts JSON to array
    ];
}

