<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    public function register(Request $request)
    {
        try {
        
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|unique:registration,email',
                'password' => 'required|string|min:6',
                'phone_number' => 'required|string|max:255',
            ]);
    
 
            $user = new Registration();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone_number = $request->phone_number;
            $user->save();
    
   
            return view('login')->with('message', 'User registered successfully!');
        } catch (\Illuminate\Database\QueryException $e) {
        
            $message = 'Email is already taken. Please choose a different email.';
            return view('register', compact('message'));
        }
    }
    


    public function login(Request $request)
    {
        
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

    
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
      
            return redirect()->route('tasks.index')->with('message', 'Logged in successfully!');
        }

    
        return redirect()->route('tasks.index')->with('message', 'Login failed. Please provide valid credentials');
    }
}
