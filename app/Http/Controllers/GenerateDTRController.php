<?php
/**
 * Created by PhpStorm.
 * User: Lourence
 * Date: 3/16/2017
 * Time: 4:27 PM
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\pdf_filename;
class GenerateDTRController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function list_dtr(Request $request)
    {
        $lists = pdf_filename::where('remember_token','=',null)
                                ->orderBy('remember_token','ASC')
                                ->paginate(20);
        return view('dtr.dtr_list_jo')->with('lists',$lists);
    }



}