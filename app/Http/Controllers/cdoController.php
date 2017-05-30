<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\cdo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\pdoController as pdo;

class cdoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function cdo_list(Request $request){
        Session::put('keyword',$request->keyword);
        $keyword = Session::get('keyword');

        if($request->user()->usertype){
            $cdo = cdo::where(function($q) use ($keyword){
                $q->where("route_no","like","%$keyword%")
                ->orWhere("subject","like","%$keyword%");
            })
            ->orderBy('id','desc')
            ->paginate(10);
            $type = "pending";
        } else {
            $cdo = cdo::where('prepared_name',pdo::user_search($request->user()->userid)['id'])
                ->where(function($q) use ($keyword){
                $q->where("route_no","like","%$keyword%")
                ->orWhere("subject","like","%$keyword%");
            })
            ->orderBy('id','desc')
            ->paginate(10);
            $type = "list";
        }

        return view('cdo.cdo_list',["cdo" => $cdo,"type" => $type]);
    }

    public function cdov1($pdf = null){
        $cdo = cdo::where('route_no',Session::get('route_no'))->first();
        if($pdf == 'pdf')
            $name = pdo::user_search1($cdo->prepared_name);
        else
            $name = pdo::user_search(Auth::user()->userid);

        $position = pdo::designation_search($name['designation'])['description'];
        $section = pdo::search_section($name['section'])['description'];
        $division = pdo::search_division($name['division'])['description'];
        foreach(pdo::section() as $row){
            $section_head[] = pdo::user_search1($row['head']);
        }
        foreach(pdo::division() as $row){
            $division_head[] = pdo::user_search1($row['head']);
        }
        $data = array(
            "cdo" => $cdo,
            "type" => "add",
            "asset" => asset('cdo_addv1'),
            "name" => $name['fname'].' '.$name['mname'].' '.$name['lname'],
            "position" => $position,
            "section" => $section,
            "division" => $division,
            "section_head" => $section_head,
            "division_head" => $division_head
        );
        if($pdf == 'pdf') {
            $display = view('cdo.cdo_pdf', ["data" => $data]);
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($display)->setPaper('a4', 'portrait');
            return $pdf->stream();
        }
        else
            return view("cdo.cdo_view",["data" => $data]);
    }

    public function cdo_addv1(Request $request){
        $route_no = date('Y-') . pdo::user_search($request->user()->userid)['id'] . date('mdHis');
        $doc_type = "TIME_OFF";
        $prepared_date = date('Y-m-d',strtotime($request->input('prepared_date'))).' '.date('H:i:s');
        $prepared_name = pdo::user_search($request->user()->userid)['id'];

        $str = $request->input('inclusive_dates');
        $temp1 = explode('-',$str);
        $temp2 = array_slice($temp1, 0, 1);
        $tmp = implode(',', $temp2);
        $start_date = date('Y-m-d',strtotime($tmp));

        $temp3 = array_slice($temp1, 1, 1);
        $tmp = implode(',', $temp3);
        $enddate = date_create(date('Y-m-d',strtotime($tmp)));
        date_add($enddate, date_interval_create_from_date_string('1days'));
        $end_date = date_format($enddate, 'Y-m-d');
        $subject = $request->input('subject');
        $working_days = floor(strtotime($end_date) / (60 * 60 * 24)) - floor(strtotime($start_date) / (60 * 60 * 24)) - 1;

        //ADD CDO
        $cdo = new cdo();
        $cdo->route_no = $route_no;
        $cdo->subject = $subject;
        $cdo->doc_type = $doc_type;
        $cdo->prepared_date = $prepared_date;
        $cdo->prepared_name = $prepared_name;
        $cdo->working_days = $working_days;
        $cdo->start = $start_date;
        $cdo->end = $end_date;
        $cdo->immediate_supervisor = $request->input('immediate_supervisor');
        $cdo->division_chief = $request->input('division_chief');
        $cdo->save();

        //ADD TRACKING MASTER
        pdo::insert_tracking_master($route_no,$doc_type,$prepared_date,$prepared_name,$subject);

        //ADD TRACKING DETAILS
        pdo::insert_tracking_details($route_no,$prepared_date,$prepared_name,$prepared_name,$subject);

        //ADD SYSTEM LOGS
        $user_id = $prepared_name;
        $name = $request->user()->fname.' '.$request->user()->mname.' '.$request->user()->lname;
        $activity = 'Created';
        pdo::insert_system_logs($user_id,$name,$activity,$route_no);

        Session::put('added',true);
        return redirect()->back();
    }

    public function cdo_updatev1(Request $request){
        $route_no = Session::get('route_no');
        $prepared_date = date('Y-m-d',strtotime($request->input('prepared_date'))).' '.date('H:i:s');
        $info = cdo::where('route_no',$route_no)->first();

        $str = $request->input('inclusive_dates');
        $temp1 = explode('-',$str);
        $temp2 = array_slice($temp1, 0, 1);
        $tmp = implode(',', $temp2);
        $start_date = date('Y-m-d',strtotime($tmp));

        $temp3 = array_slice($temp1, 1, 1);
        $tmp = implode(',', $temp3);
        $enddate = date_create(date('Y-m-d',strtotime($tmp)));
        date_add($enddate, date_interval_create_from_date_string('1days'));
        $end_date = date_format($enddate, 'Y-m-d');
        $subject = $request->input('subject');
        $working_days = floor(strtotime($end_date) / (60 * 60 * 24)) - floor(strtotime($start_date) / (60 * 60 * 24)) - 1;

        if($request->user()->usertype){
            $beginning_balance = $request->input('beginning_balance');
            $less_applied = $request->input('less_applied');
            $remaining_balance = $request->input('remaining_balance');
        } else{
            $beginning_balance = $info->beginning_balance;
        }
        if($request->user()->usertype and $request->input('approval'))
            $approved_status = 1;
        else
            $approved_status = 0;


        //UPDATE CDO
        cdo::where("route_no",$route_no)->update([
            "subject" => $subject,
            "prepared_date" => $prepared_date,
            "working_days" => $working_days,
            "start" => $start_date,
            "end" => $end_date,
            "immediate_supervisor" => $request->input('immediate_supervisor'),
            "division_chief" => $request->input('division_chief'),
            "approved_status" => $approved_status
        ]);

        //UPDATE TRACKING MASTER
        pdo::update_tracking_master($prepared_date,$subject,$route_no);

        //UPDATE TRACKING DETAILS
        pdo::update_tracking_details($subject,$route_no);

        //ADD SYSTEM LOGS
        $user_id = $info->prepared_name;
        $name = $request->user()->fname.' '.$request->user()->mname.' '.$request->user()->lname;
        $activity = 'Updated';
        pdo::insert_system_logs($user_id,$name,$activity,$route_no);

        Session::put('updated',true);
        return redirect()->back();
    }

    public function cdo_delete(Request $request){
        $name = pdo::user_search($request->user()->userid)['id'];
        $route_no = Session::get('route_no');
        cdo::where('route_no',$route_no)->delete();

        pdo::delete_tracking_master($route_no);
        pdo::delete_tracking_details($route_no);

        //ADD SYSTEM LOGS
        $user_id = $name;
        $name = $request->user()->fname.' '.$request->user()->mname.' '.$request->user()->lname;
        $activity = 'Deleted';
        pdo::insert_system_logs($user_id,$name,$activity,$route_no);

        Session::put('deleted',true);
        return redirect()->back();
    }

    public function cdo_pending(Request $request){
        Session::put('keyword',$request->keyword);
        $keyword = Session::get('keyword');
        $cdo = cdo::where('prepared_name',pdo::user_search($request->user()->userid)['id'])
            ->where(function($q) use ($keyword){
                $q->where("route_no","like","%$keyword%");
            })
            ->orderBy('id','desc')
            ->paginate(10);

        return view('cdo.cdo_pending',["cdo" => $cdo]);
    }
}
