<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

Route::group(['middleware' => ['web']], function(){
    require __DIR__ .'/routes/web.routes.php';
});


Route::group(['middleware' => ['admin'],'prefix' => 'admin'], function(){
    require __DIR__ .'/routes/admin.routes.php';
});



