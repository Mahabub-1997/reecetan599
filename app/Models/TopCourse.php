<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopCourse extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'description'
    ];
}
