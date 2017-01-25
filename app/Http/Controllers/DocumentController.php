<?php
/**
 * Created by PhpStorm.
 * User: Lourence
 * Date: 1/23/2017
 * Time: 9:41 AM
 */

namespace App\Http\Controllers;
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
        if($request->isMethod('post')){
            return $request->all();
        }
    }
}