<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'loginname' => 'required', 
            'loginpassword' => 'required',
        ]);

        if (auth()->attempt(['name' => $credentials['loginname'], 'password' => $credentials['loginpassword']])) {  
            $request->session()->regenerate();
            return redirect('/')->with('status', 'Login successful!'); // Added success message
        }

        return redirect('/')->with('error', 'Invalid credentials'); // Added error message for failed login
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }

    public function register(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => ['required', 'string', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        $user = User::create($validatedData);
        auth()->login($user);

        // Here you would typically create a new user in the database
        // For demonstration purposes, we'll just return a success message

        return redirect('/');
        // return ('Registration successful! Welcome, ' . $validatedData['name'] . '!');
        // return response()->json(['message' => 'Registration successful!']);
    }
}