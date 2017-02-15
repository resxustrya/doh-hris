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
            ->where('userid', $request->user()->userid)
            ->orderBy('created_at', 'DESC')
            ->paginate(20);
        return view('home')->with('lists',$lists);
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

        $pdo = DB::connection()->getPdo();
        $query = "SELECT DISTINCT datein,date_d,DATE_FORMAT(datein,'%M %d, %Y') AS 'date' FROM dtr_file WHERE userid = '" . $request->user()->userid . "' and datein BETWEEN '" . $f_from . "' AND '" . $f_to . "' ORDER BY datein ASC";

        $st = $pdo->prepare($query);
        $st->execute();
        $lists = $st->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;
        if(isset($lists) and count($lists) > 0){
            return view('print.personal')->with('lists',$lists);
        } else {
            return redirect('personal/print/monthly');
        }
    }

    public static function day_name($datein)
    {

        return date('D', strtotime($datein));
    }
    public static function get_time($datein,$event)
    {
        $order = "";
        if($event == 'IN')
            $order = 'ASC';
        if($event == 'OUT')
            $order = 'DESC';

        $id = Auth::user()->userid;
        $time = DtrDetails::where('datein',$datein)
                            ->where('userid',$id)
                            ->where('event', $event)
                            ->orderBy('time', $order)
                            ->pluck('time')
                            ->first();
        return $time;
    }
}