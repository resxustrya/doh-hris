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

Route::get('dtr/list/jo', 'GenerateDTRController@list_jo_dtr');
Route::get('dtr/list/regular', 'GenerateDTRController@list_regular_dtr');
Route::get('dtr/download/{id}', 'GenerateDTRController@download_dtr');
Route::get('/personal/dtr/list', 'GenerateDTRController@personal_dtrlist');
Route::get('/personal/dtr/filter/list','PersonalController@personal_filter_dtrlist');
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
Route::get('/personal/search/filter', 'PersonalController@search_filter');
Route::get('personal/print/monthly', 'PersonalController@print_monthly');
Route::post('personal/print/filter' ,'PersonalController@filter');
Route::post('personal/filter', 'PersonalController@emp_filtered');
Route::post('personal/filter/save', 'PersonalController@save_filtered');
Route::match(['get','post'], 'edit/personal/attendance/{id?}', 'PersonalController@edit_attendance');


//DOCUMENTS
Route::match(['get','post'],'form/leave','DocumentController@leave');
Route::get('form/leave/all', 'DocumentController@all_leave');
Route::get('leave/get/{id}','DocumentController@get_leave');
Route::get('leave/print/{id}', 'DocumentController@print_leave');
Route::get('leave/update/{id}', 'DocumentController@edit_leave');
Route::post('leave/update/save', 'DocumentController@save_edit_leave');

Route::get('list/pdf', 'DocumentController@list_print');

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
Route::match(['get','post'], 'form/track/{route_no}', 'DocumentController@track');
Route::match(['get','post'], 'form/sov1', 'DocumentController@sov1');
Route::match(['get','post'], 'form/so', 'DocumentController@so');
Route::match(['get','post'], 'form/so_view', 'DocumentController@so_view');
Route::match(['get','post'], 'form/so_list', 'DocumentController@so_list');
Route::get('form/so_pdf','DocumentController@so_pdf');
Route::get('inclusive_name_page', 'DocumentController@inclusive_name_page');
Route::get('inclusive_name_view', 'DocumentController@inclusive_name_view');
Route::get('so_append','DocumentController@so_append');
Route::post('so_add','DocumentController@so_add');
Route::post('so_addv1','DocumentController@so_addv1');
Route::post('so_update','DocumentController@so_update');
Route::post('so_updatev1','DocumentController@so_updatev1');
Route::post('so_delete','DocumentController@so_delete');
Route::get('form/info/{route}/{doc_type}', 'DocumentController@show');
/////////CALENDAR
Route::get('calendar','CalendarController@calendar');
Route::get('calendar_holiday','CalendarController@calendar_holiday');
Route::post('calendar_save','CalendarController@calendar_save');
Route::get('calendar_delete/{event_id}','CalendarController@calendar_delete');
Route::post('calendar_update','CalendarController@calendar_update');
Route::get('designation','DocumentController@designation_search');
/////////CDO / CTO
Route::match(["get","post"], "form/cdo_list","cdoController@cdo_list");
Route::match(["get","post"], "form/cdov1/{pdf}","cdoController@cdov1");
Route::post("cdo_addv1","cdoController@cdo_addv1");
Route::post('cdo_delete',"cdoController@cdo_delete");
Route::post("cdo_updatev1","cdoController@cdo_updatev1");
Route::match(["get","post"],"cdo/pending","cdoController@cdo_pending");
Route::match(["get","post"],"cdo/view","cdoController@cdo_view");
Route::get('cdo/table',function(){
    Schema::create('cdo', function(Blueprint $table) {
        $table->increments('id');
        $table->string('route_no','40');
        $table->text('subject');
        $table->string('doc_type','15');
        $table->integer('prepared_name');
        $table->datetime('prepared_date');
        $table->string('working_days','5');
        $table->text('start');
        $table->text('end');
        $table->text('beginning_balance');
        $table->text('less_applied_for');
        $table->text('remaining_balance');
        $table->text('recommendation');
        $table->integer('immediate_supervisor');
        $table->integer('division_chief');
        $table->integer('approved_status');
        $table->integer('status');
        $table->rememberToken();
        $table->timestamps();
    });
    return "Successfully added!";
});

/////////PDF
Route::get('pdf/v1/{size}', function($size){
    $display = view("pdf.pdf",['size'=>$size]);
    $pdf = App::make('dompdf.wrapper');
    $pdf->loadHTML($display);
    return $pdf->setPaper($size, 'portrait')->stream();
});
Route::get('pdf/track', function(){
    $display = view("pdf.track");
    $pdf = App::make('dompdf.wrapper');
    $pdf->loadHTML($display);
    return $pdf->stream();
});

//TEST ROUTES
Route::get('phpinfo', function() {
    return phpinfo();
});


Route::get('fpdf', 'PersonalController@rdr_home');

Route::get('emptype', function() {
    Schema::create('generated_pdf', function (Blueprint $table) {
        $table->increments('id');
        $table->string('filename')->nullable();
        $table->date('date_from')->nullable();
        $table->date('date_to')->nullable();
        $table->date('date_created');
        $table->time('time_created');
        $table->string('generated',10)->nullable();
        $table->rememberToken();
        $table->timestamps();
    });
});