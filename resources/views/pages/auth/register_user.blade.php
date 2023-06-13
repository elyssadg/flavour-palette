@extends('master.auth_layout')

@section('title')
    Register
@endsection

@section('content')
    <style>
        input:focus {
            outline-color: transparent;
            -webkit-focus-ring-color: transparent;
        }
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        :root {
            --white: white;
            --darkgreen: #727C4A;
        }

        .switch-wrapper {
            padding: 4px;
            margin: 2rem 0px 2rem 0px;
        }

        .switch-wrapper [type="radio"] {
            position: absolute;
            left: -9999px;
        }

        .switch-wrapper [type="radio"]:checked#customer ~ label[for="customer"],
        .switch-wrapper [type="radio"]:checked#seller ~ label[for="seller"] {
            color: var(--white);
        }

        .switch-wrapper [type="radio"]:checked#customer ~ label[for="customer"]:hover,
        .switch-wrapper [type="radio"]:checked#seller ~ label[for="seller"]:hover {
            background: transparent;
        }

        .switch-wrapper
            [type="radio"]:checked#customer
            + label[for="seller"]
            ~ .highlighter {
            transform: none;
        }

        .switch-wrapper
            [type="radio"]:checked#seller
            + label[for="customer"]
            ~ .highlighter {
            transform: translateX(100%);
        }

        .switch-wrapper label {
            z-index: 1;
            min-width: 50%;
            cursor: pointer;
            transition: color 0.25s ease-in-out;
        }

        .switch-wrapper .highlighter {
            position: absolute;
            top: 0px;
            left: 0px;
            width: calc(50%);
            height: 100%;
            border-radius: 5px;
            background: var(--darkgreen);
            transition: transform 0.25s ease-in-out;
        }
    </style>

    <form action="/register" method="POST" enctype="multipart/form-data" class="w-[60%] py-12 min-h-full flex flex-col justify-center">
        {{ csrf_field() }}
        <a href="{{ url('/') }}"><img src="{{ Storage::url("assets/general/logo.png") }}" class="mx-auto h-20 w-auto"></a>
        <h2 class="mt-5 text-center text-title text-secondary font-semibold">Hello!</h2>
        <p class="mt-5 text-center text-name text-secondary font-normal">Sign up to continue</p>

        <div class="mt-10 w-full">
            <div class="switch-wrapper text-center relative flex w-full rounded bg-white shadow-sm">
                <input id="customer" type="radio" name="switch" value="customer" checked>
                <input id="seller" type="radio" name="switch" value="seller">
                <label for="customer" class="py-1 text-primary text-name font-medium">Customer</label>
                <label for="seller" class="py-1 text-primary text-name font-medium">Seller</label>
                <span class="highlighter"></span>
            </div>
    
            <div class="mt-5 flex flex-col justify-center items-center w-full gap-5">
                <label for="profile_picture" class="rounded-full bg-white color-white cursor-pointer w-36 h-36 text-center flex items-center justify-center text-secondary text-4xl font-semibold">+</label>
                <input type="file" class="hidden w-1/5" id="profile_picture" name="profile_picture" accept="image/*">
            </div>
    
            <div class="mt-10">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="input-form" id="email" name="email" placeholder="Email">
            </div>
    
            <div class="mt-5">
                <label for="username" class="form-label">Username</label>
                <div class="mt-2">
                    <input type="text" class="input-form" id="username" name="username" placeholder="Username">
                </div>
            </div>
    
            <div class="mt-5">
                <label for="fullname" class="form-label">Full Name</label>
                <div class="mt-2">
                    <input type="text" class="input-form" id="fullname" name="fullname" placeholder="Full Name">
                </div>
            </div>
    
            <div class="mt-5">
                <label for="phone_number" class="form-label">Phone Number</label>
                <div class="mt-2">
                    <input type="number" class="input-form" id="phone_number" name="phone_number" placeholder="Phone Number">
                </div>
            </div>
    
            <div class="mt-5">
                <label for="password" class="form-label">Password</label>
                <div id="password_div" class="relative flex items-center w-full h-fit">
                    <input type="password" class="input-form" id="password" name="password" placeholder="Password">
                    <div class="absolute right-[10px] top-1/2 -translate-y-1/3" onclick="password()">
                        <i id="eye-icon-pw" class="fa fa-eye-slash"></i>
                    </div>
                </div>
            </div>
    
            <div class="mt-5">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <div id="confirm_password_div" class="relative flex items-center w-full h-fit">
                    <input type="password" class="input-form" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                    <div class="absolute right-[10px] top-1/2 -translate-y-1/3" style="right: 10px;" onclick="confirm_password()">
                        <i id="eye-icon-conf" class="fa fa-eye-slash"></i>
                    </div>
                </div>
            </div>
    
            <div class="mt-5">
                <label for="gender" class="mr-2 form-label">Gender</label>
                <input type="radio" name="gender" value="male" class="mr-2 text-name font-medium text-secondary">Male
                <input type="radio" name="gender" value="female" class="mx-2 text-name font-medium text-secondary">Female
            </div>
    
            <div class="mt-5">
                <label for="dob" class="form-label">Date of Birth</label><br>
                <input type="date" name="dob" id="dob"  class="input-form">
            </div>
    
            @if ($errors->any())
                <div class="text-center text-red-500 text-name font-semibold mt-10">
                    {{$errors->first()}}
                </div>
            @endif
    
            <div class="mt-10 flex justify-center w-full">
                <button type="submit" class="w-full btn-primary">Sign Up</button>
            </div>
    
            <p class="mt-20 text-center text-name text-secondary font-normal">
                Already have an account?
                <a href="{{ route('login') }}" class="text-primary text-name font-medium hover:text-secondary hover:underline" type="button">Sign In</a>
            </p>
        </div>
    </form>
    <script>
        var flag_conf = 0;
        function confirm_password(){
            if(flag_conf == 1){
                document.getElementById('password_confirmation').type='password';
                document.getElementById('eye-icon').classList.remove('fa-eye');
                document.getElementById('eye-icon').classList.add('fa-eye-slash');
                flag_conf = 0;
            } else {
                document.getElementById('password_confirmation').type='text';
                document.getElementById('eye-icon').classList.remove('fa-eye-slash');
                document.getElementById('eye-icon').classList.add('fa-eye');
                flag_conf = 1;
            }
        }
    </script>
@endsection