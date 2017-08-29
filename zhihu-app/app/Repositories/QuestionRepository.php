<?php
/**
 * Created by PhpStorm.
 * User: misscn
 * Date: 2017/8/22
 * Time: 下午4:51
 */

namespace App\Repositories;


use App\Question;
use App\topic;

class QuestionRepository
{
    public function byIdWithTopicsAndAnswers($id)
    {
        return Question::where('id',$id)->with(['topics','answers'])->first();
    }

    public function mormalizeTopic($topics)
    {
        return collect($topics)->map(function($topic){
            if(is_numeric($topic)){
                topic::find($topic)->increment('question_count');
                return (int)$topic;
            }
            $newTopic = topic::create(['name'=>$topic,'question_count'=>1]);
            return $newTopic->id;
        })->toArray();
    }

    public function create($attributes){
        return Question::create($attributes);
    }

    public function byId($id)
    {
        return Question::find($id);
    }

    public function getQuestionsFeed()
    {
        return Question::published()->latest('updated_at')->with('user')->get();
    }

}