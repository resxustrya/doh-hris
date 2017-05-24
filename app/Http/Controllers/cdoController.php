<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\cdo;
use Illuminate\Support\Facades\Session;
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
        $cdo = cdo::where('name',pdo::user_search($request->user()->userid)['id'])
                ->where(function($q) use ($keyword){
                    $q->where("route_no","like","%$keyword%");
                })
        ->orderBy('id','desc')
        ->paginate(10);

        return view('cdo.cdo_list',["cdo" => $cdo]);
    }

    public function cdov1(){
        return view("cdo.cdo_v1");
    }

    public function cdo_addv1(Request $request){
        $route_no = date('Y-') . pdo::user_search($request->user()->userid)['id'] . date('mdHis');
        $doc_type = "TIME_OFF";
        $date = date('Y-m-d',strtotime($request->get('date'))).' '.date('H:i:s');
        $name = pdo::user_search($request->user()->userid)['id'];

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
        $cdo->date = $date;
        $cdo->name = $name;
        $cdo->working_days = $working_days;
        $cdo->start = $start_date;
        $cdo->end = $end_date;
        $cdo->save();

        //ADD TRACKING MASTER
        pdo::insert_tracking_master($route_no,$doc_type,$date,$name,$subject);

        //ADD TRACKING DETAILS
        pdo::insert_tracking_details($route_no,$date,$name,$name,$subject);

        //ADD SYSTEM LOGS
        $user_id = $name;
        $name = $request->user()->fname.' '.$request->user()->mname.' '.$request->user()->lname;
        $activity = 'Created';
        pdo::insert_system_logs($user_id,$name,$activity,$route_no);

        Session::put('added',true);
        return redirect()->back();
    }

    public function cdo_updatev1(Request $request){
        $route_no = Session::get('route_no');
        $date = date('Y-m-d',strtotime($request->get('date'))).' '.date('H:i:s');
        $name = pdo::user_search($request->user()->userid)['id'];
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

        //UPDATE CDO
        cdo::where("route_no",$route_no)->update([
            "subject" => $subject,
            "date" => $date,
            "working_days" => $working_days,
            "start" => $start_date,
            "end" => $end_date
        ]);

        //UPDATE TRACKING MASTER
        pdo::update_tracking_master($date,$subject,$route_no);

        //UPDATE TRACKING DETAILS
        pdo::update_tracking_details($subject,$route_no);

        //ADD SYSTEM LOGS
        $user_id = $name;
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
        $cdo = cdo::where('name',pdo::user_search($request->user()->userid)['id'])
            ->where(function($q) use ($keyword){
                $q->where("route_no","like","%$keyword%");
            })
            ->orderBy('id','desc')
            ->paginate(10);

        return view('cdo.cdo_pending',["cdo" => $cdo]);
    }

    public function cdo_view(Request $request){
        return view('cdo.cdo_view');
    }
}
