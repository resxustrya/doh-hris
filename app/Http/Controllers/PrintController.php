<?php
/**
 * Created by PhpStorm.
 * User: Lourence
 * Date: 1/6/2017
 * Time: 9:46 AM
 */

namespace App\Http\Controllers;


use App\DtrDetails;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use PDO;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\PDF;
class PrintController extends Controller
{
    private $pdo;
    public function __construct()
    {
        $this->middleware('auth');
        $this->pdo = DB::connection()->getPdo();
    }

    public function home(Request $request)
    {
        return view('print.monthly');
    }

    public function print_monthly(Request $request)
    {
        $pdo = DB::connection()->getPdo();
        if($request->isMethod('get')) {
            return view('print.monthly');
        }
        if($request->isMethod('post')){

           if($request->has('filter')) {
               if($request->has('from') and $request->has('to')) {
                   $_from = explode('/', $request->input('from'));
                   $_to = explode('/', $request->input('to'));
                   $f_from = $_from[2].'-'.$_from[0].'-'.$_from[1];
                   $f_to = $_to[2].'-'.$_to[0].'-'.$_to[1];
                   Session::put('f_from',$f_from);
                   Session::put('f_to',$f_to);
                   $query = "SELECT userid FROM users where usertype <> 1";
                   $st = $pdo->prepare($query);
                   $st->execute();
                   $lists = $st->fetchAll(PDO::FETCH_ASSOC);

                   $display = view('pdf.jo_monthly')->with('lists',$lists);
                   $pdf = App::make('dompdf.wrapper');
                   $pdf->setPaper('A4', 'portrait');
                   $pdf->loadHTML($display);
                   return $pdf->stream();

               }
           }

        }
    }
    public function print_pdf(Request $request)
    {
        $pdo = DB::connection()->getPdo();
        if($request->has('filter')) {
            if($request->has('from') and $request->has('to')) {
                $_from = explode('/', $request->input('from'));
                $_to = explode('/', $request->input('to'));
                $f_from = $_from[2].'-'.$_from[0].'-'.$_from[1];
                $f_to = $_to[2].'-'.$_to[0].'-'.$_to[1];
                Session::put('f_from',$f_from);
                Session::put('f_to',$f_to);
                $query = "SELECT userid FROM users where usertype <> 1";
                $st = $pdo->prepare($query);
                $st->execute();
                $lists = $st->fetchAll(PDO::FETCH_ASSOC);

                $display = view('pdf.jo_monthly')->with('lists',$lists);
                $pdf = App::make('dompdf.wrapper');
                $pdf->setPaper('A4', 'portrait');
                $pdf->loadHTML($display);
                return $pdf->stream();

            }
        }
    }
    public function print_employee(Request $request) {
        if($request->isMethod('get')){
            return view('print.employee');
        }
    }

    public function get_name($userid)
    {
        $pdo = null;
        try{
            $pdo = new PDO("mysql:host=localhost;dbname=dohdtr",'root','');
        }catch(PDOException $ex) {
            print "There was an error connecting to database.";
            die();
        }

        $query = "SELECT fname,lname,mname from users WHERE userid = '" . $userid . "'";
        $st = $pdo->prepare($query);
        $st->execute();
        $row = $st->fetchAll(PDO::FETCH_ASSOC);

        if(isset($row) and count($row) > 0)
        {
            $pdo = null;
            return $row[0]['fname']." ".$row[0]['mname']. " " .$row[0]['lname'];
        }
    }
}