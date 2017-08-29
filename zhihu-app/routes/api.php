<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/topics', function (Request $request) {
    $topics = \App\topic::select(['id','name'])
        ->where('name','like','%'.$request->query('q').'%')
        ->get();
//    echo $topics;die;
    return $topics;
})->middleware('api');

Route::middleware('api')->post('/question/follower', function (Request $request) {
//    $followed = \App\Follow::where('question_id',$request->get('question'))
//                ->where('user_id',$request->get('user'))
//                ->count();
//    if($followed){
//        return response()->json(['followed' => true]);
//    }
   // return response()->json(['followed' => false]);
    return response()->json(['question'=>request('question')]);

});

//Route::middleware('api')->post('/question/follow', function (Request $request) {
//    $followed = \App\Follow::where('question_id',$request->get('question'))
//        ->where('user_id',$request->get('user'))
//        ->first();
//    return followed;
//    if($followed !== null){
//        $folloed->delete();
//        return response()->json(['followed' => false]);
//    }
//        \App\Follow::create(['user_id'=>$request->get('user'),'question_id'=>$request->get('question')]);
//    return response()->json(['followed' => true]);
//
//});