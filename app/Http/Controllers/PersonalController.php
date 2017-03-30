<?php



/**
 * Created by PhpStorm.
 * User: Lourence
 * Date: 1/12/2017
 * Time: 10:03 AM
 */

namespace App\Http\Controllers;

use App\DtrDetails;
use App\pdf_filename;
use App\Work_sched;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use PDO;

ini_set('max_execution_time', 0);
ini_set('memory_limit','1000M');
ini_set('max_input_time','300000');
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
    public function edit_attendance(Request $request,$id = null)
    {

        if($request->isMethod('get')) {
            if(isset($id)) {
                Session::put('dtr_id',$id);
            }
            $dtr = DtrDetails::where('dtr_id', $id)->first();
            return view('employee.edit_attendance')->with('dtr',$dtr);
        }
        if($request->isMethod('post')) {
            if(Session::has('dtr_id')) {
                $dtr_id = Session::get('dtr_id');
                $dtr = DtrDetails::where('dtr_id', $dtr_id)->first();
                $dtr->time = $request->input('time');
                $time = explode(':', $request->input('time'));
                $dtr->time_h = array_key_exists(0, $time) == true ?trim($time[0], "\" ") : null;
                $dtr->time_m = array_key_exists(1, $time) == true ?trim($time[1], "\" ") : null;
                $dtr->time_s = array_key_exists(2, $time) == true ? trim($time[2], "\" ") : null;
                $dtr->event = $request->input('event');
                $dtr->terminal = $request->input('terminal');
                $dtr->remark = $request->input('remarks');
                $dtr->save();
                Session::forget('dtr_id');
                return redirect('personal/index');
            }
        }
    }
    public function emp_filtered(Request $request)
    {
        $row = null;
        if($request->has('filter_range')){
            $str = $request->input('filter_range');
            $temp1 = explode('-',$str);
            $temp2 = array_slice($temp1, 0, 1);
            $tmp = implode(',', $temp2);
            $date_from = date('Y-m-d',strtotime($tmp));

            $temp3 = array_slice($temp1, 1, 1);
            $tmp = implode(',', $temp3);
            $date_to = date('Y-m-d',strtotime($tmp));

            $id = Auth::user()->userid;
            $pdo = DB::connection()->getPdo();

            $query = "SELECT * FROM work_sched WHERE id = '1'";
            $st = $pdo->prepare($query);
            $st->execute();
            $sched = $st->fetchAll(PDO::FETCH_ASSOC);

            $am_in = explode(':',$sched[0]['am_in']);
            $am_out =  explode(':',$sched[0]['am_out']);
            $pm_in =  explode(':',$sched[0]['pm_in']);
            $pm_out = explode(':',$sched[0]['pm_out']);

            $query = "SELECT DISTINCT e.userid, datein,

                    (SELECT MIN(t1.time) FROM dtr_file t1 WHERE t1.userid = '". $id."' and datein = d.datein and t1.time_h < ". $am_out[0] .") as am_in,
                    (SELECT MAX(t2.time) FROM dtr_file t2 WHERE t2.userid = '". $id."' and datein = d.datein and t2.time_h < ". $pm_in[0]." AND t2.event = 'OUT') as am_out,
                    (SELECT MIN(t3.time) FROM dtr_file t3 WHERE t3.userid = '". $id."' AND datein = d.datein and t3.time_h >= ". $am_out[0]." and t3.time_h < ". $pm_out[0]." AND t3.event = 'IN' ) as pm_in,
                    (SELECT MAX(t4.time) FROM dtr_file t4 WHERE t4.userid = '". $id."' AND datein = d.datein and t4.time_h > ". $pm_in[0] ." and t4. time_h < 24) as pm_out

                    FROM dtr_file d LEFT JOIN users e
                        ON d.userid = e.userid
                    WHERE d.datein BETWEEN '". $date_from. "' AND '" . $date_to . "'
                          AND e.userid = '". $id."'
                    ORDER BY datein ASC";
            try
            {
                $st = $pdo->prepare($query);
                $st->execute();
                $row = $st->fetchAll(PDO::FETCH_ASSOC);
                if(isset($row) and count($row) > 0)
                {
                    return view('dtr.filtered')->with('lists',$row)->with('date_from',$date_from)->with('date_to',$date_to);
                }
            }catch(PDOException $ex){
                echo $ex->getMessage();
                exit();
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

    public function personal_filter_dtrlist(Request $request)
    {

        $lists = pdf_filename::where('is_filtered','1')
                            ->where('empid', Auth::user()->userid)
                            ->orderBy('date_created','ASC')
                            ->paginate(20);
        return view('dtr.personal_filter_list')->with('lists',$lists);
    }
    public function save_filtered(Request $request)
    {

        $pdf = new pdf_filename();
        $pdf->date_from = $request->input('date_from');
        $pdf->date_to = $request->input('date_to');
        $pdf->type = Auth::user()->emptype;
        $pdf->empid = Auth::user()->userid;
        $pdf->is_filtered = "1";
        $pdf->date_created =   date("Y-m-d");
        $pdf->time_created = date("h:i:sa");

        $pdf->save();

        return redirect('personal/dtr/filter/list');
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