<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function customer(){
        // $maintanances = Cliente::all();
        return view('maintanance.view_maintanance');
    }
    
}
