@extends('master.auth_layout')

@section('title')
    Login
@endsection

@section('content')
    <form action="/login" method="POST" class="w-[60%] py-12 min-h-full flex flex-col justify-center rounded">
        {{ csrf_field() }}
        <a href="{{ url('/') }}"><img src="{{ Storage::url("assets/general/logo.png") }}" class="mx-auto h-20 w-auto"></a>
        <h2 class="mt-5 text-center text-title text-secondary font-semibold">Welcome Back!</h2>
        <p class="mt-5 text-center text-name text-secondary font-normal">Sign in to continue</p>

        <div class="mt-10 w-[full">
            <div>
                <label for="email" class="form-label">Email or Username</label>
                <input type="email" id="email" name="email" required class="input-form" placeholder="Email or Username" value="{{ Cookie::get('email_cookie') !== null ? Cookie::get('email_cookie') : '' }}">
            </div>
            <div class="mt-5">
                <label for="password" class="form-label">Password</label>
                <div class="relative flex items-center w-full h-fit">
                    <input type="password" required class="input-form" id="password" name="password" placeholder="Password">
                    <div class="absolute top-1/2 right-[10px] -translate-y-1/3 cursor-pointer" onclick="show_and_hide()">
                        <i id="eye-icon" class="fa fa-eye-slash"></i>
                    </div>
                </div>
            </div>

            @if ($errors->any())
                <div class="text-center text-red-500 text-name font-semibold mt-10">
                    {{$errors->first()}}
                </div>
            @endif

            <div class="mt-10 flex items-center justify-center gap-3">
                <input class="rounded bg-primary" type="checkbox" id="remember" name="remember">
                <label class="text-secondary text-name font-medium" for="remember">Remember Me</label>
            </div>

            <div class="mt-5 flex justify-center w-full">
                <button type="submit" class="w-full btn-primary">Sign In</button>
            </div>

            <p class="mt-20 text-center text-name text-secondary font-normal">
                Don’t have an account?
                <a href="{{ route('register.user') }}" class="text-primary text-name font-medium hover:text-secondary hover:underline" type="button">Sign Up</a>
            </p>
        </div>
    </form>
@endsection