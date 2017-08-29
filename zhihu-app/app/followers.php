<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class followers extends Model
{
    protected  $table = 'followers';

    protected $fillable = ['follower_id','followed_id'];

    public function followeruser($followers)
    {
//        return $this->followers()->toggle($followers);
        $data = $this->followers()->where('follower_id',$followers)->count();

        if(!$data){
//           dd($followers);
            $this->followers()->create([
                'follower_id' => $followers,
                'followed_id' => Auth::id(),

            ]);

        }

        $data->delete();

    }
}
