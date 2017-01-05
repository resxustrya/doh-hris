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
        $listQuery = DtrDetails::query();
        $lists = $listQuery->where('userid','<>' ,'')
                    ->where('firstname', '<>', NULL)
                    ->where('lastname', '<>', NULL)
                    ->where('userid', '<>', NULL)
                    ->orderBy('lastname', 'ASC')
                    ->groupBy('userid')
                    ->paginate(20);
        return view('home')->with('lists',$lists);
    }
}
