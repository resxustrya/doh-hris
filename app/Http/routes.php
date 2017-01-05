<?php
Use App\Tracking;
Route::auth();

//jimzky
Route::get('/','HomeController@index');

Route::get('home', 'HomeController@index');
Route::match(['get','post'], 'upload', 'DtrController@upload');

Route::get('clear', function(){
    Session::flush();
    return redirect('/');
});

Route::get('modal',function(){
    return view('users.modal');
});
