<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Rules\PasswordFormat;

class DashboardController extends Controller
{
    public function showForgetPasswordForm()
    {
        return view('auth.forgetpass');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $email = $request->email;

        // Find the user by the provided email
        $user = User::where('email', $email)->first();

        // Check if the user exists
        if ($user) {
            // Generate a new remember token for the user
            $user->remember_token = Str::random(40);
            $user->save();

            // Send the password reset email to the user
            Mail::to($user->email)->send(new ForgotPasswordMail($user));

            // Redirect back with a success message
            return back()->with('success', 'Password reset link sent successfully.');
        } else {
            // Redirect back with an error message if the user was not found
            return back()->with('danger', 'User not found.');
        }
    }


    public function Session(){
        return view('auth.session');
    }

    public function reset($token)
    {
        $user = User::where('remember_token','=',$token)->first();
        if(!empty($user)){
            $data['user'] = $user;
            $data['token'] = $user->remember_token;
            return view('auth.reset', $data);
        }
    }

    public function postReset($token, Request $request)
    {
        // Validate the request inputs
        $request->validate([
            'newpassword' => ['required', new PasswordFormat()],
            'confirmpassword' => ['required', new PasswordFormat()],
        ]);

        // Check if the new password and confirmation match
        if ($request->newpassword !== $request->confirmpassword) {
            return redirect()->back()->with('error', 'The new password confirmation does not match.');
        }

        // Find the user by the provided token
        $user = User::where('remember_token', $token)->first();

        // Check if the user was found
        if ($user) {
            // Verify the user's email if not already verified
            if (empty($user->email_verified_at)) {
                $user->email_verified_at = now();
            }

            // Update the user's token and password
            $user->remember_token = Str::random(40);
            $user->password = Hash::make($request->newpassword);
            $user->save();

            // Redirect to the login page with a success message
            return redirect('login')->with('success', 'Password successfully reset.');
        } else {
            // Redirect back with an error message if the user was not found
            return redirect()->back()->with('error', 'Invalid token or user not found.');
        }
    }

}
