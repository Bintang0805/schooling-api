<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Announcement extends Model
{
    use HasFactory;

    protected $table = "annoucements";

    protected $fillable = [
        "title",
        "description",
        "content",
    ];

    protected $guarded = [
        "id",
    ];

    /**
     * Get all of the announcementComments for the Announcement
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function announcementComments(): HasMany
    {
        return $this->hasMany(AnnouncementComment::class, 'announcement_id', 'id');
    }
}
