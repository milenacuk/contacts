<?php

use Illuminate\Http\Request;
// use \App\Http\Controllers\ContactsController;

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
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Methods: PUT,GET,POST,DELETE,OPTIONS');
// header('Access-Control-Allow-Headers: Content-Type,Accept,Origin');
//ovo gore je jedan od nacina da nam Laravel prima informacije od drugih izvora,frameworka,nije najbolje resenje,treba instalirati Cors

Route::group([
    'prefix'=> 'auth',
    'namespace' => 'Auth'
],function(){
    Route::post('/login', 'AuthController@login');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('contacts',ContactsController::class)->except(['edit','create']);
//zato sto smo naveli ::class ne moramo gore da usujemo
