<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function user(){
        $users = User::all();
        return view('user.view_user', compact('users'));
    }

    public function userInsert(Request $request){
        // dd($request->all());
        $validatedData = $request->validate([
            'nombredeusuario' => 'required',
            'nombre' => 'required',
            'correo' => 'required',
            'teléfono' => 'required',
            'empleado' => 'required',
            'contraseña' => 'required',
        ]);

        $filename = '';
        if ($request->hasFile('fotodeusuario')){
            $image = $request->file('fotodeusuario');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('images', $filename);
        }

        $user = User::create([
            'fotodeusuario'       => $filename,
            'nombredeusuario'     => $request->input('nombredeusuario'),
            'nombre'              => $request->input('nombre'),
            'correo'              => $request->input('correo'),
            'teléfono'            => $request->input('teléfono'),
            'empleado'            => $request->input('empleado'),
            'contraseña'          => bcrypt($request->input('contraseña')),
        ]);

        // Redirect back with success message
        session()->flash('success', 'Usuario creado exitosamente!');
        return redirect()->route('user');
    }

    public function userUpdate(Request $request,$id){
        // dd($request->all());
        $validatedData = $request->validate([
            'nombredeusuario' => 'required',
            'nombre' => 'required',
            'correo' => 'required',
            'teléfono' => 'required',
            'empleado' => 'required',
        ]);

        $user = User::findOrFail($id);

        if ($request->hasFile('fotodeusuario')){
            $image = $request->file('fotodeusuario');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('images', $filename);
    
            // Update the imagen attribute with the new filename
            $user->fotodeusuario = $filename;
        }

        //  update Elevators instance
        $user->update([
            'nombredeusuario'     => $request->input('nombredeusuario'),
            'nombre'              => $request->input('nombre'),
            'correo'              => $request->input('correo'),
            'teléfono'            => $request->input('teléfono'),
            'empleado'            => $request->input('empleado'),
        ]);

        // Redirect back with success message
        session()->flash('success', 'Usuario actualizado exitosamente!');
        return redirect()->route('user');

    }

    public function userView(Request $request, $id){
        $users = User::find($id);
        return view('user.view_user_record',compact('users'));
    }

    public function userDestroy($id){
        $users = User::find($id);
        $users->delete();
        session()->flash('danger', 'Usuario eliminar exitosamente!');
        return redirect()->back();
    }

}
