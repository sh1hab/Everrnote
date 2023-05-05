<?php

namespace App\Models;

use App\Models\Concerns\HasFillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Contact extends Model
{
    use HasFactory, HasFillable;

    // protected $fillable = ['name', 'email', 'phone_number', 'is_password_active', 'address', 'nationality', 'user_id', 'work_or_education_institute'];

    protected $guarded = [];

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
