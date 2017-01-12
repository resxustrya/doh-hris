<?php
/**
 * Created by PhpStorm.
 * User: Lourence
 * Date: 1/6/2017
 * Time: 9:46 AM
 */

namespace App\Http\Controllers;


use App\DtrDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class PrintController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home(Request $request){
        return view('print.monthly');
    }

    public function print_monthly(Request $request)
    {
        if($request->isMethod('post')){
           if($request->has('filter')) {
               if($request->has('from') and $request->has('to')) {
                   $_from = explode('/', $request->input('from'));
                   $_to = explode('/', $request->input('to'));
                   $f_from = $_from[2].'-'.$_from[0].'-'.$_from[1];
                   $f_to = $_to[2].'-'.$_to[0].'-'.$_to[1];
                   Session::put('f_from',$f_from);
                   Session::put('f_to',$f_to);

                   $lists = DtrDetails::where('datein', '>=', $f_from)
                       ->where('datein', '<=', $f_to)
                       ->where('firstname', '<>', null)
                       ->where('lastname', '<>' ,null)
                       ->where('userid', '<>', null)
                       ->orderBy('datein', 'ASC')
                       ->paginate(20);
                   if(isset($lists) and count($lists) > 0) {
                       Session::put('lists',$lists);
                       return redirect('print');
                   }
               }
           }
            if(Session::has('f_from') and Session::has('f_to')){

                $f_from = Session::get('f_from');
                $f_to = Session::get('f_to');
                $lists = DtrDetails::where('datein', '>=', $f_from)
                    ->where('datein', '<=', $f_to)
                    ->where('firstname', '<>', null)
                    ->where('lastname', '<>' ,null)
                    ->where('userid', '<>', null)
                    ->orderBy('datein', 'ASC')
                    ->paginate(20);
                if(isset($lists) and count($lists) > 0) {
                    Session::put('lists', $lists);
                    return redirect('print');
                }
            }
        }
    }
    public function print_employee(Request $request) {
        if($request->isMethod('get')){
            return view('print.employee');
        }
    }
}