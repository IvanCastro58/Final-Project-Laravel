<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function display(Request $request)
    {
        if (!session('employee')) {
            return redirect()->route('login'); 
        }

        $search = $request->query('search');
        $employees = Employee::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'LIKE', "%{$search}%");
            })
            ->paginate(10);

        return view('employee', ["employees" => $employees]);
    }

    public function sendInvitation(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:employee,email',
            'role' => 'required|in:employee,admin',
        ], [
            'email.unique' => 'The email is already an admin/employee in the system.',
        ]);

        $token = Str::random(40);

        Employee::create([
            'email' => $request->email,
            'role' => $request->role,
            'password' => null,
            'status' => 'pending',
            'remember_token' => $token,
        ]);

        $registrationLink = route('registerForm', ['token' => $token]);
        Mail::send('emails.invite', ['link' => $registrationLink, 'role' => $request->role], function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Resort Reservation System - Account Creation');
        });

        return redirect()->back()->with('success', 'Invitation sent successfully.');
    }

    public function showRegistrationForm($token)
    {
        $employee = Employee::where('remember_token', $token)->first();

        if (!$employee || $employee->status !== 'pending') {
            return abort(404, 'Invalid or expired token.');
        }

        return view('register', ['token' => $token, 'employee' => $employee]);
    }

    public function registerAccount(Request $request, $token)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|confirmed|min:6',
        ]);

        $employee = Employee::where('remember_token', $token)->first();

        if (!$employee || $employee->status !== 'pending') {
            return abort(404, 'Invalid or expired token.');
        }

        $employee->update([
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'status' => 'active',
            'remember_token' => null,
        ]);

        return redirect()->route('login')->with('success', 'Account successfully created.');
    }
}

