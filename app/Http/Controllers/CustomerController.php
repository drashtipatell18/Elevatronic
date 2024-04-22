<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class CustomerController extends Controller
{
    public function customer(){
        $customer = Cliente::all();
        return view('customer.view_customer',compact('customer'));
    }

    public function customerCreate(){
        return view('customer.create_customer');
    }
}
