<?php
Route::auth();
Route::get('/','HomeController@index');
//FOR ADMIN ROUTE GROUP


Route::get('home', function(){
    Session::forget('f_from');
    Session::forget('f_to');
    Session::forget('lists');
    return redirect('index');
});

Route::get('index', 'AdminController@index');
Route::match(['get','post'], 'admin/upload', 'DtrController@upload');
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


//FOR PERSONAL ROUTE GROUP

Route::get('personal/home', function() {
    Session::forget('f_from');
    Session::forget('f_to');
    Session::forget('lists');
    return redirect('personal/index');
});
Route::get('personal/monthly',function() {
   Session::forget('filter_list');
   return redirect('personal/print/monthly');
});

Route::get('personal/index', 'PersonalController@index');
Route::get('personal/print/monthly', 'PersonalController@print_monthly');
Route::post('personal/print/filter' ,'PersonalController@filter');




//DOCUMENTS
Route::match(['get','post'],'form/leave','DocumentController@leave');
Route::get('form/leave/all', 'DocumentController@all_leave');
Route::match(['get','post'], 'form/so', 'DocumentController@so');
Route::get('clear', function(){
    Session::flush();
    return redirect('/');
});

Route::get('calendar', function() {
    return view('calendar.calendar');
});

Route::get('modal',function(){
    return view('users.modal');
});

Route::get('errorupload', function(){
    return view('errorupload');
});

Route::get('test/form', function(){
    return view('test.form');
});
Route::post('test/form',function(\Illuminate\Http\Request $request){
    return $request->all();
});

Route::get('pdf/leave',function() {

    $display = view("pdf.leave");
    $pdf = App::make('dompdf.wrapper');
    $pdf->loadHTML($display);
    return $pdf->stream();
});