<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model

{
    use HasFactory;

    // Explicit table name so Laravel doesn't pluralize oddly
    protected $table = 'contact_us';

    protected $fillable = [
        'name',
        'email',
        'description',
    ];
}

