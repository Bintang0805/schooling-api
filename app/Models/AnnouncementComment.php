<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnnouncementComment extends Model
{
    use HasFactory;

    protected $table = "announcement_comments";

    protected $fillable = [
        "user_id",
        "announcement_id",
        "comment",
    ];

    /**
     * Get the annoucement that owns the AnnouncementComment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function annoucement(): BelongsTo
    {
        return $this->belongsTo(Announcement::class, 'announcement_id', 'id');
    }

    /**
     * Get the user that owns the AnnouncementComment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
