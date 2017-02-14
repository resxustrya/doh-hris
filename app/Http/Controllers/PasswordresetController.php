<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use View;

class PasswordresetController extends Controller
{
    
	public function index()
	{
    return view('users.passwordreset');
}
}
