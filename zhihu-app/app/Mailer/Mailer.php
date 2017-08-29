<?php
/**
 * Created by PhpStorm.
 * User: misscn
 * Date: 2017/8/28
 * Time: 下午12:00
 */

namespace App\Mailer;

use Mail;
use Naux\Mail\SendCloudTemplate;

class Mailer
{
    protected function sendTo($template,$email,$data)
    {

        $content = new SendCloudTemplate($template,$data);

        Mail::raw($content, function($message) use($email){
            $message->from('516552667@qq.com', 'yesia_date');

            $message->to($email);
        });
    }
}