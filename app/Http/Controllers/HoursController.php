<?php
/**
 * Created by PhpStorm.
 * User: Lourence
 * Date: 1/10/2017
 * Time: 4:40 PM
 */

namespace App\Http\Controllers;

use App\Work_sched;
use Illuminate\Http\Request;
class HoursController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        $hours = Work_sched::paginate(10);
        return view('hour.worksched')->with('hours',$hours);
    }

    public function work_schedule(Request $request) {

        if($request->isMethod('get')) {
            return view('hour.form-hour');
        }
        if($request->isMethod('post')) {
            $work_sched = new Work_sched();
            $work_sched->description = $request->input('description');
            $work_sched->am_in = $request->input('am_in');
            $work_sched->am_out = $request->input('am_out');
            $work_sched->pm_in = $request->input('pm_in');
            $work_sched->pm_out = $request->input('pm_out');
            $work_sched->save();
            return redirect('work-schedule')->with('new_hour','New working schedule created.');
        }
    }
    public function edit_schedule(Request $request, $id)
    {
        if($request->isMethod('get')){
            $sched = Work_sched::where('id',$id)->first();
            return view('hour.update_hour')->with('sched',$sched);
        }
        if($request->isMethod('post')) {
            $sched = Work_sched::where('id',$id)->first();
            if(isset($sched) and count($sched) > 0) {
                $sched->description = $request->input('description');
                $sched->am_in = $request->input('am_in');
                $sched->am_out = $request->input('am_out');
                $sched->pm_in = $request->input('pm_in');
                $sched->pm_out = $request->input('pm_out');
                $sched->save();
                return redirect('work-schedule')->with('new_hour','Working schedule successfully updated.');
            } else {
                return redirect('work-schedule');
            }
        }
    }
}