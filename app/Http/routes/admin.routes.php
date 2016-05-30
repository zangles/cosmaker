<?php

Route::get('/',function(){
    return view('dashboard.index');
});

Route::resource('cosplay', 'cosplayController');
Route::resource('cosplay.parts','CosplayPartController');