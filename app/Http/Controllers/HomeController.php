<?php

namespace App\Http\Controllers;

use App\DtrDetails;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       if($request->user()->usertype == "1") {
           return redirect('home');
       }
       if($request->user()->usertype == "0") {
           return redirect('personal/home');
       }
    }
}
