<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'rating_point'];

    // Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Rating belongs to a course
    public function course()
    {
        return $this->hasOne(OnlineCourse::class, 'rating_id');
    }

    // A rating can belong to many share experiences
    public function shareExperiences()
    {
        return $this->hasMany(ShareExperiance::class, 'rating_id');
    }

}
