<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeaveRequest extends Model
{
    use HasFactory;

    protected $table = "leave_requests";

    protected $fillable = [
        "school_id",
        "user_id",
        "status",
        "reason",
        "leave_date",
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
        'leave_date' => 'date',
    ];

    /**
     * Get the user that owns the LeaveRequest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the school that owns the LeaveRequest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class, 'user_id', 'id');
    }

    public static function getOptions() {
        $options = [
            "statuses" => ["Pending", "Approved", "Rejected"]
        ];

        return $options;
    }
}
