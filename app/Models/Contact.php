<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = [''];

    /**
     * Get the contacts' user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all the user's uploads.
     */
    public function uploads()
    {
        return $this->morphMany(Upload::class, 'uplodable');
    }
}
