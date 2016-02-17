<?php

use App\Position;
/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/change/{new_position}', function ($new_position){
    $last_position = Position::orderBy('position_time','desc')->first();
    if(\Carbon\Carbon::parse($last_position->position_time)->isToday() && $last_position->position != $new_position){
        $position = new Position();
        $position->position=$new_position;
        $position->position_time=\Carbon\Carbon::now('EST');
        $position->save();
        return $position ;
    }
    return $last_position;
});

Route::get('/current', function (){
    $position = Position::orderBy('position_time','desc')->first();
    return $position;
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
