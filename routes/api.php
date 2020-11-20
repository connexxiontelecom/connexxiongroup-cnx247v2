<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('/access_token', 'CNX247\API\TwilioAccessTokenController@generateToken');
Route::get('/task-calendar', 'CNX247\API\TaskControllerAPI@getTaskCalendarData');
Route::post('/conversation/call', 'CNX247\Backend\TokenController@newCall');

/* Route::post('register', 'CNX247\API\AuthController@register');
Route::post('login', 'CNX247\API\AuthController@login'); */

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', 'CNX247\API\AuthController@login');
    Route::post('register', 'CNX247\API\AuthController@register');
    Route::post('logout', 'CNX247\API\AuthController@logout');
    Route::post('refresh', 'CNX247\API\AuthController@refresh');
    Route::get('user-profile', 'CNX247\API\AuthController@userProfile');
    Route::get('IstokenValid', 'CNX247\API\AuthController@isValidToken');
});



Route::group(['middleware' => ['jwt.verify'], 'prefix'=>'auth' ], function() {
    Route::get('user', 'CNX247\API\AuthController@getAuthenticatedUser');
		Route::post('stream', 'CNX247\API\StreamController@index');
		Route::post('singlePost', 'CNX247\API\StreamController@StreamPost');
		Route::post('like', 'CNX247\API\StreamController@like');
		Route::post('comment', 'CNX247\API\StreamController@comment');
		Route::post('users', 'CNX247\API\usersController@users');
		Route::post('newtask', 'CNX247\API\StreamController@storeTask');
		Route::post('newproject', 'CNX247\API\StreamController@storeProject');
		Route::post('newannouncement', 'CNX247\API\StreamController@storeAnnouncement');
		Route::post('newevent', 'CNX247\API\StreamController@storeEvent');
		Route::post('newreport', 'CNX247\API\StreamController@storeReport');
		Route::post('sharefile', 'CNX247\API\StreamController@shareFile');
		Route::get('priorities', 'CNX247\API\StreamController@priorities');
});

//Route::get('users', 'CNX247\API\usersController@users');
Route::post('upload', 'CNX247\API\StreamController@upload');
Route::post('projectupload', 'CNX247\API\StreamController@projectUpload');
Route::post('uploadreport', 'CNX247\API\StreamController@uploadReport');


