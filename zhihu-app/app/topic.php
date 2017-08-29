<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class topic extends Model
{
    protected $fillable = ['name','questions_count','bio'];

    public function questions()
    {
        return $this->belongsToMany(Question::class)->withTimestamps();
    }

}
