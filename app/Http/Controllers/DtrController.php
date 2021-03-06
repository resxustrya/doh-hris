<?php
/**
 * Created by PhpStorm.
 * User: Lourence
 * Date: 12/2/2016
 * Time: 11:37 AM
 */
namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use App\User;
use Illuminate\Http\Request;
use App\DtrDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
class DtrController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function upload(Request $request)
    {

        //GET Request
        if($request->isMethod('get')){
            return view('dtr.upload');
        }
        //POST Request
        if($request->isMethod('post')){

            if($request->hasFile('dtr_file')){

                $file = $request->file('dtr_file');
                ini_set('max_execution_time', 0);
                $dtr = file_get_contents($file);
                $data = explode(PHP_EOL,$dtr);
                for($i = 1; $i < count($data); $i++) {
                    try
                    {
                        $employee = explode(',', $data[$i]);
                        $details = new DtrDetails();

                        $id = trim($employee[0], "\" ");
                        $id = ltrim($id, "\" ");


                        if($id != 'Unknown User'){
                            $details->userid = array_key_exists(0, $employee) == true ? trim($employee[0], "\" ") : null;
                            $details->firstname = array_key_exists(1, $employee) == true ? trim($employee[1], "\" ") : null;
                            $details->lastname = array_key_exists(2, $employee) == true ? trim($employee[2], "\" ") : null;
                            $details->department = array_key_exists(3, $employee) == true ? trim($employee[3], "\" ") : null;
                            $details->datein = array_key_exists(4, $employee) == true ? trim($employee[4], "\" ") : null;
                            try{
                                if(array_key_exists(4, $employee) == true){
                                    $date = explode('/', $employee[4]);
                                    $details->date_y = array_key_exists(0, $date) == true ? trim($date[0], "\" ") : null;
                                    $details->date_m = array_key_exists(1, $date) == true ?trim($date[1], "\" ") : null;
                                    $details->date_d = array_key_exists(2, $date) == true ?trim($date[2], "\" ") : null;
                                }
                            } catch(Exception $ex){
                                Log::info("Exception at date array in line 54 :" .$ex->getMessage());
                            }
                            $details->time = array_key_exists(5, $employee) == true ? trim($employee[5], "\" ") : null;
                            try{
                                if(array_key_exists(5,$employee) == true){
                                    $time = explode(':', $employee[5]);
                                    $details->time_h = array_key_exists(0, $time) == true ?trim($time[0], "\" ") : null;
                                    $details->time_m = array_key_exists(1, $time) == true ?trim($time[1], "\" ") : null;
                                    $details->time_s = array_key_exists(2, $time) == true ? trim($time[2], "\" ") : null;
                                }
                            } catch(Exception $ex){
                                Log::info("Exception at time array in line 68 : " .$ex->getMessage());
                            }
                            $details->event = array_key_exists(6, $employee) == true ? trim($employee[6], "\" ") : null;
                            $details->terminal = array_key_exists(7, $employee) == true ? trim($employee[7], "\" ") : null;
                            $details->remark = array_key_exists(8, $employee) == true ? trim($employee[8], "\" ") : null;
                            try{
                                $details->save();
                            } catch(QueryException $ex){
                                break;
                                return redirect('errorupload');
                            }
                            //FOR INSERTING DATA TO THE USERS TABLE ONLY. IF THE USERS TABLE HAS NO DATA, JUST UNCOMMENT THIS COMMENT.
                            $user = User::where('userid',$details->userid)->first();
                            //checking for duplicate userid
                            if( !isset($user) and !count($user) > 0){
                                $user = new User();
                                $user->fname = $details->firstname;
                                $user->lname = $details->lastname;
                                $user->userid = $details->userid;
                                $user->username = $details->userid;
                                $user->password = Hash::make($details->userid);

                                $user->usertype = 0;

                                if(strlen($id)> 5) {
                                    $user->emptype = 'REG';
                                } else {
                                    $user->emptype = 'JO';
                                }
                                $user->save();

                            }
                        }
                    } catch (Exception $ex) {
                        Log::info("Exception at for loop :" . $ex->getMessage());
                        continue;
                    }
                }
               return redirect('index');
            }
        }
    }
    public function dtr_list(Request $request)
    {
        $lists = DB::table('dtr_file')
            ->where('userid','<>', NULL)
            ->orderBy('lastname', 'ASC')
            ->groupBy('userid')
            ->paginate(30);
        return view('dashboard.dtrlist')->with('lists',$lists);
    }
    public function search(Request $request)
    {
        $lists = '';
        if ($request->has('keyword')) {

            $keyword = $request->input('keyword');
            Session::put('keyword', $keyword);
        }
        if ($request->has('from') and $request->has('to')) {
            Session::forget('keyword');
            $_from = explode('/', $request->input('from'));
            $_to = explode('/', $request->input('to'));

            $f_from = $_from[2] . '-' . $_from[0] . '-' . $_from[1];
            $f_to = $_to[2] . '-' . $_to[0] . '-' . $_to[1];
            Session::put('f_from', $f_from);
            Session::put('f_to', $f_to);
        }

        if (Session::has('f_from') and Session::has('f_to') and Session::has('keyword')) {

            $f_from = Session::get('f_from');
            $f_to = Session::get('f_to');
            $keyword = Session::get('keyword');
            $lists = DtrDetails::where('department','<>','- -')
                ->where('datein', '>=', $f_from)
                ->where('datein', '<=', $f_to)
                ->orWhere('userid', 'LIKE', '%'.$keyword.'%')
                ->orWhere('firstname', 'LIKE', '%'.$keyword.'%')
                ->orWhere('lastname', 'LIKE', '%'.$keyword.'%')
                ->orderBy('datein', 'ASC')
                ->paginate(20);
        }
        if(Session::has('keyword')) {
            $keyword = Session::get('keyword');
            $lists = DtrDetails::where('userid', 'LIKE', '%'.$keyword.'%')
                                ->orWhere('firstname', 'LIKE', '%'.$keyword.'%')
                                ->orWhere('lastname', 'LIKE', '%'.$keyword.'%')
                                ->orderBy('userid', 'ASC')
                                ->paginate(20);
        }

        return view('home')->with('lists', $lists);

    }
    public function create_attendance(Request $request)
    {
        if($request->isMethod('get')) {
            return view('dtr.new_attendance');
        }
        if($request->isMethod('post')) {
            $dtr = new DtrDetails();
            $dtr->userid = $request->input('userid');
            $dtr->firstname = $request->input('firstname');
            $dtr->lastname = $request->input('lastname');
            $dtr->department = $request->input('department');
            $date = explode('/', $request->input('datein'));
            $date = $date[2] . '-' . $date[0] . '-' . $date[1];
            $dtr->datein = $date;
            $date = explode('-', $date);
            $dtr->date_y = array_key_exists(0, $date) == true ? trim($date[0], "\" ") : null;
            $dtr->date_m = array_key_exists(1, $date) == true ?trim($date[1], "\" ") : null;
            $dtr->date_d = array_key_exists(2, $date) == true ?trim($date[2], "\" ") : null;

            $dtr->time = $request->input('time');
            $time = explode(':', $request->input('time'));
            $dtr->time_h = array_key_exists(0, $time) == true ?trim($time[0], "\" ") : null;
            $dtr->time_m = array_key_exists(1, $time) == true ?trim($time[1], "\" ") : null;
            $dtr->time_s = array_key_exists(2, $time) == true ? trim($time[2], "\" ") : null;

            $dtr->event = $request->input('event');
            $dtr->terminal = $request->input('terminal');
            $dtr->remark = $request->input('remarks');
            $dtr->save();


            $user = User::where('userid',$dtr->userid)->first();
            //checking for duplicate userid
            if( !isset($user) and !count($user) > 0){
                $user = new User();
                $user->fname = $dtr->firstname;
                $user->lname = $dtr->lastname;
                $user->userid = $dtr->userid;
                $user->username = $dtr->userid;
                $user->password = Hash::make($dtr->userid);
                $user->usertype = 0;
                $user->save();
            }
            return redirect('home');
        }
    }
    public function edit_attendance(Request $request,$id = null)
    {
        if($request->isMethod('get')) {
            if(isset($id)) {
                Session::put('dtr_id',$id);
            }
            $dtr = DtrDetails::where('dtr_id', $id)->first();
            return view('dtr.edit_attendance')->with('dtr',$dtr);
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
                return redirect('home');
            }
        }
    }
    public function delete(Request $request)
    {
        $dtr = DtrDetails::where('dtr_id',$request->input('dtr_id'))->first();
        if(isset($dtr) and $dtr != null)
        {
            $dtr->delete();
            return redirect('index')->with('message','Attendance succesfully deleted.');
        }
    }
}