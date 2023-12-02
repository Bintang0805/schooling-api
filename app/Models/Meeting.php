<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Meeting extends Model
{
    use HasFactory;

    protected $table = "meetings";

    protected $fillable = [
        "school_id",
        "topic",
        "description",
        "start_date",
        "password",
        "status",
        "link",
        "user_id",
    ];

    protected $guarded = [
        "id"
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'datetime',
    ];

    /**
     * Get the school that owns the Meeting
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }

    /**
     * Get the user that owns the Meeting
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get all of the meetingDetails for the Meeting
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function meetingDetails(): HasMany
    {
        return $this->hasMany(MeetingDetail::class, 'meeting_id', 'id');
    }

    public static function getOptions() {
        $options = [
            "statuses" => ["Coming Soon", "On Going", "Finished"]
        ];

        return $options;
    }
}
