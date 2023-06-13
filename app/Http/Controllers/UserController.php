<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Register View
    public function registerUser() {
        return view('pages.auth.register_user');
    }

    // Login View
    public function login() {
        return view('pages.auth.login');
    }

    public function validateLogin(Request $request) {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        // Valid
        if(Auth::attempt($credentials, true)){
            // Remember Me
            $remember = $request->remember;

            if($remember){
                Cookie::queue('email_cookie', $request->email, 7);
                Session::put('login_session', $credentials);
            }else{
                Cookie::queue('email_cookie', null);
                Session::put('login_session', null);
            }
            return redirect('/');
        }

        // Not Valid
        return redirect()->back()->withInput()->withErrors(['login' => 'Invalid credentials']);
    }
}
