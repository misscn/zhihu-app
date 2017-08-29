<?php

namespace App\Http\Controllers;

use App\Notifications\NewUserFollowNotification;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;
use Auth;

class FollowerUserController extends Controller
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function followserusers($followers)
    {
        Auth::user()->followeruser($followers);

        return back();
    }

//    public function index($id)
//    {
//        Auth::user()->followThisUser($id);
//
//        return back();
//    }

    public function index($id)
    {
        $userToFollow = $this->user->byId($id);

//        $followers = $userToFollow->followers()->pluck('follower_id')->toArray();
//        dd($followers);

//        if(in_array(Auth::id(),$followers)){
//
//           $followed = Auth::user()->followThisUser($userToFollow);
//
////           return Auth::user()->userToFollowers($followed);
//
//                if(count($followed['attached']) > 0){
//
//                            $userToFollow->increment('followers_count');
//
//                            return back();
//                        }
//
//                        $userToFollow->decrement('followers_count');
//
//                        return back();
//            }

        $followed = Auth::user()->followThisUser($userToFollow);

//           return Auth::user()->userToFollowers($followed);

        if(count($followed['attached']) > 0){

            $userToFollow->notify(new NewUserFollowNotification());

            $userToFollow->increment('followers_count');

            return back();
        }

        $userToFollow->decrement('followers_count');

        return back();


    }

}
