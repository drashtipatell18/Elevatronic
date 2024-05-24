<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Rules\PasswordFormat;
use App\Models\Staff;

class UserController extends Controller
{
    public function user(){
        $users = User::all();
        $staffs = Staff::pluck('nombre','nombre');
        return view('user.view_user', compact('users','staffs'));
    }

    public function userInsert(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'employee' => 'required',
            'password' => ['required', new PasswordFormat()],
            'image' => 'nullable|image|max:2048', // Optional image validation
        ]);

        $filename = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename); // Save the image to the public/images directory
        }

        $user = User::create([
            'image' => $filename,
            'username' => $request->input('username'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'employee' => $request->input('employee'),
            'password' => bcrypt($request->input('password')),
        ]);

        // Redirect back with success message
        session()->flash('success', 'Usuario creado exitosamente!');
        return redirect()->route('user');
    }

    public function userUpdate(Request $request,$id){
        // dd($request->all());
        $validatedData = $request->validate([
            'username' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'employee' => 'required',
        ]);

        $user = User::findOrFail($id);

        if ($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('images', $filename);

            // Update the imagen attribute with the new filename
            $user->image = $filename;
        }

        //  update Elevators instance
        $user->update([
            'username'            => $request->input('username'),
            'name'                => $request->input('name'),
            'email'               => $request->input('email'),
            'phone'               => $request->input('phone'),
            'employee'            => $request->input('employee'),
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
