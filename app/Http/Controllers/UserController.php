<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function signUpData(Request $request)
    {
        $validated = $request->validate([
            'user_username' => 'required|min:4|regex:/[A-Z]/|regex:/[0-9]/',
            'user_password' => 'required|min:6|regex:/[A-Z]/|regex:/[0-9]/|regex:/[\W_]/',
            'user_email' => 'required|email',
            'cpassword' => 'required|same:user_password',
        ], [
            'user_username.required' => 'The username field is required.',
            'user_username.min' => 'The username must be at least 4 characters long.',
            'user_username.regex' => 'The username must contain at least one uppercase letter and one number.',
            'user_password.required' => 'The password field is required.',
            'user_password.min' => 'The password must be at least 6 characters long.',
            'user_password.regex' => 'The password must contain at least one uppercase letter, one number, and one special character.',
            'user_email.required' => 'The email field is required.',
            'user_email.email' => 'The email must be a valid email address.',
            'cpassword.required' => 'The confirm password field is required.',
            'cpassword.same' => 'The confirm password must match the password.',
        ]);

        $userData = [
            'user_username' => $validated['user_username'],
            'user_email' => $validated['user_email'],
            'user_ipassword' => $validated['user_password'],
            'user_password' => Hash::make($validated['user_password']),
        ];

        $user = User::create($userData);

        return redirect()->route('signin')->with([
            'success' => 'Registration successful!',
            'user_username' => $user->user_username,
        ]);
    }
    //
    public function signInData(Request $request)
    {
        $validated = $request->validate([
            'user_username' => 'required|min:4|regex:/[A-Z]/|regex:/[0-9]/',
            'user_password' => 'required|min:6|regex:/[A-Z]/|regex:/[0-9]/|regex:/[\W_]/',
        ], [
            'user_username.required' => 'The username field is required.',
            'user_username.min' => 'The username must be at least 4 characters long.',
            'user_username.regex' => 'The username must contain at least one uppercase letter and one number.',
            'user_password.required' => 'The password field is required.',
            'user_password.min' => 'The password must be at least 6 characters long.',
            'user_password.regex' => 'The password must contain at least one uppercase letter, one number, and one special character.',
        ]);
        //
        $credentials = [
            'user_username' => $validated['user_username'],
            'password' => $validated['user_password'],
        ];
        //
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin')->with('success', 'Logged in successfully.');
        }
        //
        return redirect()->back()->withErrors(['login' => 'Invalid username or password.']);
    }
}
