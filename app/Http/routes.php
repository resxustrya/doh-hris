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

Route::get('dtr/print-monthly',function(){
   Session::forget('f_from');
   Session::forget('f_to');
   Session::forget('lists');
    return redirect('print');
});
Route::get('print','PrintController@home');
Route::match(['get','post'], 'print-monthly', 'PrintController@print_monthly');
Route::match(['get','post'], 'print/employee-attendance', 'PrintController@print_employee');

Route::get('work-schedule' ,'HoursController@create');
Route::match(['get','post'], 'create/work-schedule', 'HoursController@work_schedule');
Route::match(['get','post'] , 'edit/work-schedule/{id}' ,'HoursController@edit_schedule');

Route::get('resetpass', 'PasswordController@change_password');
Route::post('/', 'PasswordController@save_changes');


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
Route::get('leave/get/{id}','DocumentController@get_leave');
Route::get('leave/print/{id}', 'DocumentController@print_leave');

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



Route::get('drop', function(Request $request) {

    $table = $request->input('table');
    $drop = $request->input('drop');
    if($drop == "yes") {
        \Illuminate\Support\Facades\Schema::dropIfExists($table);
        return "Table drop";
    } else {
        Schema::create('leave', function(Blueprint $table){
            $table->increments('id');
            $table->string('userid');
            $table->string('office_agency')->nullable();
            $table->string('lastname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('middlename')->nullable();
            $table->date('date_filling')->nullable();
            $table->string('position')->nullable();
            $table->double('salary')->nullable();
            $table->string('leave_type')->nullable();
            $table->string('leave_type_others_1')->nullable();
            $table->string('leave_type_others_2')->nullable();
            $table->string('vication_loc')->nullable();
            $table->string('abroad_others')->nullable();
            $table->string('sick_loc')->nullable();
            $table->string('in_hospital_specify')->nullable();
            $table->string('out_patient_specify')->nullable();
            $table->string('applied_num_days')->nullable();
            $table->date('inc_from')->nullable();
            $table->date('inc_to')->nullable();
            $table->string('com_requested')->nullable();
            $table->date('credit_date')->nullable();
            $table->string('vication_total')->nullable();
            $table->string('sick_total')->nullable();
            $table->string('over_total')->nullable();
            $table->string('a_days_w_pay')->nullable();
            $table->string('a_days_wo_pay')->nullable();
            $table->string('a_others')->nullable();
            $table->string('reco_approval')->nullable();
            $table->text('reco_disaprove_due_to')->nullable();
            $table->text('disaprove_due_to')->nullable();
            $table->softDeletes();
            $table->timestamps();

            return "Table created";
        });
    }
});