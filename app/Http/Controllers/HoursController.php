<?php
/**
 * Created by PhpStorm.
 * User: Lourence
 * Date: 1/10/2017
 * Time: 4:40 PM
 */

namespace App\Http\Controllers;

use App\FlixeTime;
use Illuminate\Http\Request;
class HoursController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        $flixetimes = FlixeTime::paginate(10);
        return view('hour.newhour')->with('flixetimes',$flixetimes);
    }

    public function create_flixe(Request $request) {
        if($request->isMethod('get')) {
            return view('hour.newflixe');
        }
    }
}