<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'level',
        'duration',
        'language',
        'image',
        'user_id',
        'rating_id',
        'category_id',
        'created_by',
        'updated_by'
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function rating()
    {
        return $this->belongsTo(Rating::class, 'rating_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
