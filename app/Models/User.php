<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use HasApiTokens, HasFactory, Notifiable;

//    protected $connection = 'mongodb';
//    protected $collection = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * Get all the user's contacts.
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class, 'user_id', 'id');
    }

    /**
     * Get all the user's uploads.
     */
    public function uploads()
    {
        return $this->morphMany(Upload::class, 'uplodable');
    }

    /**
     * Get all the user's uploads.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'user_id', 'id');
    }
}
