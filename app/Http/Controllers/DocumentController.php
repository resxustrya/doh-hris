<?php
/**
 * Created by PhpStorm.
 * User: Lourence
 * Date: 1/23/2017
 * Time: 9:41 AM
 */

namespace App\Http\Controllers;
use App\Leave;
use App\Users;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Calendar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PDO;
use App\inclusive_name;
use App\office_order;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $id = $user->id;
        $keyword = Session::get('keyword');

        $data['documents'] = Tracking::where('prepared_by',$id)
            ->where(function($q) use ($keyword){
                $q->where('route_no','like',"%$keyword%")
                    ->orwhere('description','like',"%$keyword%");
            })
            ->orderBy('id','desc')
            ->paginate(15);
        $data['access'] = $this->middleware('access');
        return view('document.list',$data);

    }

    public function search(Request $request){
        Session::put('keyword',$request->keyword);
        return self::index();
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
    //PDO
    public function connect()
    {
        return new PDO("mysql:host=localhost;dbname=dtsv3.0",'root','');
    }
    public function users()
    {
        $db=$this->connect();
        $sql="SELECT * FROM USERS ORDER BY FNAME ASC";
        $pdo = $db->prepare($sql);
        $pdo->execute();
        $row = $pdo->fetchAll();
        $db = null;

        return $row;
    }
    public function division()
    {
        $db=$this->connect();
        $sql="SELECT * FROM DIVISION";
        $pdo = $db->prepare($sql);
        $pdo->execute();
        $row = $pdo->fetchAll();
        $db = null;

        return $row;
    }
    public function division_head($head)
    {
        $db=$this->connect();
        $sql="SELECT * FROM DIVISION where head = ?";
        $pdo = $db->prepare($sql);
        $pdo->execute(array($head));
        $row = $pdo->fetch();
        $db = null;

        return $row;
    }

    public function insert_tracking_master($route_no,$doc_type,$prepared_date,$prepared_by,$description)
    {
        $db=$this->connect();
        $sql="INSERT INTO TRACKING_MASTER(route_no,doc_type,prepared_date,prepared_by,description) values(?,?,?,?,?)";
        $pdo = $db->prepare($sql);
        $pdo->execute(array($route_no,$doc_type,$prepared_date,$prepared_by,$description));
        $db=null;
    }

    public function insert_tracking_details($route_no,$date_in,$received_by,$delivered_by,$action)
    {
        $db=$this->connect();
        $sql="INSERT INTO TRACKING_DETAILS(route_no,date_in,received_by,delivered_by,action) values(?,?,?,?,?)";
        $pdo = $db->prepare($sql);
        $pdo->execute(array($route_no,$date_in,$received_by,$delivered_by,$action));
        $db=null;
    }

    public function insert_system_logs($user_id,$name,$activity)
    {
        $db=$this->connect();
        $sql="INSERT INTO SYSTEMLOGS(user_id,name,activity) values(?,?,?)";
        $pdo = $db->prepare($sql);
        $pdo->execute(array($user_id,$name,$activity));
        $db=null;
    }

    //OFFICE ORDER
    public function so(Request $request)
    {
        Session::put('my_id',$request->user()->id);
        if($request->isMethod('get')){
            $users = $this->users();
            return view('form.office_order',['users'=>$users]);
        }
        if($request->isMethod('post')){
            return $request->all();
        }
    }
    public function so_view(Request $request)
    {
        Session::put('my_id',$request->user()->id);
        if($request->isMethod('get')){
            $users = $this->users();
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
        $users = $this->users();
        $office_order = office_order::where('route_no',Session::get('route_no'))->get()->first();
        $inclusive_date = Calendar::where('route_no',Session::get('route_no'))->get();
        $display = view('form.office_order_view',['users'=>$users,'office_order'=>$office_order,'inclusive_date'=>$inclusive_date]);

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($display)->setPaper('a4','portrait');

        return $pdf->stream();
    }
    public function inclusive_name(){
        $inclusive_name = inclusive_name::where('route_no',Session::get('route_no'))->get();
        foreach($inclusive_name as $row){
            $name[] = $row['user_id'];
        }
        return $name;
    }
    public function so_list(){
        $office_order = office_order::orderBy('id','desc')->paginate(10);
        return view('form.office_order_list',['office_order' => $office_order]);
    }
    public function so_append(){
        return view('form.office_order_append');
    }
    public function so_add(Request $request){
        $route_no = date('Y-') . $request->user()->id . date('mdHis');
        $doc_type = 'OFFICE_ORDER';
        $prepared_date = $request->get('prepared_date');
        $prepared_by =  $request->user()->id;
        $description = $request->get('subject');

        //ADD OFFICE ORDER
        $office_order = new office_order();
        $office_order->route_no = $route_no;
        $office_order->subject = $request->get('subject');
        $office_order->header_body = $request->get('header_body');
        $office_order->footer_body = $request->get('footer_body');
        $office_order->approved_by = $request->get('approved_by');
        $office_order->save();

        //ADD INCLUSIVE NAME
        foreach($request->get('inclusive_name') as $row){
            $inclusive_name = new inclusive_name();
            $inclusive_name->route_no = $route_no;
            $inclusive_name->user_id = $row;
            $inclusive_name->status = 0;
            $inclusive_name->save();
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
            $so->backgroundColor = 'rgb(216, 27, 96)';
            $so->borderColor = 'rgb(216, 27, 96)';
            $so->status = 0;
            $so->save();
            $count++;
        }
        //ADD TRACKING MASTER
        $this->insert_tracking_master($route_no,$doc_type,$prepared_date,$prepared_by,$description);

        //ADD TRACKING DETAILS
        $date_in = $prepared_date;
        $received_by = $prepared_by;
        $delivered_by = $prepared_by;
        $action = $description;
        $this->insert_tracking_details($route_no,$date_in,$received_by,$delivered_by,$action);

        //ADD SYSTEM LOGS
        $user_id = $prepared_by;
        $name = $request->user()->fname.' '.$request->user()->mname.' '.$request->user()->lname;
        $activity = 'CREATED';
        $this->insert_system_logs($user_id,$name,$activity);
        Session::put('added',true);

        return redirect('form/so_list');
    }

    public static function check_calendar()
    {
        return inclusive_name::where('user_id',Auth::user()->userid)->get();
    }

    public function show($route_no){
        $info = office_order::where('route_no',$route_no)->first();

        Session::put('route_no', $route_no);
        return view('document.info',['info' => $info]);
    }

    public function getTest()
    {
        /*$test = new Test();
        $test->setConnection('mysql1');
        $connection = $test->find('users');

        return $connection;*/

        /*$db_ext = DB::connection('mysql1');
        $user = $db_ext->table('tracking_master')->get();
        return $user;*/
        return $inclusive_date = Calendar::where('route_no',Session::get('route_no'))->get();
    }
}