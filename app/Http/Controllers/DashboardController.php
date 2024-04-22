<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function forgetPass()
    {
        return view('auth.forgetpass');
    }

    public function Session(){
        return view('auth.session');
    }
}