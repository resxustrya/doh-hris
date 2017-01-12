<?php
Use App\Tracking;
Route::auth();

//jimzky
Route::get('/','HomeController@index');
Route::get('dashboard', function(){
    Session::forget('f_from');
    Session::forget('f_to');
    Session::forget('lists');
    return redirect('home');
});

Route::get('home', 'HomeController@index');
Route::match(['get','post'], 'upload', 'DtrController@upload');
Route::match(['get', 'post'],'search', 'DtrController@search');

Route::get('dtr/print-monthly',function(){
    Session::forget('f_from');
    Session::forget('f_to');
    Session::forget('lists');
    return redirect('print');
});
Route::get('print','PrintController@home');
Route::match(['get','post'], 'print-monthly', 'PrintController@print_monthly');
Route::match(['get','post'], 'print/employee-attendance', 'PrintController@print_employee');

Route::get('new/flixetime' ,'HoursController@create');
Route::match(['get','post'], 'create/flixe', 'HoursController@create_flixe');


Route::get('clear', function(){
    Session::flush();
    return redirect('/');
});

Route::get('modal',function(){
    return view('users.modal');
});

Route::get('errorupload', function(){
    return view('errorupload');
});
