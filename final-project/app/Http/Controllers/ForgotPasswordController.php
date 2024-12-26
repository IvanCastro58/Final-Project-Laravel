<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $employee = Employee::where('email', $request->email)->first();

        if (!$employee) {
            return back()->withErrors(['email' => 'No account found with this email.']);
        }

        $token = Str::random(64);

        $employee->update(['remember_token' => $token]);

        $resetLink = route('password.reset', ['token' => $token]);

        Mail::send('emails.reset-password', ['resetLink' => $resetLink], function ($message) use ($employee) {
            $message->to($employee->email)
                    ->subject('Reset Password');
        });

        return back()->with('status', 'Reset password link sent to your email.');
    }

    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $employee = Employee::where('remember_token', $request->token)->first();

        if (!$employee) {
            return back()->withErrors(['token' => 'Invalid token.']);
        }

        $employee->update([
            'password' => Hash::make($request->password),
            'remember_token' => null,
        ]);

        return redirect('/login')->with('status', 'Password reset successfully. You can now log in.');
    }
}
