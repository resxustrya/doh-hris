<?php
Use App\Tracking;
Route::auth();

//jimzky
Route::get('/','HomeController@index');
Route::get('dashboard', function(){
    Session::forget('lists');
    return redirect('home');
});
Route::get('home', 'HomeController@index');
Route::match(['get','post'], 'upload', 'DtrController@upload');
Route::match(['get', 'post'],'search', 'DtrController@search');
Route::get('clear', function(){
    Session::flush();
    return redirect('/');
});

Route::get('modal',function(){
    return view('users.modal');
});
