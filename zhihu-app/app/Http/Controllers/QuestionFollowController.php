<?php

namespace App\Http\Controllers;

use App\Repositories\QuestionRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Auth;
class QuestionFollowController extends Controller
{
    protected  $questions;

    public function __construct(QuestionRepository $questions)
    {
        $this->middleware('auth');

        $this->questions = $questions;
    }
    
    public function follow($question)
    {
//        Auth::user()->followThis($question);
//
//        return back();

//        dd($question);
        $questionToFollow = $this->questions->byId($question);


//        dd($questionToFollow);
        $follow = Auth::user()->followThis($question);
//        dd($follow);


        if(count($follow['attached']) > 0){

            $questionToFollow->increment('follower_count');

            return back();
        }

        $questionToFollow->decrement('follower_count');

        return back();
    }
}
