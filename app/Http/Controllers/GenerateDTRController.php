<?php
/**
 * Created by PhpStorm.
 * User: Lourence
 * Date: 3/16/2017
 * Time: 4:27 PM
 */

namespace App\Http\Controllers;


use App\regular_dtr;
use Illuminate\Http\Request;
use App\pdf_filename;
class GenerateDTRController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function list_jo_dtr(Request $request)
    {
        $lists = pdf_filename::where('type','JO')
                                ->where('is_filtered','!=','1')
                                ->orderBy('date_created', 'ASC')
                                ->paginate(20);
        return view('dtr.dtr_list_jo')->with('lists', $lists);
    }

    public function list_regular_dtr(Request $request)
    {
        $lists = pdf_filename::where('type','REG')
                ->orderBy('date_created','ASC')
                ->paginate(20);
        return view('dtr.dtr_list_regular')->with('lists',$lists);
    }

    public function personal_dtrlist(Request $request)
    {
        $lists = pdf_filename::where('is_filtered','<>', '1')
                                ->orderBy('date_created', 'ASC')
                                ->paginate(20);
        return view('dtr.personal_list')->with('lists', $lists);
    }

    public function personal_filter_dtrlist(Request $request)
    {
        $lists = pdf_filename::where('is_filtered','1')
                            ->orderBy('date_created','ASC')
                            ->paginate(20);
        return view('dtr.personal_filter_list')->with('lists',$lists);
    }
}