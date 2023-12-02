<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\School;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the school associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function school(): HasOne
    {
        return $this->hasOne(School::class, 'user_id', 'id');
    }

    /**
     * Get all of the meetings for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function meetings(): HasMany
    {
        return $this->hasMany(Meeting::class, 'user_id', 'id');
    }

    /**
     * Get the leaveRequest associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function leaveRequest(): HasOne
    {
        return $this->hasOne(LeaveRequest::class, 'user_id', 'id');
    }

    /**
     * Get all of the announcementComments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function announcementComments(): HasMany
    {
        return $this->hasMany(AnnouncementComment::class, 'user_id', 'id');
    }
}
