<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MeetingDetail extends Model
{
    use HasFactory;

    protected $table = 'meeting_details';

    protected $fillable = [
        "meeting_id",
        "user_id", // participant
    ];

    protected $guarded = [
        "id"
    ];

    /**
     * Get the meeting that owns the MeetingDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function meeting(): BelongsTo
    {
        return $this->belongsTo(Meeting::class, 'meeting_id', 'id');
    }

    /**
     * Get the user that owns the MeetingDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
