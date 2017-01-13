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
use Illuminate\Support\Facades\Session;
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
        Session::put('f_from',$f_from);
        Session::put('f_to',$f_to);
        if(count($_from) > 0 and count($_to) > 0){
            $lists = DtrDetails::where('userid', $request->user()->userid)
                                ->where('datein','>=', $f_from)
                                ->where('datein','<=', $f_to)
                                ->orderBy('datein', 'ASC')
                                ->paginate(61);
            if(isset($lists) and count($lists) > 0) {
                Session::put('filter_list', $lists);
                return redirect('personal/print/monthly');
            } else {
                return redirect('personal/print/monthly');
            }
        } else {
            return redirect('personal/print/monthly');
        }
    }

    public static function day_name($day,$list)
    {
        $date = $list->date_y.'-'.$list->date_m.'-'.$day;
        return date('D', strtotime($date));
    }
}