<?php
/**
 * Created by PhpStorm.
 * User: Lourence
 * Date: 12/2/2016
 * Time: 11:37 AM
 */

namespace App\Http\Controllers;
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

    }
    public function upload(Request $request) {
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
                    try{
                        $employee = explode(',', $data[$i]);
                        $details = new DtrDetails();
                        if(! ((isset($employee[0]) and $employee[0] == 'Unknown User') and ( isset($employee[1]) and $employee[1] == "" or $employee[1] == null))){
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
                                Log::info("Exception at time array in line 66 : " .$ex->getMessage());
                            }

                            $details->event = array_key_exists(6, $employee) == true ? trim($employee[6], "\" ") : null;
                            $details->terminal = array_key_exists(7, $employee) == true ? trim($employee[7], "\" ") : null;
                            $details->remark = array_key_exists(8, $employee) == true ? trim($employee[8], "\" ") : null;
                            $details->save();

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
                                $user->save();
                            }
                        }
                    } catch (Exception $ex) {
                        Log::info("Exception at for loop :" . $ex->getMessage());
                        continue;
                    }
                }
                return redirect('home');
            }
        }
    }
    public function dtr_list(Request $request){
        $lists = DB::table('dtr_file')
            ->where('userid','<>', NULL)
            ->orderBy('lastname', 'ASC')
            ->groupBy('userid')
            ->paginate(30);
        return view('dashboard.dtrlist')->with('lists',$lists);
    }
    public function search(Request $request){

        if($request->has('filter') or $request->has('search')){
            if($request->has('from') and $request->has('to')){
                $_from = explode('/', $request->input('from'));
                $_to = explode('/', $request->input('to'));
                $f_from = $_from[2].'-'.$_from[0].'-'.$_from[1];
                $f_to = $_to[2].'-'.$_to[0].'-'.$_to[1];
                Session::put('f_from',$f_from);
                Session::put('f_to',$f_to);
                if(count($_from) > 0 and count($_to) > 0){
                    if($request->has('keyword')){
                        $keyword = $request->input('keyword');
                        if(isset($keyword)){
                            $lists = DB::table('dtr_file')
                                ->where('datein' ,'>=', $f_from)
                                ->where('datein', '<=', $f_to)
                                ->Where('userid', 'LIKE', '%'.$keyword .'%')
                                ->Where('firstname', 'LIKE', '%'. $keyword .'%')
                                ->Where('lastname', 'LIKE', '%'. $keyword .'%')
                                ->paginate(20);
                            if(isset($lists) and count($lists) > 0){
                                Session::put('lists',$lists);
                                return redirect('home');
                            } else
                                return redirect('home')->with('msg', 'No result set is found.');
                        }
                    } else {
                        $lists = DB::table('dtr_file')
                            ->where('datein' ,'>=', $f_from)
                            ->where('datein', '<=', $f_to)
                            ->paginate(20);
                        if(isset($lists) and count($lists) > 0){
                            Session::put('lists',$lists);
                            return redirect('home');
                        } else
                            return redirect('home')->with('msg', 'No result set is found.');
                    }
                }
            } else
                return redirect('home');
        }

    }
}