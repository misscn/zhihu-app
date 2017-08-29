<?php
/**
 * Created by PhpStorm.
 * User: misscn
 * Date: 2017/8/23
 * Time: 下午4:31
 */

namespace App\Repositories;


use App\Answer;

class AnswerRepository
{
    public function create($attributes){
        return Answer::create($attributes);
    }
}