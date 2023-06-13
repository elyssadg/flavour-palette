<?php

namespace App\Http\Controllers;

use App\Models\Catering;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;
use Ramsey\Uuid\Uuid;

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

    public function validateRegister(Request $request) {
        $validation = [
            'profile_picture' => 'required|mimetypes:image/jpeg,image/jpg,image/png',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required',
            'username' => 'required',
            'fullname' => 'required',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
            'gender'=> 'required|in:male,female',
            'dob' => 'required|before:-13 years'
        ];

        $validator = Validator::make($request->all(), $validation);
        if($validator->fails()){
            return back()->withErrors($validator);
        }

        if($request->switch == "customer"){
            $user = new User();
            $user->id = Uuid::uuid4();
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->username = $request->username;
            $user->fullname = $request->fullname;
            $user->password = bcrypt($request->password);
            $user->gender = $request->gender;
            $user->role = $request->switch;
            $user->dob = $request->dob;
            if($request->profile_picture != null){
                $file = $request->file('profile_picture');
                $imageName = time().'.'.$file->getClientOriginalExtension();
                Storage::putFileAs('public/profile/user', $file, $imageName);
                $user->profile_picture = $imageName;
            }
            $user->save();

            return view('pages.auth.login');
        }else{
            $imageName = null;
            if($request->profile_picture != null){
                $file = $request->file('profile_picture');
                $imageName = time().'.'.$file->getClientOriginalExtension();
                Storage::putFileAs('public/profile/user/', $file, $imageName);
            }

            $request->flash();
            $seller = $request;

            return view('pages.auth.register_catering', compact('seller', 'imageName'));
        }
    }
}
