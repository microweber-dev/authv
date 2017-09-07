<?php
use Carbon\Carbon;

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
Passport::tokensExpireIn(Carbon::now()->addDays(15));
Passport::enableImplicitGrant();


Route::get('/home', 'HomeController@index');

Route::get('/me', function () {
    //

    $user = App\User::find(\Auth::user());
    return $user;


    return \Auth::guard('api')->user();
    return \Auth::guard('api')->user();;


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


Route::get('logout', function (\Request $request) {
//    if (\Auth::check()) {
//        \Auth::logout();
//    }
    \Auth::logout();
    // \Cookie::queue(\Cookie::forget('mw_login_session'));
    \Session::flush();

    \Cookie::forget('mw_login_session');
    if (\Request::ajax()) {
        return true;
    }


    return redirect('/home');

});

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

Route::any('avatar/{any}', function ($first, $rest = '') {
    if (!$first) {
        return;
    }
    $remote_avatar = false;

    $first = str_replace('..', '', $first);
    $avatars_path = public_path() . '/avatar/';
    $fn = $avatars_path . $first;
    if (!is_file($fn)) {
        $md5 = explode('.', $first);
        $md5 = reset($md5);

        $record = \DB::table('oauth_users')->where(\DB::raw('MD5(email)'), '=', $md5)->first();
        if ($record and $record->avatar) {
            if (stristr($record->avatar, '//')) {
                $remote_avatar = $record->avatar;
            }
        }
    }

    if (!$remote_avatar) {
        $remote_avatar = public_path() . '/avatar.jpg';
    }


    if ($remote_avatar) {

        $path = $avatars_path;

        $img = $remote_avatar;
        $dst = $fn;
$img_cont = file_get_contents($img);
        if (($img_info = getimagesize($img)) === FALSE) {
            die("Image not found or not an image");
        }

        $width = $img_info[0];
        $height = $img_info[1];

        switch ($img_info[2]) {
            case IMAGETYPE_GIF  :
                $src = imagecreatefromgif($img);
                break;
            case IMAGETYPE_JPEG :
                $src = imagecreatefromjpeg($img);
                break;
            case IMAGETYPE_PNG  :
                $src = imagecreatefrompng($img);
                break;
            default :
                die("Unknown filetype");
        }

//        $imginfo = getimagesize( $img );
//        header("Content-type: image/jpg");
//        readfile( $img );
//
//        return;
//
//        $tmp = imagecreatetruecolor($width, $height);
//        imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, $width, $height);
//        imagejpeg($src, $dst);


        $response = response($img_cont, 200)->header('Content-Type', $img_info['mime']);
        return $response;


    }


    //  dd($fn);
    // dd($first);

    $filename = $first;
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    switch ($ext) {
        case "gif":
            header('Content-Type: image/gif');
            readfile($filename);
            break;
        case "png":
            header('Content-Type: image/png');
            readfile($filename);
            break;
        case "jpg":
        default:
            header('Content-Type: image/jpeg');
            readfile($filename);
            break;
    }


    // $page = $rest ? "{$first}/{$rest}" : $first;
    //dd($page);
});




