<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
Route::auth();
Route::get('/','HomeController@index');
//FOR ADMIN ROUTE GROUP


Route::get('home', function(){
    Session::forget('f_from');
    Session::forget('f_to');
    Session::forget('lists');
    return redirect('index');
});

Route::get('rpchallenge', 'PasswordController@change_password');
Route::get('index', 'AdminController@index');
Route::match(['get','post'], 'admin/upload', 'DtrController@upload');
Route::match(['get', 'post'],'search', 'DtrController@search');
Route::match(['get', 'post'], 'add/attendance', 'DtrController@create_attendance');
Route::get('dtr/print-monthly',function(){
   Session::forget('f_from');
   Session::forget('f_to');
   Session::forget('lists');
    return redirect('print');
});

Route::match(['get','post'], 'print-monthly', 'PrintController@print_monthly');
Route::get('print-monthly/attendance', 'PrintController@print_pdf');
Route::match(['get','post'], 'print/employee-attendance', 'PrintController@print_employee');

Route::get('work-schedule' ,'HoursController@create');
Route::match(['get','post'], 'create/work-schedule', 'HoursController@work_schedule');
Route::match(['get','post'] , 'edit/work-schedule/{id}' ,'HoursController@edit_schedule');
Route::match(['get','post'] , 'edit/attendance/{id?}', 'DtrController@edit_attendance');
Route::post('delete/attendance','DtrController@delete');
Route::get('resetpass', 'PasswordController@change_password');
Route::post('/', 'PasswordController@save_changes');





//DTR

Route::get('dtr/list/jo', 'GenerateDTRController@list_dtr');
Route::get('dtr/download/{id}', 'GenerateDTRController@download_dtr');
Route::get('/personal/dtr/list', 'GenerateDTRController@personal_dtrlist');

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
Route::get('personal/filter', 'PersonalController@search_filter');
//DOCUMENTS
Route::match(['get','post'],'form/leave','DocumentController@leave');
Route::get('form/leave/all', 'DocumentController@all_leave');
Route::get('leave/get/{id}','DocumentController@get_leave');
Route::get('leave/print/{id}', 'DocumentController@print_leave');

Route::get('list/pdf', 'DocumentController@list_print');


Route::match(['get','post'], 'form/so', 'DocumentController@so');
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



/////////RUSEL
Route::get('so_append','DocumentController@so_append');
Route::post('so_add','DocumentController@so_add');
/////////CALENDAR
Route::get('calendar', 'CalendarController@calendar');
Route::get('calendar_event', 'CalendarController@calendar_event');
Route::get('example','DocumentController@check_calendar');

//TEST ROUTES

Route::get('phpinfo', function() {
    return phpinfo();
});


Route::get('fpdf', 'PersonalController@rdr_home');
