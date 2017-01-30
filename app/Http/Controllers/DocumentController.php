<?php
/**
 * Created by PhpStorm.
 * User: Lourence
 * Date: 1/23/2017
 * Time: 9:41 AM
 */

namespace App\Http\Controllers;
use App\Leave;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public  function leave(Request $request)
    {
        if($request->isMethod('get')){
            return view('form.leave');
        }
        if($request->isMethod('post')) {
            $leave = new Leave();

            $leave->userid = $request->user()->userid;
            $leave->office_agency = $request->input('office_agency');
            $leave->lastname = $request->input('lastname');
            $leave->firstname = $request->input('firstname');
            $leave->middlename = $request->input('middlename');
            $leave->date_filling = $request->input('date_filling');
            $leave->position = $request->input('position');
            $leave->month_salary = $request->input('month_salary');
            $leave->vication_leave_type = $request->input('vication_leave_type');
            $leave->vacation_others = $request->input('vacation_others');
            $leave->sick_leave_type = $request->input('sick_leave_type');
            $leave->sick_others = $request->input('sick_others');
            $leave->vacation_loc = $request->input('vacation_loc');
            $leave->abroad_others = $request->input('abroad_others');
            $leave->med_loc = $request->input('med_loc');
            $leave->out_patient_others = $request->input('out_patient_others');
            $leave->applied_num_days = $request->input('applied_num_days');
            $leave->inc_from = $request->input('inc_from');
            $leave->inc_to =  $request->input('inc_to');
            $leave->requested = $request->input('requested');

            $leave->save();
            return $leave->id;

        }
    }
    public function so(Request $request)
    {

        if($request->isMethod('get')){
            return view('form.office_order');
        }
        if($request->isMethod('post')){
            return $request->all();
        }
    }
}