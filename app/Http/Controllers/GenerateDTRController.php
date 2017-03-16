<?php
/**
 * Created by PhpStorm.
 * User: Lourence
 * Date: 3/16/2017
 * Time: 4:27 PM
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class GenerateDTRController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function list_dtr(Request $request)
    {
        return view('dtr.dtr_list_jo');
    }
}