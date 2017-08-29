<?php
/**
 * Created by PhpStorm.
 * User: misscn
 * Date: 2017/8/26
 * Time: 下午3:20
 */

namespace App\Repositories;


use App\User;

class UserRepository
{
    public function byId($id)
    {
        return User::find($id);
    }
}