<?php
/**
 * Created by PhpStorm.
 * User: Lourence
 * Date: 1/12/2017
 * Time: 11:18 AM
 */

namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use App\User;
use Illuminate\Http\Request;
use App\DtrDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $lists = DtrDetails::where('userid','<>' ,'')
            ->where('firstname', '<>', NULL)
            ->where('lastname', '<>', NULL)
            ->where('userid', '<>', NULL)
            ->orderBy('lastname', 'ASC')
            ->groupBy('userid')
            ->paginate(20);
        return view('home')->with('lists',$lists);
    }
}