<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Elevators;
use App\Models\ReviewType;
use App\Models\Province;

class ScheduleController extends Controller
{
    public function schedule(){
        $schedules = Schedule::all();
        $elevators = Elevators::pluck('nombre','nombre');
        $reviewtypes = ReviewType::pluck('nombre','nombre');
        $provinces = Province::pluck('provincia', 'provincia');
        return view('schedule.view_schedule',compact('schedules','elevators','reviewtypes','provinces'));
    }

    public function scheduleInsert(Request $request){
        $validatedData = $request->validate([
            'ascensor' => 'required',
            'revisar' => 'required',
            'técnico' => 'required',
            'mantenimiento' => 'required|date',
            'hora_de_inicio' => 'required',
            'hora_de_finalización' => 'required',
            'estado' => 'required',
        ]);

        // Create a new ReviewType instance

        $reviewtype = Schedule::create([
            'ascensor'             => $request->input('ascensor'),
            'revisar'              => $request->input('revisar'),
            'técnico'              => $request->input('técnico'),
            'mantenimiento'        => $request->input('mantenimiento'),
            'hora_de_inicio'       => $request->input('hora_de_inicio'),
            'hora_de_finalización' => $request->input('hora_de_finalización'),
            'estado'               => $request->input('estado'),
        ]);

        // Redirect back with success message
        session()->flash('success', 'Cronograma creado exitosamente!');
        return redirect()->route('schedule');
    }

    public function scheduleUpdate(Request $request,$id){
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

        // Create a new ReviewType instance

        $schedules->update([
            'ascensor'             => $request->input('ascensor'),
            'revisar'              => $request->input('revisar'),
            'técnico'              => $request->input('técnico'),
            'mantenimiento'        => $request->input('mantenimiento'),
            'hora_de_inicio'       => $request->input('hora_de_inicio'),
            'hora_de_finalización' => $request->input('hora_de_finalización'),
            'estado'               => $request->input('estado'),
        ]);

        // Redirect back with success message
        session()->flash('success', 'Cronograma actualizado exitosamente!');
        return redirect()->route('schedule');
    }

    public function getEvents(Request $request)
    {
        $events = Schedule::all();

        $formattedEvents = [];
        foreach ($events as $event) {
            $formattedEvents[] = [
                'id' => $event->id,
                'ascensor' => $event->ascensor,
                'revisar' => $event->revisar,
                'técnico' => $event->técnico,
                'mantenimiento' => $event->mantenimiento,
                'hora_de_inicio' => $event->hora_de_inicio,
                'hora_de_finalización' => $event->hora_de_finalización,
                'estado' => $event->estado,
            ];
        }

        return response()->json($formattedEvents);
    }

}
