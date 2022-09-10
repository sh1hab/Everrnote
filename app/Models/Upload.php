<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Upload extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'url',
        'type',
    ];
}
