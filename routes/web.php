<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function (Request $request) {


    if (Auth::check()) {

        return redirect('/home');
    } else {
        return redirect('/login');
    }
});

Auth::routes();

Authv::routes();
Passport::routes();

Route::get('/home', 'HomeController@index');

Route::get('/me', function () {
    //
    $user = App\User::find(\Auth::user());
    return $user;
})->middleware('auth:api');


Route::get('user', function () {
    return \Auth::guard('api')->user();;

});

Route::get('/api/user', function (Request $request) {
    return \Auth::guard('api')->user();;

    //$access_token = \Request::input()->all();
    $input = Request::all();

    //$user =  \Auth::guard('api')->user();
    //$user =  \Auth::user();

    return $input;

    return $request->user();
});



//Route::get('/api/user', function (Request $request) {
//    return $request->user();
//})->middleware('auasdth:api');


Route::get('sssapi/user', function (\Request $request) {

    //$access_token =\Request::header();
    $access_token = \Request::input()->all();

    //$user =  \Auth::guard('api')->user();
    //$user =  \Auth::user();

    return $access_token;
});
//Route::get('/api/make_user_token/{user}', function ($user) {
//    $user = App\User::find($user);
//
//// Creating a token without scopes...
//    $token = $user->createToken('Token Name')->accessToken;
//
//    return $token;
//});