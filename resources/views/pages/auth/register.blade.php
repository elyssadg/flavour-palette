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

    <form action="/register" method="POST" enctype="multipart/form-data" id="register-form" class="w-[60%] py-12 min-h-full flex flex-col justify-center">
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
                <label for="profile_picture" id="profile-lbl" class="rounded-full border border-dgray bg-white color-white cursor-pointer w-36 h-36 text-center flex items-center justify-center text-subname text-dgray font-medium">Add Picture</label>
                <input type="file" class="hidden w-36 h-36" id="profile_picture" name="profile_picture" accept="image/*">
            </div>

            <div class="mt-10">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="input-form" id="email" name="email" placeholder="Email">
            </div>

            <div id="form-content">
                <div class="mt-5">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="input-form" id="username" name="username" placeholder="Username">
                </div>
                <div class="mt-5">
                    <label for="fullname" class="form-label">Full Name</label>
                    <input type="text" class="input-form" id="fullname" name="fullname" placeholder="Full Name">
                </div>
                <div class="mt-5">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="number" class="input-form" id="phone_number" name="phone_number" placeholder="Phone Number">
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
                <div class="mt-5 form-label">
                    <label for="gender" class="mr-2 form-label">Gender</label>
                    <input type="radio" name="gender" value="male" class="mr-2">Male
                    <input type="radio" name="gender" value="female" class="mx-2">Female
                </div>
                <div class="mt-5">
                    <label for="dob" class="form-label">Date of Birth</label><br>
                    <input type="date" name="dob" id="dob"  class="input-form">
                </div>
            </div>
    
            <div id="form-error" class="text-center text-red-500 text-name font-semibold mt-10"></div>
    
            <div class="mt-10 flex justify-center w-full">
                <button type="submit" class="w-full btn-primary">Sign Up</button>
            </div>
    
            <p class="mt-20 text-center text-name text-secondary font-normal">
                Already have an account?
                <a href="{{ url('/login') }}" class="text-primary text-name font-medium hover:text-secondary hover:underline" type="button">Sign In</a>
            </p>
        </div>
    </form>
    <script>
        var flagConf = 0;
        function confirm_password(){
            if(flagConf == 1){
                document.getElementById('password_confirmation').type='password';
                document.getElementById('eye-icon').classList.remove('fa-eye');
                document.getElementById('eye-icon').classList.add('fa-eye-slash');
                flagConf = 0;
            } else {
                document.getElementById('password_confirmation').type='text';
                document.getElementById('eye-icon').classList.remove('fa-eye-slash');
                document.getElementById('eye-icon').classList.add('fa-eye');
                flagConf = 1;
            }
        }

        $(document).ready(function() {
            $("#customer").on("change", function() {
                document.getElementById('form-error').innerHTML = '';
                $('#form-content').html(`
                    <div class="mt-5">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="input-form" id="username" name="username" placeholder="Username">
                    </div>
                    <div class="mt-5">
                        <label for="fullname" class="form-label">Full Name</label>
                        <input type="text" class="input-form" id="fullname" name="fullname" placeholder="Full Name">
                    </div>
                    <div class="mt-5">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="number" class="input-form" id="phone_number" name="phone_number" placeholder="Phone Number">
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
                        <input type="radio" name="gender" value="male" class="mr-2 text-name font-medium text-secondary">Male>
                        <input type="radio" name="gender" value="female" class="mx-2 text-name font-medium text-secondary">Female>
                    </div>
                    <div class="mt-5">
                        <label for="dob" class="form-label">Date of Birth</label><br>
                        <input type="date" name="dob" id="dob"  class="input-form">
                    </div>
                `);
            });

            $("#seller").on("change", function() {
                document.getElementById('form-error').innerHTML = '';
                $('#form-content').html(`
                    <div class="mt-5">
                        <label for="fullname" class="form-label">Full Name</label>
                        <input type="text" class="input-form" id="fullname" name="fullname" placeholder="Full Name">
                    </div>
                    <div class="mt-5">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="number" class="input-form" id="phone_number" name="phone_number" placeholder="Phone Number">
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
                        <label for="catering_name" class="form-label">Catering Name</label>
                        <input type="text" class="input-form" id="catering_name" name="catering_name" placeholder="Catering Name">
                    </div>

                    <div class="mt-5">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="input-form" name="description" id="description" placeholder="Catering Description"></textarea>
                    </div>

                    <div class="mt-5">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="input-form" name="address" id="address" placeholder="Catering Address"></textarea>
                    </div>

                    <div class="mt-5">
                        <label class="form-label">Working Hour</label>
                        <div class="w-full flex items-center justify-center">
                            <input id="opening_hour" class="input-form w-[47.5%]" type="time" name="opening_hour">
                            <hr class="mt-3 w-[5%] h-1 border-secondary">
                            <input id="closing_hour" class="input-form w-[47.5%]" type="time" name="closing_hour">
                        </div>
                    </div>

                    <div class="mt-5">
                        <div class="mt-2">
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
                                    <input type="file" id="halal_certification" name="halal_certification" class="hidden">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5">
                        <div class="mt-2">
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
                                    <input type="file" id="business_permit" name="business_permit" class="hidden">
                                </label>
                            </div>
                        </div>
                    </div>
                `);
            });

            $('#register-form').submit(function(e) {
                e.preventDefault();
                var form_data = new FormData(this);
                $.ajax({
                    url: '/register',
                    method: 'POST',
                    data: form_data,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.error) {
                            $('#form-error').text(response.error_message).show();
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

        const fileInput = document.getElementById("profile_picture");
        const fileLabel = document.getElementById("profile-lbl");
        fileInput.addEventListener('change', function() {
            if (fileInput.value === "") {
                fileLabel.classList.remove('border-orange');
                fileLabel.classList.add('border-dgray');
                fileLabel.classList.remove('text-orange');
                fileLabel.classList.add('text-dgray');
                fileLabel.innerHTML = "Add Picture";
            } else {
                fileLabel.classList.remove('border-dgray');
                fileLabel.classList.add('border-orange');
                fileLabel.classList.remove('text-dgray');
                fileLabel.classList.add('text-secondary');
                fileLabel.innerHTML = fileInput.files[0].name;
            }
        });
    </script>
@endsection