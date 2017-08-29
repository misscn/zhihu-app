<?php
/**
 * Created by PhpStorm.
 * User: misscn
 * Date: 2017/8/27
 * Time: 下午6:34
 */

namespace App\Channels;


use Illuminate\Notifications\Notification;

class SendcloudChannel
{
    public function send($notifiable,Notification $notification)
    {
        $message = $notification->toSendcloud($notifiable);
    }
}