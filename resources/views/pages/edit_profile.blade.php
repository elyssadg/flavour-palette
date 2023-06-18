@extends('master.layout')

@section('title')
    Profile
@endsection

@section('content')
    <img class="fixed top-0 left-0 w-full h-full object-cover -z-10" src="{{ Storage::url("assets/general/header-photo.png") }}" alt="">
    <div class="py-20 flex flex-col gap-5 items-center justify-center">  
        <div class="p-10 bg-white rounded shadow w-1/2 h-auto border border-primary border-opacity-20">
            <form action="/profile/edit" id="account-form" class="w-full flex flex-col gap-5" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="title">Account Detail</div>
                <div>
                    <div class="flex flex-col items-center w-full gap-5">
                        <label for="profile_picture" id="profile-lbl" class="rounded-full border border-dgray bg-white color-white cursor-pointer w-28 h-28 text-center flex items-center justify-center text-subname text-dgray font-medium">Edit Picture</label>
                        <input type="file" class="hidden w-36 h-36" id="profile_picture" name="profile_picture" accept="image/*" value="{{ Auth::user()->profile_picture }}">
                        <label for="profile_picture" class="form-label">{{ Auth::user()->profile_picture }}</label>
                    </div>
                </div>

                <div>
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="input-form"  id="email" name="email" placeholder="Email" value="{{ Auth::user()->email }}">
                </div>

                @if (Auth::user()->role == 'customer')
                    <div>
                        <label for="username" class="form-label">Username</label>
                        <div>
                            <input type="text" class="input-form" id="username" name="username" placeholder="Username" value="{{ Auth::user()->customer->username }}">
                        </div>
                    </div>
                @endif

                <div>
                    <label for="fullname" class="form-label">Full Name</label>
                    <div>
                        <input type="text" class="input-form" id="fullname" name="fullname" placeholder="Full Name" value="{{ Auth::user()->fullname }}">
                    </div>
                </div>

                <div>
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="number" class="input-form" id="phone_number" name="phone_number" placeholder="Phone Number" value="{{ Auth::user()->phone_number }}">
                </div>

                @if (Auth::user()->role == 'customer')
                    <div>
                        <label for="gender" class="mr-2 form-label">Gender</label>
                        @if (Auth::user()->customer->gender == 'male')
                            <input type="radio" name="gender" value="male" class="mr-2 form-label" checked>Male
                            <input type="radio" name="gender" value="female" class="mx-2 form-label">Female
                        @else
                            <input type="radio" name="gender" value="male" class="mr-2 text-sm font-medium leading-6 text-gray-900">Male
                            <input type="radio" name="gender" value="female" class="mr-2 text-sm font-medium leading-6 text-gray-900" checked>Female
                        @endif
                    </div>
                    <div>
                        <label for="dob" class="form-label">Date of Birth</label><br>
                        <input type="date" name="dob" id="dob"  class="input-form" value="{{ Auth::user()->customer->dob }}">
                    </div>
                @endif

                <div id="account-error" class="text-center text-red-500 text-name font-semibold mt-5"></div>

                <div class="flex justify-center w-full">
                    <button type="submit" class="w-full btn-primary">Save</button>
                </div>
            </form>
        </div>
        <div class="p-10 bg-white rounded shadow w-1/2 h-auto border border-primary border-opacity-20">
            <form action="/profile/edit/password" id="password-form" class="flex flex-col gap-5 w-full" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="title">Change Password</div>
                <div>
                    <label for="old_password" class="form-label">Old Password</label>
                    <div id="old_password_div" class="relative flex items-center w-full h-fit">
                        <input type="old_password" class="input-form" id="old_password" name="old_password" placeholder="Old Password">
                        <div class="absolute right-[10px] top-1/2 -translate-y-1/3" onclick="old_password()">
                            <i id="eye-icon-pw" class="fa fa-eye-slash"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <label for="new_password" class="form-label">New Password</label>
                    <div id="new_password_div" class="relative flex items-center w-full h-fit">
                        <input type="new_password" class="input-form" id="new_password" name="new_password" placeholder="New Password">
                        <div class="absolute right-[10px] top-1/2 -translate-y-1/3" onclick="new_password()">
                            <i id="eye-icon-pw" class="fa fa-eye-slash"></i>
                        </div>
                    </div>
                </div>
                <div>
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <div id="confirm_password_div" class="relative flex items-center w-full h-fit">
                        <input type="password" class="input-form" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                        <div class="absolute right-[10px] top-1/2 -translate-y-1/3" style="right: 10px;" onclick="confirm_password()">
                            <i id="eye-icon-conf" class="fa fa-eye-slash"></i>
                        </div>
                    </div>
                </div>

                <div id="password-error" class="text-center text-red-500 text-name font-semibold mt-5"></div>
                
                <button type="submit" class="btn-primary">Save</button>
            </form>
        </div>

        @if (Auth::user()->role == 'seller')
            <div class="p-10 bg-white rounded shadow w-1/2 h-auto border border-primary border-opacity-20">
                <form action="/profile/edit/catering" id="catering-form" class="flex flex-col gap-5 w-full" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="title">Catering Detail</div>
                    <div>
                        <label for="catering_name" class="form-label">Catering Name</label>
                        <input type="text" class="input-form" id="catering_name" name="catering_name" placeholder="Catering Name" value="{{ Auth::user()->seller->name }}">
                    </div>

                    <div>
                        <label for="description" class="form-label">Description</label>
                        <textarea class="input-form" name="description" id="description">{{ Auth::user()->seller->description }}</textarea>
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium leading-6 text-gray-900">Address</label>
                        <textarea class="input-form" name="address" id="address">{{ Auth::user()->seller->address }}</textarea>
                    </div>

                    <div>
                        <label class="form-label">Working Hour</label>
                        <div class="w-full flex items-center justify-center">
                            <input id="opening_hour" class="input-form w-[47.5%]" type="time" name="opening_hour" value="{{ Auth::user()->seller->opening_hour }}">
                            <hr class="mt-3 w-[5%] h-1 border-secondary">
                            <input id="closing_hour" class="input-form w-[47.5%]" type="time" name="closing_hour" value="{{ Auth::user()->seller->closing_hour }}">
                        </div>
                    </div>

                    <div>
                        <label for="halal_certification" class="form-label">Halal Certification</label>
                        <div class="mt-2">
                            <label id="halal-lbl" class="flex justify-center w-full h-28 px-4 transition bg-white border border-dgray border-dashed rounded appearance-none cursor-pointer outline-none">
                                <span class="flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <span class="font-medium text-gray-600">
                                        Click to add file,
                                        <span class="text-blue-600 underline"> browse</span>
                                    </span>
                                </span>
                                <input type="file" id="halal_certification" name="halal_certification" class="hidden" value="{{ Auth::user()->seller->halal_certification }}">
                            </label>
                        </div>
                    </div>

                    <div>
                        <label for="business_permit" class="form-label">Business Permit</label>
                        <div class="mt-2">
                            <label id="business-lbl" class="flex justify-center w-full h-28 px-4 transition bg-white border border-dgray border-dashed rounded appearance-none cursor-pointer outline-none">
                                <span class="flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <span class="font-medium text-gray-600">
                                        Click to add file,
                                        <span class="text-blue-600 underline"> browse</span>
                                    </span>
                                </span>
                                <input type="file" id="business_permit" name="business_permit" class="hidden" value="{{ Auth::user()->seller->business_permit }}">
                            </label>
                        </div>
                    </div>

                    <div id="catering-error" class="text-center text-red-500 text-name font-semibold mt-5"></div>

                    <button type="submit" class="btn-primary">Save</button>
                </form>
                </div>
        @endif
    </div>

    <script>
        var flagOld = 0;
        function old_password(){
            if(flagOld == 1){
                document.getElementById('old_password').type = 'password';
                document.getElementById('eye-icon').classList.remove('fa-eye');
                document.getElementById('eye-icon').classList.add('fa-eye-slash');
                flagOld = 0;
            } else {
                document.getElementById('new_password_confirmation').type = 'text';
                document.getElementById('eye-icon').classList.remove('fa-eye-slash');
                document.getElementById('eye-icon').classList.add('fa-eye');
                flagOld = 1;
            }
        }

        var flagNew = 0;
        function new_password(){
            if(flagNew == 1){
                document.getElementById('password_confirmation').type = 'password';
                document.getElementById('eye-icon').classList.remove('fa-eye');
                document.getElementById('eye-icon').classList.add('fa-eye-slash');
                flagNew = 0;
            } else {
                document.getElementById('password_confirmation').type = 'text';
                document.getElementById('eye-icon').classList.remove('fa-eye-slash');
                document.getElementById('eye-icon').classList.add('fa-eye');
                flagNew = 1;
            }
        }

        var flagConf = 0;
        function confirm_password(){
            if(flagConf == 1){
                document.getElementById('password_confirmation').type = 'password';
                document.getElementById('eye-icon').classList.remove('fa-eye');
                document.getElementById('eye-icon').classList.add('fa-eye-slash');
                flagConf = 0;
            } else {
                document.getElementById('password_confirmation').type = 'text';
                document.getElementById('eye-icon').classList.remove('fa-eye-slash');
                document.getElementById('eye-icon').classList.add('fa-eye');
                flagConf = 1;
            }
        }

        $(document).ready(function() {
            $('#account-form').submit(function(e) {
                e.preventDefault();
                var form_data = new FormData(this);
                $.ajax({
                    url: '/profile/edit/account',
                    method: 'POST',
                    data: form_data,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.error) {
                            $('#account-error').text(response.error_message).show();
                        } else {
                            window.location.href = response.redirect;
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });

            $('#password-form').submit(function(e) {
                e.preventDefault();
                var form_data = new FormData(this);
                $.ajax({
                    url: '/profile/edit/password',
                    method: 'POST',
                    data: form_data,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.error) {
                            $('#password-error').text(response.error_message).show();
                        } else {
                            window.location.href = response.redirect;
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });

            $('#catering-form').submit(function(e) {
                e.preventDefault();
                var form_data = new FormData(this);
                $.ajax({
                    url: '/profile/edit/catering',
                    method: 'POST',
                    data: form_data,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.error) {
                            $('#catering-error').text(response.error_message).show();
                        } else {
                            window.location.href = response.redirect;
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endsection


