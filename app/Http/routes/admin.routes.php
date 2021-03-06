<?php

Route::get('/',function(){
    //return view('cosplay.index');
    return redirect()->route('admin.cosplay.index');
});

Route::resource('cosplay', 'CosplayController');

Route::get('/cosplay/{cosplay}/{tab}', array('as' => 'admin.cosplay.showtab', 'uses' => 'CosplayController@showtab') );

Route::resource('cosplay.parts','CosplayPartController');

Route::resource('cosplay.gastos','CosplayGastosController');
Route::get('/cosplay/tareas/{task}/{status}', array('as' => 'admin.tareas.changeStatus', 'uses' => 'CosplayTareasController@changeStatus') );
Route::resource('cosplay.tareas','CosplayTareasController');
Route::resource('cosplay.referencias','CosplayReferenciasController');
