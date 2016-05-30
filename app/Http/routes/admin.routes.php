<?php

Route::get('/',function(){
    return view('dashboard.index');
});

Route::resource('cosplay', 'CosplayController');
Route::resource('cosplay.parts','CosplayPartController');