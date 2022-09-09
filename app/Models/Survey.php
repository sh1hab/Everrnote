<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Jenssegers\Mongodb\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    const TYPE_TEXT = 'text';
    const TYPE_TEXTAREA = 'textarea';
    const TYPE_SELECT = 'select';
    const TYPE_RADIO = 'radio';
    const TYPE_CHECKBOX = 'checkbox';


    /**
     * @var string[]
     */
    protected $fillable = ['user_id', 'title', 'slug', 'status', 'description', 'expire_date', 'upload_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne|\Jenssegers\Mongodb\Relations\HasOne
     */
    public function upload()
    {
        return $this->hasOne(Upload::class, '_id', 'upload_id');
    }

    /**
     * @return HasMany|\Jenssegers\Mongodb\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany(SurveyQuestion::class);
    }

    /**
     * @return HasMany|\Jenssegers\Mongodb\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany(SurveyAnswer::class);
    }
}
