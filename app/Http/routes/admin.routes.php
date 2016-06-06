<?php

Route::get('/',function(){
    return view('dashboard.index');
});

Route::resource('cosplay', 'CosplayController');
Route::get('/cosplay/{cosplay}/{tab}', array('as' => 'admin.cosplay.showtab', 'uses' => 'CosplayController@showtab') );
Route::resource('cosplay.parts','CosplayPartController');

Route::resource('cosplay.gastos','CosplayGastosController');