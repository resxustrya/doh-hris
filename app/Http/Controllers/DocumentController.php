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
use Illuminate\Support\Facades\App;
class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public  function leave(Request $request)
    {
        if($request->isMethod('get')){
            return view('form.form_leave');
        }
        if($request->isMethod('post')) {

            $leave = new Leave();
            $leave->userid = $request->user()->id;
            $leave->office_agency = $request->input('office_agency');
            $leave->lastname = $request->input('lastname');
            $leave->firstname = $request->input('firstname');
            $leave->middlename = $request->input('middlename');
            $date_filling = explode('/', $request->input('date_filling'));
            $leave->date_filling = $date_filling[2].'-'.$date_filling[0].'-'.$date_filling[1];
            $leave->position = $request->input('position');
            $leave->salary = $request->input('salary');
            $leave->leave_type = $request->input('leave_type');
            $leave->leave_type_others_1 = $request->input('leave_type_others_1');
            $leave->leave_type_others_2 = $request->input('leave_type_others_2');
            $leave->vication_loc = $request->input('vication_loc');
            $leave->abroad_others = $request->input('abroad_others');
            $leave->sick_loc = $request->input('sick_loc');
            $leave->in_hospital_specify = $request->input('in_hospital_specify');
            $leave->out_patient_specify = $request->input('out_patient_specify');
            $leave->applied_num_days = $request->input('applied_num_days');

            $inc_from = explode('/', $request->input('inc_from'));
            $leave->inc_from = $inc_from[2].'-'.$inc_from[0].'-'.$inc_from[1];

            $inc_to = explode('/', $request->input('inc_to'));
            $leave->inc_to = $inc_to[2].'-'.$inc_to[0].'-'.$inc_to[1];
            $leave->com_requested = $request->input('com_requested');

            $credit_date = explode('/', $request->input('credit_date'));
            $leave->credit_date = $credit_date[2].'-'.$credit_date[0].'-'.$credit_date[1];
            $leave->vication_total = $request->input('vication_total');
            $leave->sick_total = $request->input('sick_total');
            $leave->over_total = $request->input('over_total');
            $leave->a_days_w_pay = $request->input('a_days_w_pay');
            $leave->a_days_wo_pay = $request->input('a_days_wo_pay');
            $leave->a_others = $request->input('a_others');
            $leave->reco_approval = $request->input('reco_approval');
            $leave->reco_disaprove_due_to = $request->input('reco_disaprove_due_to');
            $leave->disaprove_due_to = $request->input('disaprove_due_to');

            $leave->save();
            return redirect('form/leave/all');

        }
    }

    public function all_leave()
    {
        $leaves = Leave::paginate(10);

        return view('form.list')->with('leaves', $leaves);
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

    public function get_leave(Request $request, $id)
    {
        $leave = Leave::find($id);
        return view('form.leave')->with('leave', $leave);
    }

    public function print_leave(Request $request, $id)
    {
        $leave = Leave::find($id);
        $display = view('pdf.leave')->with('leave', $leave);
        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper('LEGAL', 'portrait');
        $pdf->loadHTML($display);
        return $pdf->stream();
    }

}