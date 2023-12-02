<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class School extends Model
{
    use HasFactory;

    protected $table = "schools";

    protected $fillable = [
        "user_id",
        "name",
        "code",
        "principal",
        "email",
        "phone_number",
        "address",
        "description",
        "logo",
    ];

    protected $guarded = [
        "id"
    ];

    /**
     * Get the user that owns the School
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get all of the couses for the School
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function couses(): HasMany
    {
        return $this->hasMany(Course::class, 'school_id', 'id');
    }

    /**
     * Get all of the leaveRequests for the School
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function leaveRequests(): HasMany
    {
        return $this->hasMany(LeaveRequest::class, 'school_id', 'id');
    }

    /**
     * Get all of the events for the School
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'school_id', 'id');
    }
}
