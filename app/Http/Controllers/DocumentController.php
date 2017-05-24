<?php
/**
 * Created by PhpStorm.
 * User: Lourence
 * Date: 1/23/2017
 * Time: 9:41 AM
 */

namespace App\Http\Controllers;
use App\cdo;
use App\Leave;
use App\Users;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Calendar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\inclusive_name;
use App\office_order;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\pdoController as pdo;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public  function leave(Request $request)
    {
        if($request->isMethod('get')){
            $user = Users::where('userid','=',Auth::user()->userid)->first();
            return view('form.form_leave')->with('user',$user);
        }
        if($request->isMethod('post')) {


            $leave = new Leave();

            $leave->userid = $request->user()->id;
            $leave->office_agency = $request->input('office_agency');
            $leave->lastname = $request->input('lastname');
            $leave->firstname = $request->input('firstname');
            $leave->middlename = $request->input('middlename');
            $date_filling = explode('/', $request->input('date_filling'));
            $leave->date_filling = $date_filling[2].'-'.$date_filling[0].'-'.$date_filling[1];


            $leave->position = $request->input('position');
            $leave->salary = $request->input('salary');
            $leave->leave_type = $request->input('leave_type');
            $leave->leave_type_others_1 = $request->input('leave_type_others_1');
            $leave->leave_type_others_2 = $request->input('leave_type_others_2');
            $leave->vication_loc = $request->input('vication_loc');
            $leave->abroad_others = $request->input('abroad_others');
            $leave->sick_loc = $request->input('sick_loc');
            $leave->in_hospital_specify = $request->input('in_hospital_specify');
            $leave->out_patient_specify = $request->input('out_patient_specify');
            $leave->applied_num_days = $request->input('applied_num_days');


            $temp1 = explode('-',$request->input('inc_date'));
            $temp2 = array_slice($temp1, 0, 1);
            $tmp = implode(',', $temp2);
            $date_from = date('Y-m-d',strtotime($tmp));

            $temp3 = array_slice($temp1, 1, 1);
            $tmp = implode(',', $temp3);
            $date_to = date('Y-m-d',strtotime($tmp));

            $leave->inc_from = $date_from;
            $leave->inc_to = $date_to;


            $leave->com_requested = $request->input('com_requested');
            $credit_date = explode('/', $request->input('credit_date'));
            $leave->credit_date = $credit_date[2].'-'.$credit_date[0].'-'.$credit_date[1];
            $leave->vication_total = $request->input('vication_total');
            $leave->sick_total = $request->input('sick_total');
            $leave->over_total = $request->input('over_total');
            $leave->a_days_w_pay = $request->input('a_days_w_pay');
            $leave->a_days_wo_pay = $request->input('a_days_wo_pay');
            $leave->a_others = $request->input('a_others');
            $leave->reco_approval = $request->input('reco_approval');
            $leave->reco_disaprove_due_to = $request->input('reco_disaprove_due_to');
            $leave->disaprove_due_to = $request->input('disaprove_due_to');

            $leave->save();
            return redirect('form/leave/all')->with('message','New application for leave created.');

        }
    }
    public function edit_leave(Request $request, $id)
    {

       $leave = Leave::where('id',$id)->first();
       if(isset($leave) and count($leave) > 0)  {
           return view('form.update_leave')->with('leave',$leave);
       }
       return redirect('form/leave/all');
    }

    public function save_edit_leave(Request $request)
    {

        $leave = Leave::where('id', $request->input('id'))->first();
        if(isset($leave) and count($leave) > 0) {
            $leave->userid = $request->user()->id;
            $leave->office_agency = $request->input('office_agency');
            $leave->lastname = $request->input('lastname');
            $leave->firstname = $request->input('firstname');
            $leave->middlename = $request->input('middlename');

            $leave->date_filling = $request->input('date_filling');
            $leave->position = $request->input('position');
            $leave->salary = $request->input('salary');
            $leave->leave_type = $request->input('leave_type');
            $leave->leave_type_others_1 = $request->input('leave_type_others_1');
            $leave->leave_type_others_2 = $request->input('leave_type_others_2');
            $leave->vication_loc = $request->input('vication_loc');
            $leave->abroad_others = $request->input('abroad_others');
            $leave->sick_loc = $request->input('sick_loc');
            $leave->in_hospital_specify = $request->input('in_hospital_specify');
            $leave->out_patient_specify = $request->input('out_patient_specify');
            $leave->applied_num_days = $request->input('applied_num_days');


            $temp1 = explode('-',$request->input('inc_date'));
            $temp2 = array_slice($temp1, 0, 1);
            $tmp = implode(',', $temp2);
            $date_from = date('Y-m-d',strtotime($tmp));

            $temp3 = array_slice($temp1, 1, 1);
            $tmp = implode(',', $temp3);
            $date_to = date('Y-m-d',strtotime($tmp));

            $leave->inc_from = $date_from;
            $leave->inc_to = $date_to;


            return $leave->inc_from . " : " . $leave->inc_to;


            $leave->com_requested = $request->input('com_requested');
            $leave->credit_date = $request->input('credit_date');
            $leave->vication_total = $request->input('vication_total');
            $leave->sick_total = $request->input('sick_total');
            $leave->over_total = $request->input('over_total');
            $leave->a_days_w_pay = $request->input('a_days_w_pay');
            $leave->a_days_wo_pay = $request->input('a_days_wo_pay');
            $leave->a_others = $request->input('a_others');
            $leave->reco_approval = $request->input('reco_approval');
            $leave->reco_disaprove_due_to = $request->input('reco_disaprove_due_to');
            $leave->disaprove_due_to = $request->input('disaprove_due_to');

            $leave->save();
            return redirect('form/leave/all')->with('message','Application for leave updated.');
        }
        return redirect('form/leave/all');
    }

    public function all_leave()
    {
        $leaves = Leave::paginate(15);
        return view('form.list_leave')->with('leaves', $leaves);
    }

    public function get_leave(Request $request, $id)
    {
        $leave = Leave::find($id);
        return view('form.leave')->with('leave', $leave);
    }

    public function print_leave(Request $request, $id)
    {
        $leave = Leave::find($id);
        $display = view('pdf.leave')->with('leave', $leave);
        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper('LEGAL', 'portrait');
        $pdf->loadHTML($display);
        return $pdf->stream();
    }

    public function list_print()
    {
        $display = view('pdf.personal_dtr');
        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper('A4', 'portrait');
        $pdf->loadHTML($display);
        return $pdf->stream();
    }

    ///RUSEL
    //OFFICE ORDER
    public function so_delete(Request $request)
    {
        $prepared_by =  pdo::user_search($request->user()->userid)['id'];
        $route_no = Session::get('route_no');

        office_order::where('route_no',$route_no)->delete();
        inclusive_name::where('route_no',$route_no)->delete();
        Calendar::where('route_no',$route_no)->delete();

        pdo::delete_tracking_master($route_no);
        pdo::delete_tracking_details($route_no);
        //$this->delete_tracking_release($route_no);

        //ADD SYSTEM LOGS
        $user_id = $prepared_by;
        $name = $request->user()->fname.' '.$request->user()->mname.' '.$request->user()->lname;
        $activity = 'Deleted';
        pdo::insert_system_logs($user_id,$name,$activity,$route_no);
        Session::put('deleted',true);

        return redirect()->back();
    }

    public function track($route_no){
        $document = pdo::search_tracking_details($route_no);
        Session::put('route_no',$route_no);
        return view('document.track',['document' => $document]);
    }

    public function so(Request $request)
    {
        Session::put('my_id',$request->user()->id);
        if($request->isMethod('get')){
            $users = pdo::users();
            return view('form.office_order',['users'=>$users]);
        }
        if($request->isMethod('post')){
            return $request->all();
        }
    }

    public function sov1()
    {
        $inclusive_name = $this->inclusive_name_page();
        $users = pdo::users();
        return view('form.office_orderv1',['users'=>$users,'inclusive_name'=>$inclusive_name]);
    }

    public function so_view(Request $request)
    {
        Session::put('my_id',$request->user()->id);
        if($request->isMethod('get')){
            $users = pdo::users();
            $office_order = office_order::where('route_no',Session::get('route_no'))->get()->first();
            $inclusive_date = Calendar::where('route_no',Session::get('route_no'))->get();
            return view('form.office_order_view',['users'=>$users,'office_order'=>$office_order,'inclusive_date'=>$inclusive_date]);
        }
        if($request->isMethod('post')){
            return $request->all();
        }
    }
    public function so_pdf()
    {
        Session::put('my_id',Auth::user()->id);
        $users = pdo::users();
        $office_order = office_order::where('route_no',Session::get('route_no'))->get()->first();
        $inclusive_name = inclusive_name::where('route_no',Session::get('route_no'))->get();
        $inclusive_date = Calendar::where('route_no',Session::get('route_no'))->get();
        foreach($inclusive_name as $row){
            $name[] = pdo::user_search1($row['user_id']);
        }
        $display = view('form.office_order_pdf',['users'=>$users,'office_order'=>$office_order,'inclusive_date'=>$inclusive_date,'name'=>$name]);

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($display)->setPaper('a4','portrait');

        if(Session::get('route_no'))
            return $pdf->stream();
        else
            return redirect('/');
    }

    public function inclusive_name_page(){
        $name[] = pdo::user_search(Auth::user()->userid)['id'];
        return $name;
    }
    
    public function inclusive_name_view(){
        $inclusive_name = inclusive_name::where('route_no',Session::get('route_no'))->get();
        foreach($inclusive_name as $row){
            $name[] = $row['user_id'];
        }
        return $name;
    }

    public function so_list(Request $request){
        Session::put('keyword',$request->keyword);
        $keyword = Session::get('keyword');
        $office_order = Office_order::where('prepared_by',pdo::user_search(Auth::user()->userid)['id'])
            ->where(function($q) use ($keyword){
                $q->where('route_no','like',"%$keyword%")
                    ->orwhere('subject','like',"%$keyword%");
            })
            ->orderBy('id','desc')
            ->paginate(10);
        return view('form.office_order_list',['office_order' => $office_order]);
    }

    public function so_append(){
        return view('form.office_order_append');
    }

    public function so_addv1(Request $request){
        $route_no = date('Y-') . pdo::user_search($request->user()->userid)['id'] . date('mdHis');
        $doc_type = 'OFFICE_ORDER';
        $prepared_date = date('Y-m-d',strtotime($request->get('prepared_date'))).' '.date('H:i:s');
        $prepared_by =  pdo::user_search($request->user()->userid)['id'];
        $description = $request->get('subject');

        //ADD OFFICE ORDER
        $office_order = new office_order();
        $office_order->route_no = $route_no;
        $office_order->doc_type = $doc_type;
        $office_order->subject = $request->get('subject');
        $office_order->prepared_by = $prepared_by;
        $office_order->prepared_date = $prepared_date;
        $office_order->version = 1;
        $office_order->save();

        //ADD INCLUSIVE NAME
        $count = 0;
        foreach($request->get('inclusive_name') as $row){
            $inclusive_name = new inclusive_name();
            $inclusive_name->route_no = $route_no;
            $inclusive_name->user_id = $request->get('inclusive_name')[$count];
            $inclusive_name->status = 1;
            $inclusive_name->save();
            $count++;
        }

        //ADD CALENDAR
        $count = 0;
        foreach($request->get('inclusive') as $result)
        {
            $str = $result;
            $temp1 = explode('-',$str);
            $temp2 = array_slice($temp1, 0, 1);
            $tmp = implode(',', $temp2);
            $start_date = date('Y-m-d',strtotime($tmp));

            $temp3 = array_slice($temp1, 1, 1);
            $tmp = implode(',', $temp3);
            $enddate = date_create(date('Y-m-d',strtotime($tmp)));
            date_add($enddate, date_interval_create_from_date_string('1days'));
            $end_date = date_format($enddate, 'Y-m-d');

            $so = new Calendar();
            $so->route_no = $route_no;
            $so->title = $request->get('subject');
            $so->start = $start_date;
            $so->end = $end_date;
            $so->area = $request->get('area')[$count];
            $so->backgroundColor = 'rgb(216, 27, 96)';
            $so->borderColor = 'rgb(216, 27, 96)';
            $so->status = 0;
            $so->save();
            $count++;
        }

        //ADD TRACKING MASTER
        pdo::insert_tracking_master($route_no,$doc_type,$prepared_date,$prepared_by,$description);

        //ADD TRACKING DETAILS
        $date_in = $prepared_date;
        $received_by = $prepared_by;
        $delivered_by = $prepared_by;
        $action = $description;
        pdo::insert_tracking_details($route_no,$date_in,$received_by,$delivered_by,$action);

        //ADD SYSTEM LOGS
        $user_id = $prepared_by;
        $name = $request->user()->fname.' '.$request->user()->mname.' '.$request->user()->lname;
        $activity = 'Created';
        pdo::insert_system_logs($user_id,$name,$activity,$route_no);
        Session::put('added',true);

        return redirect()->back();
    }

    public function so_add(Request $request){
        $route_no = date('Y-') . pdo::user_search($request->user()->userid)['id'] . date('mdHis');
        $doc_type = 'OFFICE_ORDER';
        $prepared_date = date('Y-m-d',strtotime($request->get('prepared_date'))).' '.date('H:i:s');
        $prepared_by =  pdo::user_search($request->user()->userid)['id'];
        $description = $request->get('subject');

        //ADD OFFICE ORDER
        $office_order = new office_order();
        $office_order->route_no = $route_no;
        $office_order->doc_type = $doc_type;
        $office_order->subject = $request->get('subject');
        $office_order->header_body = $request->get('header_body');
        $office_order->footer_body = $request->get('footer_body');
        $office_order->approved_by = $request->get('approved_by');
        $office_order->prepared_by = $prepared_by;
        $office_order->prepared_date = $prepared_date;
        $office_order->version = 2;
        $office_order->save();

        //ADD INCLUSIVE NAME
        $count = 0;
        foreach($request->get('inclusive_name') as $row){
            $inclusive_name = new inclusive_name();
            $inclusive_name->route_no = $route_no;
            $inclusive_name->user_id = $request->get('inclusive_name')[$count];
            $inclusive_name->status = 1;
            $inclusive_name->save();
            $count++;
        }

        //ADD CALENDAR
        $count = 0;
        foreach($request->get('inclusive') as $result)
        {
            $str = $result;
            $temp1 = explode('-',$str);
            $temp2 = array_slice($temp1, 0, 1);
            $tmp = implode(',', $temp2);
            $start_date = date('Y-m-d',strtotime($tmp));

            $temp3 = array_slice($temp1, 1, 1);
            $tmp = implode(',', $temp3);
            $enddate = date_create(date('Y-m-d',strtotime($tmp)));
            date_add($enddate, date_interval_create_from_date_string('1days'));
            $end_date = date_format($enddate, 'Y-m-d');

            $so = new Calendar();
            $so->route_no = $route_no;
            $so->title = $request->get('subject');
            $so->start = $start_date;
            $so->end = $end_date;
            $so->area = $request->get('area')[$count];
            $so->backgroundColor = 'rgb(216, 27, 96)';
            $so->borderColor = 'rgb(216, 27, 96)';
            $so->status = 0;
            $so->save();
            $count++;
        }
        //ADD TRACKING MASTER
        pdo::insert_tracking_master($route_no,$doc_type,$prepared_date,$prepared_by,$description);

        //ADD TRACKING DETAILS
        $date_in = $prepared_date;
        $received_by = $prepared_by;
        $delivered_by = $prepared_by;
        $action = $description;
        pdo::insert_tracking_details($route_no,$date_in,$received_by,$delivered_by,$action);

        //ADD SYSTEM LOGS
        $user_id = $prepared_by;
        $name = $request->user()->fname.' '.$request->user()->mname.' '.$request->user()->lname;
        $activity = 'Created';
        pdo::insert_system_logs($user_id,$name,$activity,$route_no);
        Session::put('added',true);

        return redirect('form/so_list');
    }

    public function so_update(Request $request){
        $route_no = Session::get('route_no');
        $doc_type = 'OFFICE_ORDER';
        $prepared_date = date('Y-m-d',strtotime($request->get('prepared_date'))).' '.date('H:i:s');
        $prepared_by =  pdo::user_search($request->user()->userid)['id'];
        $description = $request->get('subject');

        //update office order
        office_order::where('route_no',$route_no)
            ->update([
                'subject' => $request->get('subject'),
                'header_body' => $request->get('header_body'),
                'footer_body' => $request->get('footer_body'),
                'approved_by' => $request->get('approved_by'),
                'version' => 2
            ]);
        //

        //delete
        inclusive_name::where('route_no',$route_no)->delete();
        //
        //ADD INCLUSIVE NAME
        $count = 0;
        foreach($request->get('inclusive_name') as $row){
            $inclusive_name = new inclusive_name();
            $inclusive_name->route_no = $route_no;
            $inclusive_name->user_id = $request->get('inclusive_name')[$count];
            $inclusive_name->status = 1;
            $inclusive_name->save();
            $count++;
        }

        //delete
        Calendar::where('route_no',$route_no)->delete();
        //
        //ADD CALENDAR
        $count = 0;
        foreach($request->get('inclusive') as $result)
        {
            $str = $result;
            $temp1 = explode('-',$str);
            $temp2 = array_slice($temp1, 0, 1);
            $tmp = implode(',', $temp2);
            $start_date = date('Y-m-d',strtotime($tmp));

            $temp3 = array_slice($temp1, 1, 1);
            $tmp = implode(',', $temp3);
            $enddate = date_create(date('Y-m-d',strtotime($tmp)));
            date_add($enddate, date_interval_create_from_date_string('1days'));
            $end_date = date_format($enddate, 'Y-m-d');

            $so = new Calendar();
            $so->route_no = $route_no;
            $so->title = $request->get('subject');
            $so->start = $start_date;
            $so->end = $end_date;
            $so->area = $request->get('area')[$count];
            $so->backgroundColor = 'rgb(216, 27, 96)';
            $so->borderColor = 'rgb(216, 27, 96)';
            $so->status = 0;
            $so->save();
            $count++;
        }
        //UPDATE TRACKING MASTER
        pdo::update_tracking_master($prepared_date,$description,$route_no);
        //UPDATE TRACKING DETAILS
        pdo::update_tracking_details($description,$route_no);

        //ADD SYSTEM LOGS
        $user_id = $prepared_by;
        $name = $request->user()->fname.' '.$request->user()->mname.' '.$request->user()->lname;
        $activity = 'Updated';
        pdo::insert_system_logs($user_id,$name,$activity,$route_no);
        Session::put('updated',true);


        return redirect()->back();
    }

    public function so_updatev1(Request $request){
        $route_no = Session::get('route_no');
        $doc_type = 'OFFICE_ORDER';
        $prepared_date = date('Y-m-d',strtotime($request->get('prepared_date'))).' '.date('H:i:s');
        $prepared_by =  pdo::user_search($request->user()->userid)['id'];
        $description = $request->get('subject');

        //update office order
        office_order::where('route_no',$route_no)->update(['subject' => $request->get('subject')]);

        //delete
        inclusive_name::where('route_no',$route_no)->delete();
        //
        //ADD INCLUSIVE NAME
        $count = 0;
        foreach($request->get('inclusive_name') as $row){
            $inclusive_name = new inclusive_name();
            $inclusive_name->route_no = $route_no;
            $inclusive_name->user_id = $request->get('inclusive_name')[$count];
            $inclusive_name->status = 1;
            $inclusive_name->save();
            $count++;
        }

        //delete
        Calendar::where('route_no',$route_no)->delete();
        //
        //ADD CALENDAR
        $count = 0;
        foreach($request->get('inclusive') as $result)
        {
            $str = $result;
            $temp1 = explode('-',$str);
            $temp2 = array_slice($temp1, 0, 1);
            $tmp = implode(',', $temp2);
            $start_date = date('Y-m-d',strtotime($tmp));

            $temp3 = array_slice($temp1, 1, 1);
            $tmp = implode(',', $temp3);
            $enddate = date_create(date('Y-m-d',strtotime($tmp)));
            date_add($enddate, date_interval_create_from_date_string('1days'));
            $end_date = date_format($enddate, 'Y-m-d');

            $so = new Calendar();
            $so->route_no = $route_no;
            $so->title = $request->get('subject');
            $so->start = $start_date;
            $so->end = $end_date;
            $so->area = $request->get('area')[$count];
            $so->backgroundColor = 'rgb(216, 27, 96)';
            $so->borderColor = 'rgb(216, 27, 96)';
            $so->status = 0;
            $so->save();
            $count++;
        }

        //UPDATE TRACKING MASTER
        pdo::update_tracking_master($prepared_date,$description,$route_no);
        //UPDATE TRACKING DETAILS
        pdo::update_tracking_details($description,$route_no);

        //ADD SYSTEM LOGS
        $user_id = $prepared_by;
        $name = $request->user()->fname.' '.$request->user()->mname.' '.$request->user()->lname;
        $activity = 'Updated';
        pdo::insert_system_logs($user_id,$name,$activity,$route_no);
        Session::put('updated',true);

        return redirect()->back();
    }

    public static function check_calendar()
    {
        return inclusive_name::where('user_id',Auth::user()->userid)->get();
    }

    public function show($route_no,$doc_type=null){
        Session::put('route_no',$route_no);
        if($doc_type == 'office_order'){
            $users = pdo::users();
            $info = office_order::where('route_no',$route_no)->get()->first();
            $inclusive_date = Calendar::where('route_no',$route_no)->get();
            return view('document.info',['users'=>$users,'info'=>$info,'inclusive_date'=>$inclusive_date]);
        } else {
            $info = cdo::where('route_no',$route_no)->get()->first();
            return view('document.info',['info' => $info]);
        }
    }

    public function getTest()
    {
        $db_ext = DB::connection('dtsv3.0');
        $user = $db_ext->table('tracking_master')->get();
        return $user;
    }
}