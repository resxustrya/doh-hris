<?php
/**
 * Created by PhpStorm.
 * User: Lourence
 * Date: 1/12/2017
 * Time: 10:03 AM
 */

namespace App\Http\Controllers;

use App\DtrDetails;
use App\Work_sched;
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

    public function emp_filtered(Request $request)
    {
        return $request->all();
        if($request->has('filter_range')){
            $str = $request->input('filter_range');
            $temp1 = explode('-',$str);
            $temp2 = array_slice($temp1, 0, 1);
            $tmp = implode(',', $temp2);
            $date_from = date('Y-m-d',strtotime($tmp));

            $temp3 = array_slice($temp1, 1, 1);
            $tmp = implode(',', $temp3);
            $date_to = date('Y-m-d',strtotime($tmp));

            Session::put('from',$date_from);
            Session::put('to', $date_to);

            if(Session::has('from') and Session::has('to')) {

                $f_from = Session::get('from');
                $f_to = Session::get('to');
                $lists = DtrDetails::where('userid', $request->user()->userid)
                    ->where('datein', '>=', $f_from)
                    ->where('datein', '<=', $f_to)
                    ->orderBy('datein', 'ASC')
                    ->paginate(10);

                if(isset($lists) and count($lists) > 0)
                {

                    return view('employee.index')->with('lists',$lists);
                }

            }
        }


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
        $lists = null;

        $str = $request->get('date_range');
        $temp1 = explode('-',$str);
        $temp2 = array_slice($temp1, 0, 1);
        $tmp = implode(',', $temp2);
        $start_date = date('Y-m-d',strtotime($tmp));

        $temp3 = array_slice($temp1, 1, 1);
        $tmp = implode(',', $temp3);
        $end_date = date('Y-m-d',strtotime($tmp));

        /*$_from = explode('/', $start_date);
        $_to = explode('/', $end_date);
        $f_from = $_from[2].'-'.$_from[0].'-'.$_from[1];
        $f_to = $_to[2].'-'.$_to[0].'-'.$_to[1];*/

        $id = Auth::user()->userid;
        $pdo = DB::connection()->getPdo();

        $query = "SELECT DISTINCT e.userid, datein,

                    (SELECT MIN(t1.time) FROM dtr_file t1 WHERE t1.userid = '". $id."' and datein = d.datein and t1.time_h < 12) as am_in,
                    (SELECT MAX(t2.time) FROM dtr_file t2 WHERE t2.userid = '". $id."' and datein = d.datein and t2.time_h < 13 AND t2.event = 'OUT') as am_out,
                    (SELECT MIN(t3.time) FROM dtr_file t3 WHERE t3.userid = '". $id."' AND datein = d.datein and t3.time_h >= 12 and t3.time_h < 17 AND t3.event = 'IN' ) as pm_in,
                    (SELECT MAX(t4.time) FROM dtr_file t4 WHERE t4.userid = '". $id."' AND datein = d.datein and t4.time_h > 13 and t4. time_h < 24) as pm_out

                    FROM dtr_file d LEFT JOIN users e
                        ON d.userid = e.userid
                    WHERE d.datein BETWEEN '". $start_date. "' AND '" . $end_date . "'
                          AND e.userid = '". $id."'
                    ORDER BY datein ASC";


        $st = $pdo->prepare($query);
        $st->execute();
        $lists = $st->fetchAll(PDO::FETCH_ASSOC);

        if(isset($lists) and count($lists) > 0) {
            return view('print.personal')->with('lists',$lists)->with('start_date',$start_date)->with('end_date',$end_date);
        } else {
            return redirect('personal/print/monthly');
        }
    }

    public static function day_name($datein)
    {

        return date('D', strtotime($datein));
    }
    public static function get_time($datein)
    {
        $work_sched = Work_sched::where('id',1)->first();

        $am_in = explode(':',$work_sched->am_in);
        $am_out =  explode(':',$work_sched->am_out);
        $pm_in =  explode(':',$work_sched->pm_in);
        $pm_out = explode(':',$work_sched->pm_out);
        $id = Auth::user()->userid;
        $pdo = DB::connection()->getPdo();
        $query = "";

        $query = "SELECT DISTINCT e.userid, datein,

                    (SELECT MIN(t1.time) FROM dtr_file t1 WHERE t1.userid = '". $id."' and datein = d.datein and t1.time_h < 12) as am_in,
                    (SELECT MAX(t2.time) FROM dtr_file t2 WHERE t2.userid = '". $id."' and datein = d.datein and t2.time_h < 13 AND t2.event = 'OUT') as am_out,
                    (SELECT MIN(t3.time) FROM dtr_file t3 WHERE t3.userid = '". $id."' AND datein = d.datein and t3.time_h >= 12 and t3.time_h < 17 AND t3.event = 'IN' ) as pm_in,
                    (SELECT MAX(t4.time) FROM dtr_file t4 WHERE t4.userid = '". $id."' AND datein = d.datein and t4.time_h > 13 and t4. time_h < 24) as pm_out

                    FROM dtr_file d LEFT JOIN users e
                        ON d.userid = e.userid
                    WHERE d.datein BETWEEN '2017-01-01' AND '2017-01-31'
                          AND e.userid = '0476'
                    ORDER BY datein ASC";

        $st = $pdo->prepare($query);
        $st->execute();
        $row = $st->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }

    public static function late($am_in, $pm_in)
    {
        $total_late = 0.0;

        $h_am_late = 0.0;
        $h_pm_late = 0.0;

        $m_am_late = 0.0;
        $m_pm_late = 0.0;

        $work_sched = Work_sched::where('id',1)->first();
        $s_am_in = explode(':',$work_sched->am_in);
        $s_am_out =  explode(':',$work_sched->am_out);
        $s_pm_in =  explode(':',$work_sched->pm_in);
        $s_pm_out = explode(':',$work_sched->pm_out);


        if(isset($am_in) ) {
            $am_in = explode(':',$am_in);
            if(floor($am_in[0]) < floor($s_am_in[0])) {
                $h_am_late = 0;
                $m_am_late = 0;
            } else {
                $h_am_late = floor($am_in[0]) - floor($s_am_in[0]);
                if($h_am_late <= 0) {
                    $h_am_late = 0;
                }
                if($am_in[0] < $s_am_in[0]) {
                    $m_am_late = 0;
                } else {
                    $m_am_late = floor($am_in[1]) - floor($s_am_in[1]);
                    if($m_am_late <= 0) {
                        $m_am_late = 0;
                    }
                }
            }
        }
        if(isset($pm_in)) {
            $pm_in = explode(':', $pm_in);
            if(floor($pm_in[0]) < floor($s_pm_in[1])) {
                $h_pm_late = 0;
                $m_pm_late = 0;
            } else {
                $h_pm_late = floor($pm_in[0]) - floor($s_pm_in[0]);
                if($h_pm_late <= 0) {
                    $h_pm_late = 0;
                }
                if($pm_in[0] < $s_pm_in[0]) {
                    $m_pm_late = 0;
                } else {
                    $m_pm_late = floor($pm_in[1]) - floor($s_pm_in[1]);
                    if($m_pm_late <= 0) {
                        $m_pm_late = 0;
                    }
                }
            }
        }

        if(isset($h_am_late) and isset($h_pm_late)) {
            $total = $h_am_late + $h_pm_late;

            if($total <= 0) {
                $total_late .= '0';
            } else {
                $total_late .= $total;
            }
        }

        if(isset($m_am_late) and isset($m_pm_late)) {
            $total = $m_am_late + $m_pm_late;
            if($total <= 0) {
                $total_late .= ":" . '0';
            } else {
                $total_late .= ":" .$total;
            }
        }
        return $total_late;
    }


    public static function undertime($am_out,$pm_out)
    {
        $work_sched = Work_sched::where('id',1)->first();
        $s_am_in = explode(':',$work_sched->am_in);
        $s_am_out =  explode(':',$work_sched->am_out);
        $s_pm_in =  explode(':',$work_sched->pm_in);
        $s_pm_out = explode(':',$work_sched->pm_out);

        $total_ut = 0.0;

        $h_am_ut = 0.0;
        $h_pm_ut = 0.0;

        $m_am_ut = 0.0;
        $m_pm_ut = 0.0;


        if(isset($am_out) and $am_out != '' ) {
            $am_out = explode(':', $am_out);
            if(floor($am_out[0]) > floor($s_am_out[0])) {
                $h_am_ut = 0;
                $m_am_ut = 0;
            } else {
                $h_am_ut = floor($s_am_out[0]) - floor($am_out[0]);
                if($h_am_ut < 0) {
                    $h_am_ut = 0;
                }
                if($am_out[0] > $s_am_out[0]) {
                    $m_am_ut = 0;
                } else {
                    $m_am_ut = floor($s_am_out[1]) - floor($am_out[1]);
                    if($m_am_ut <= 0) {
                        $m_am_ut = 0;
                    }
                }
            }
        }
        if(isset($pm_out) and $pm_out != '') {
            $pm_out = explode(':' ,$pm_out);
            if(floor($pm_out[0]) > floor($s_pm_out[0])) {
                $h_pm_ut = 0;
                $m_pm_ut = 0;
            } else {
                $h_pm_ut = floor($s_pm_out[0]) - floor($pm_out[0]);
                if($h_pm_ut < 0) {
                    $h_pm_ut = 0;
                }
                if($pm_out[0] > $s_pm_out[0]) {
                    $m_pm_ut = floor($s_pm_out[1]) - floor($pm_out[1]);
                    if($m_pm_ut <= 0) {
                        $m_pm_ut = 0;
                    }
                }
            }
        }

        if(isset($h_am_ut) and isset($h_pm_ut)) {
            $total = $h_am_ut + $h_pm_ut;
            if($total <= 0) {
                $total_ut .= '0';
            } else {
                $total_ut .= $total;
            }
        }
        if(isset($m_am_ut) and isset($m_pm_ut)) {
            $total = $m_am_ut + $m_pm_ut;
            if($total <= 0) {
                $total_ut.= ":" .'0';
            } else {
                $total_ut .= ":". $total;
            }
        }

        return $total_ut;
    }

    public function rdr_home()
    {
        require('FPDF/dtr.php');
    }
}