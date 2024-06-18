<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Gender;
use App\Models\UserModel;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //View Login Page
    public function login(){
        return view('loginpages.login');
    }

    //View Sign-Up Page 
    /*public function signup(){
        return view('loginpages.signup');
    }*/

    //Show gender options in Sign-up Form and also to view the sign up page
    public function index(){
        $genders = Gender::all(); // Correct variable name
        return view('loginpages.signup', compact('genders')); // Pass the variable to the view
    }
    

    // Add the user to Database
    public function signupUser(Request $request)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'max:155'],
            'gender_id' => ['required'],
            'address' => ['required', 'max:55'],
            'contact_number' => ['required', 'max:55'],
            'username' => ['required', Rule::unique('users', 'username')],
            'password' => ['required', 'confirmed'], // 'password_confirmation' will be auto-validated by 'confirmed' rule
        ], [
            'gender_id.required' => 'The gender field is required.'
        ]);
    
        $validated['user_access_id'] = 2;
    
        // Hash the password before storing it
        $validated['password'] = Hash::make($validated['password']);
        UserModel::create($validated);
    
        return redirect('/')->with('message_success', 'Successfully Registered');
    }
    

   
    public function processLogin(Request $request)
    {
        // Validate input data
        $validated = $request->validate([
            'username' => ['required', 'max:12'],
            'password' => ['required', 'max:15']
        ]);

        // Find the user by username
        $user = UserModel::where('username', $validated['username'])->first();

        // Check if user exists and if the password is correct
        if ($user && Hash::check($validated['password'], $user->password)) {
            // Attempt to authenticate the user
            if (Auth::attempt($validated)) {
                // Login the user
                Auth::login($user);

                // Regenerate the session
                $request->session()->regenerate();

                // Redirect based on user_access_id
                if ($user->user_access_id == 1) {
                    return redirect()->route('admin');
                } elseif ($user->user_access_id == 2) {
                    return redirect()->route('posdashboard');
                } else {
                    // Default redirection or error handling
                    return redirect('/defaultdashboard');
                }
            }
        }

        // If authentication fails, redirect back with an error
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function anotherProcessLogout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    




}
