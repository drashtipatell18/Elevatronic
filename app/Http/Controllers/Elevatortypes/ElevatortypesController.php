<?php

namespace App\Http\Controllers\Elevatortypes;

use App\Http\Controllers\Controller;
use App\Models\Elevatortypes\Elevatortypes;
use Illuminate\Http\Request;

class ElevatortypesController extends Controller
{
    public function Elevatortypes(){
        // $elevator_types = Elevatortypes::all();
        return view('ElevatorTypes.view_elevator_types');
    }

    public function customerCreate(){
        return view('ElevatorTypes.create_elevator_types');
    }
}
