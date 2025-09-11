<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShareExperiance extends Model
{
    use HasFactory;

    protected $table = 'share_experiences';

    protected $fillable = [
        'name',
        'description',
        'online_course_id',
        'rating_id',
        'user_id',
    ];

    // A share experiance belongs to one online course
    public function onlineCourse()
    {
        return $this->belongsTo(OnlineCourse::class, 'online_course_id');
    }

    // A share experiance can have one rating
    public function rating()
    {
        return $this->belongsTo(Rating::class, 'rating_id');
    }

    // A share experiance belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
