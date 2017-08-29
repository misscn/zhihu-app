<?php
/**
 * Created by PhpStorm.
 * User: misscn
 * Date: 2017/8/28
 * Time: 下午12:05
 */

namespace App\Mailer;
use App\User;
use Auth;

class UserMailer extends Mailer
{
    public function followNotifyEmail($email)
    {
        $data = [
            'url' => 'http://zhihu.app','name' => Auth::user()->name,
        ];

        $this->sendTo('zhihu_app_new_user_follow',$email,$data);
    }

    public function userPasswordReset($token,$email)
    {
        $data = [
            'url' => url('password/reset',$token),
        ];

        $this->sendTo('zhihu_app_password_reset',$email,$data);
    }

    public function register(User $user)
    {
        $data = [
            'url' => route('email.verify',['token' => $user->confirmation_token]),
            'name' =>  $user->name,
        ];

        $this->sendTo('yesia_test',$user->email,$data);
    }
}