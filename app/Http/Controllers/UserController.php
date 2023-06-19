<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Ramsey\Uuid\Uuid;

class UserController extends Controller
{   
    // Register User View
    public function register() {
        return view('pages.auth.register');
    }

    // Login View
    public function login() {
        return view('pages.auth.login');
    }

    // Login Validation
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

            return response()->json([
                'error' => false,
                'redirect' => '/'
            ]);
        }

        // Not Valid
        $error_message = 'Invalid credentials';
        return response()->json([
            'error' => true,
            'error_message' => $error_message
        ]);
    }

    // Register Validation
    public function validateRegister(Request $request) {
        if($request->switch == "customer"){
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
                $error_message = $validator->errors()->first();
                return response()->json([
                    'error' => true,
                    'error_message' => $error_message
                ]);
            }

            $user = new User();
            $user->id = Uuid::uuid4();
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->fullname = $request->fullname;
            $user->password = Hash::make($request->password);
            $user->role = $request->switch;
            if($request->profile_picture != null){
                $file = $request->file('profile_picture');
                $imageName = time().'.'.$file->getClientOriginalExtension();
                Storage::putFileAs('public/profile/user', $file, $imageName);
                $user->profile_picture = $imageName;
            }
            $user->save();

            $cc = new CustomerController();
            $cc->insertCustomer($user->id, $request->username, $request->gender, $request->dob);

            return response()->json([
                'error' => false,
                'redirect' => '/login'
            ]);
        }else{
            $validation = [
                'profile_picture' => 'required|mimetypes:image/jpeg,image/jpg,image/png',
                'email' => 'required|email|unique:users',
                'phone_number' => 'required',
                'fullname' => 'required',
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required',
                'catering_name' => 'required',
                'description' => 'required',
                'address' => 'required',
                'opening_hour' => 'required',
                'closing_hour' => 'required',
                'halal_certification' => 'required|mimetypes:application/pdf,image/jpeg,image/jpg,image/png',
                'business_permit' => 'required|mimetypes:application/pdf,image/jpeg,image/jpg,image/png'
            ];
    
            $validator = Validator::make($request->all(), $validation);
            if($validator->fails()){
                $error_message = $validator->errors()->first();
                return response()->json([
                    'error' => true,
                    'error_message' => $error_message
                ]);
            }

            $user = new User();
            $user->id = Uuid::uuid4();
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->fullname = $request->fullname;
            $user->password = Hash::make($request->password);
            $user->role = $request->switch;
            if($request->profile_picture != null){
                $file = $request->file('profile_picture');
                $imageName = time().'.'.$file->getClientOriginalExtension();
                Storage::putFileAs('public/profile/user', $file, $imageName);
                $user->profile_picture = $imageName;
            }
            $user->save();

            $halal_certification = "";
            $business_permit = "";
            if($request->halal_certification != null){
                $file = $request->file('halal_certification');
                $imageName = time().'.'.$file->getClientOriginalExtension();
                Storage::putFileAs('public/halal_certification/', $file, $imageName);
                $halal_certification = $imageName;
            }
            if($request->business_permit != null){
                $file = $request->file('business_permit');
                $imageName = time().'.'.$file->getClientOriginalExtension();
                Storage::putFileAs('public/business_permit/', $file, $imageName);
                $business_permit = $imageName;
            }

            $sc = new SellerController();
            $sc->insertSeller($user->id, $request->catering_name, $request->description, $halal_certification, $business_permit, $request->address, $request->opening_hour, $request->closing_hour);

            return response()->json([
                'error' => false,
                'redirect' => '/login'
            ]);
        }
    }

    // Change Status
    public function updateStatus(Request $request) {
        if ($request->status == 'activate'){
            User::where('id', Auth::user()->id)->update([
                'status' => 'active'
            ]);
        } else if ($request->status == 'deactivate'){
            User::where('id', Auth::user()->id)->update([
                'status' => 'inactive'
            ]);
        } 

        return redirect()->back();
    }

    // Edit Profile View
    public function editProfile(Request $request) {
        return view('pages.edit_profile');
    }

    // Edit Account Validation
    public function editAccount(Request $request) {
        if (Auth::user()->role == 'customer') {
            $validation = [
                'profile_picture' => 'mimetypes:image/jpeg,image/jpg,image/png',
                'email' => 'required|email|unique:users,email,'.auth()->user()->id,
                'username' => 'required',
                'fullname' => 'required',
                'phone_number' => 'required',
                'gender'=> 'required|in:male,female',
                'dob' => 'required|before:-13 years'
            ];

            $validator = Validator::make($request->all(), $validation);
            if($validator->fails()){
                $error_message = $validator->errors()->first();
                return response()->json([
                    'error' => true,
                    'error_message' => $error_message
                ]);
            }

            $user = User::where('id', Auth::user()->id)->first();
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->fullname = $request->fullname;
            if($request->profile_picture != null){
                $file = $request->file('profile_picture');
                $imageName = time().'.'.$file->getClientOriginalExtension();
                Storage::putFileAs('public/profile/user', $file, $imageName);
                $user->profile_picture = $imageName;
            }
            $user->save();

            $cc = new CustomerController();
            $cc->updateCustomer($user->id, $request->username, $request->gender, $request->dob);
        } else if (Auth::user()->role == 'seller') {
            $validation = [
                'profile_picture' => 'mimetypes:image/jpeg,image/jpg,image/png',
                'email' => 'required|email|unique:users,email,'.auth()->user()->id,
                'fullname' => 'required',
                'phone_number' => 'required'
            ];

            $validator = Validator::make($request->all(), $validation);
            if($validator->fails()){
                $error_message = $validator->errors()->first();
                return response()->json([
                    'error' => true,
                    'error_message' => $error_message
                ]);
            }

            $user = User::where('id', Auth::user()->id)->first();
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->fullname = $request->fullname;
            if($request->profile_picture != null){
                $file = $request->file('profile_picture');
                $imageName = time().'.'.$file->getClientOriginalExtension();
                Storage::putFileAs('public/profile/user', $file, $imageName);
                $user->profile_picture = $imageName;
            }
            $user->save();
        }

        return response()->json([
            'error' => false,
            'redirect' => '/profile/edit'
        ]);
    }

    // Edit Password Validation
    public function editPassword(Request $request) {
        $user = User::where('id', Auth::user()->id)->first();
        if(Hash::check($request->old_password, $user->password)){
            $validation = [
                'new_password' => 'required|min:8',
                'password_confirmation' => 'required|same:new_password',
            ];

            $validator = Validator::make($request->all(), $validation);
            if($validator->fails()){
                $error_message = $validator->errors()->first();
                return response()->json([
                    'error' => true,
                    'error_message' => $error_message
                ]);
            }

            $user->password = Hash::make($request->new_password);
            $user->save();

            return response()->json([
                'error' => false,
                'redirect' => '/profile/edit'
            ]);
        }
        
        return response()->json([
            'error' => true,
            'error_message' => 'The old password is incorrect'
        ]);
    }

    // Logout
    public function logout() {
        Auth::logout();
        Session::forget('login_session');
        return view('pages.auth.login');
    }
}
