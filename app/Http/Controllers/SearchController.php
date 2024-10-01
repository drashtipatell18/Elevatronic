<?php

namespace App\Http\Controllers;
use App\Models\Elevators;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function suggest(Request $request)
    {
        $query = trim($request->input('query'));
        $escapedQuery = str_replace(['%', '_'], ['\%', '\_'], $query);

        // Get suggestions from Elevators table, including id
        $suggestions = Elevators::whereRaw('LOWER(nombre) LIKE LOWER(?)', ["%{$escapedQuery}%"])
            ->select('id', 'nombre') // Select both id and nombre
            ->get(); // Use get() instead of pluck()

        return response()->json($suggestions); // Return the full object
    }
}
