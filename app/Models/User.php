<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'otp',
        'otp_created_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'otp',
        'otp_created_at'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'otp_created_at' => 'datetime',
        ];
    }
    // Relationship: User has many Ratings
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
    // Courses created by this user
    public function createdCourses()
    {
        return $this->hasMany(OnlineCourse::class, 'created_by');
    }

    // Courses updated by this user
    public function updatedCourses()
    {
        return $this->hasMany(OnlineCourse::class, 'updated_by');
    }

    // Courses owned by this user
    public function courses()
    {
        return $this->hasMany(OnlineCourse::class, 'user_id');
    }
}
