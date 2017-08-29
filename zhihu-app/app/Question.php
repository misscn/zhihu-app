<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title','body','user_id'];

    public function topics()
    {
        return $this->belongsToMany(topic::class)->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class,'question_user')->withTimestamps();
    }



    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_hidden','F');
    }
    
    

}
