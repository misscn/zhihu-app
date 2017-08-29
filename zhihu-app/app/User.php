<?php

namespace App;

use App\Mailer\UserMailer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Naux\Mail\SendCloudTemplate;
use Mail;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'confirmation_token','api_token'
    ];


    public function owns(Model $model)
    {
        return $this->id == $model->user_id;
    }


    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token){

        (new UserMailer())->userPasswordReset($token,$this->email);

    }




    public function followers()
    {
        return $this->belongsToMany(self::class,'followers','follower_id','followed_id')->withTimestamps();
    }



    public function followerUserId($followers)
    {
        return !! $this->followers()->where('follower_id',$followers)->count();

    }

    public function followThis($question)
    {
        return $this->follows()->toggle($question);
    }

    public function follows()
    {
        return $this->belongsToMany(Question::class,'question_user')->withTimestamps();
    }

    public function followed($question)
    {
        return !! $this->follows()->where('question_id',$question)->count();

    }

    public function followThisUser($id)
    {
        return $this->followers()->toggle($id);
    }

    public function userFollowed($id)
    {
        return !!  $this->followers()->where('followed_id',$id)->count();
    }


}
