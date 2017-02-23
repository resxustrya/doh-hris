<?php
/**
 * Created by PhpStorm.
 * User: Lourence
 * Date: 1/12/2017
 * Time: 10:03 AM
 */

namespace App\Http\Controllers;
use App\DtrDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use PDO;
class PersonalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $listQuery = DtrDetails::query();
        $lists = $listQuery
            ->where('firstname', '<>', NULL)
            ->where('lastname', '<>', NULL)
            ->where('userid', '<>', NULL)
            ->where('department', '<>', '--')
            ->where('userid', $request->user()->userid)
            ->orderBy('created_at', 'DESC')
            ->paginate(20);
        return view('employee.index')->with('lists',$lists);
    }

    public  function search_filter(Request $request)
    {
        if($request->has('from') and $request->has('to')){

            $_from = explode('/', $request->input('from'));
            $_to = explode('/', $request->input('to'));
            $f_from = $_from[2].'-'.$_from[0].'-'.$_from[1];
            $f_to = $_to[2].'-'.$_to[0].'-'.$_to[1];
            Session::put('from',$f_from);
            Session::put('to', $f_to);
        }

        if(Session::has('from') and Session::has('to')) {

            $f_from = Session::get('from');
            $f_to = Session::get('to');
            $lists = DtrDetails::where('userid', $request->user()->userid)
                ->where('datein', '>=', $f_from)
                ->where('datein', '<=', $f_to)
                ->orderBy('datein', 'ASC')
                ->paginate(10);

            return view('employee.index')->with('lists',$lists);
        }
    }
    public function print_monthly(Request $request)
    {
        return view('print.personal');
    }
    public function filter(Request $request)
    {
        if($request->input('from') == "" and $request->input('to') == "") {
            return redirect('personal/print/monthly');
        }
        $lists = null;
        $_from = explode('/', $request->input('from'));
        $_to = explode('/', $request->input('to'));
        $f_from = $_from[2].'-'.$_from[0].'-'.$_from[1];
        $f_to = $_to[2].'-'.$_to[0].'-'.$_to[1];

        if(count($_from) > 0 and count($_to) > 0){
            $lists = DtrDetails::where('userid', $request->user()->userid)
                                ->where('datein','>=', $f_from)
                                ->where('datein','<=', $f_to)
                                ->orderBy('datein', 'ASC')
                                ->get();
            return view('print.personal')->with('lists',$lists);
        } else {
            return redirect('personal/print/monthly');
        }
    }


    public static function day_name($day,$list)
    {
        $date = $list->date_y.'-'.$list->date_m.'-'.$day;
        return date('D', strtotime($date));
    }
    public static function get_time($datein,$event,$b)
    {
        $id = Auth::user()->userid;
        $pdo = DB::connection()->getPdo();
        $query = "";
        if($event == 'IN' and $b == 'AM') {
            $query = "SELECT min(time) as 'time' from dtr_file WHERE userid = '" . $id . "' and datein = '" .$datein ."' and time_h < 12 and event = 'IN'";
        }
        if($event == 'OUT' and $b == 'AM') {
            $query = "SELECT max(time) as 'time' from dtr_file WHERE userid = '" . $id ."' and datein = '" . $datein ."' and time_h = 12 and time_m <=59 and time_s <= 59 and event = 'OUT'";
        }
        if($event == 'IN' and $b == 'PM') {
            $query = "SELECT min(time) as 'time' from dtr_file WHERE userid = '". $id ."' and datein = '" . $datein ."' and time_h = 12 and time_m <=59 and time_s <= 59 and event = 'IN'";
        }
        if($event == 'OUT' and $b == 'PM') {
            $query = "SELECT max(time) as 'time' from dtr_file WHERE userid = '" .$id ."' and datein ='" . $datein . "' and time_h >12  and event = 'OUT'";
        }

        $st = $pdo->prepare($query);
        $st->execute();
        $row = $st->fetchAll(PDO::FETCH_ASSOC);
        return $row[0]['time'];
    }
    public static function late($am_in)
    {

    }
}