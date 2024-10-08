<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Elevators;
use App\Models\ReviewType;
use App\Models\Staff;

class ScheduleController extends Controller
{
    public function schedule()
    {
        $schedules = Schedule::all();
        $elevators = Elevators::pluck('nombre', 'nombre');
        $reviewtypes = ReviewType::pluck('nombre', 'nombre');
        $staffs = Staff::pluck('nombre', 'nombre');
        $provinces = Schedule::with('provinces')->get()->pluck('provinces.provincia','provinces.id')->filter()->unique(); // Get unique province names, removing null values
        return view('schedule.view_schedule', compact('schedules','staffs', 'elevators', 'reviewtypes', 'provinces'));
    }

    public function scheduleInsert(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'ascensor' => 'required',
            'revisar' => 'required',
            'técnico' => 'required',
            'mantenimiento' => 'required|date',
            'hora_de_inicio' => 'required',
            'hora_de_finalización' => 'required',
            'estado' => 'required',
        ]);

        try {
            // echo 'try';exit;
            $ascensor = Elevators::where('nombre', $request->input('ascensor'))->first();
            $provinceId = $ascensor ? $ascensor->provincia : null; // Assuming province_id is a field in the Elevators model
        
            if (!$provinceId) {
                return response()->json(['errors' => ['ascensor' => ['La provincia no está definida en el ascensor.']]], 422);
            }

            $reviewtype = Schedule::create([
                'ascensor'             => $request->input('ascensor'),
                'revisar'              => $request->input('revisar'),
                'técnico'              => $request->input('técnico'),
                'mantenimiento'        => $request->input('mantenimiento'),
                'hora_de_inicio'       => $request->input('hora_de_inicio'),
                'hora_de_finalización' => $request->input('hora_de_finalización'),
                'estado'               => $request->input('estado'),
                'provincia'            => $provinceId,
            ]);

            // Redirect back with success message
            session()->flash('success', 'Cronograma creado exitosamente!');
            return redirect()->route('schedule');
        } catch (\Exception $e) {
            // echo 'catch';exit;
            // Log the error message
            \Log::error('Error inserting schedule: ' . $e->getMessage());
            return response()->json(['errors' => ['ascensor' => ['An error occurred while creating the schedule.']]], 422);

        }
    }

    public function scheduleUpdate(Request $request, $id)
    {
        //   dd($request->all());
        $validatedData = $request->validate([
            'ascensor' => 'required',
            'revisar' => 'required',
            'técnico' => 'required',
            'mantenimiento' => 'required|date',
            'hora_de_inicio' => 'required',
            'hora_de_finalización' => 'required',
            'estado' => 'required',
        ]);
        $schedules = Schedule::findOrFail($id);

        $ascensor = Elevators::where('nombre', $request->input('ascensor'))->first();
        $provinceId = $ascensor ? $ascensor->provincia : null; // Assuming province_id is a field in the Elevators model
        
        if (!$provinceId) {
            return redirect()->back()->withErrors(['ascensor' => 'Selected ascensor does not have an associated province.']);
        }

        $schedules->update([
            'ascensor'             => $request->input('ascensor'),
            'revisar'              => $request->input('revisar'),
            'técnico'              => $request->input('técnico'),
            'mantenimiento'        => $request->input('mantenimiento'),
            'hora_de_inicio'       => $request->input('hora_de_inicio'),
            'hora_de_finalización' => $request->input('hora_de_finalización'),
            'estado'               => $request->input('estado'),
            'provincia'            => $provinceId,
        ]);

        // Redirect back with success message
        session()->flash('success', 'Cronograma actualizado exitosamente!');
        return redirect()->route('schedule');
    }

    public function getEvents(Request $request)
    {
        $province = $request->input('province');

        // Check if province is provided
        if ($province) {
            // Fetch the elevators based on province
            $elevators = Elevators::where('provincia', $province)->get();
    
            // Get the IDs of the elevators to query events
            $elevator = $elevators->pluck('nombre');
            
            // Query the Schedule based on elevator IDs
            $events = Schedule::whereIn('ascensor', $elevator)->get();
        } else {
            // Fetch all events if no province is provided
            $events = Schedule::all();
        }

        // Format the events
        $formattedEvents = $events->map(function ($event) {
            return [
                'id' => $event->id,
                'ascensor' => $event->ascensor,
                'revisar' => $event->revisar,
                'técnico' => $event->técnico,
                'mantenimiento' => $event->mantenimiento,
                'hora_de_inicio' => $event->hora_de_inicio,
                'hora_de_finalización' => $event->hora_de_finalización,
                'estado' => $event->estado,
            ];
        });

        return response()->json($formattedEvents);
    }

    public function scheduleDelete($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        // Redirect back with success message
        session()->flash('success', 'Cronograma eliminado exitosamente!');
        return redirect()->route('schedule');
    }
}
