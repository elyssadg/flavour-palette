@extends('master.auth_layout')

@section('title')
    Register Catering
@endsection

@section('content')
    <form action="{{ route('register.catering') }}" method="POST" enctype="multipart/form-data" class="w-[60%] py-12 min-h-full flex flex-col justify-center">
        {{ csrf_field() }}
        <a href="{{ url('/') }}"><img src="{{ Storage::url("assets/general/logo.png") }}" class="mx-auto h-20 w-auto"></a>
        <h2 class="mt-5 text-center text-title text-secondary font-semibold">Hello, {{ $seller->username }}</h2>
        <p class="mt-5 text-center text-name text-secondary font-normal">Please input your catering detail</p>

        <div class="mt-10 w-full">
            <div>
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
                <label for="working_hour" class="form-label">Working Hour</label>
                <div class="flex items-center justify-center w-full">
                    <input class="w-1/2 form-input" type="time" name="opening_hour" id="opening_hour">
                    <label>-</label>
                    <input class="w-1/2 form-input" type="time" name="closing_hour" id="closing_hour">
                </div>
            </div>

            <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.4/dist/flowbite.min.css" />

            <div class="mt-5">
                <div class="mt-2">
                    <label for="halal_certification" class="form-label">Halal Certification</label>
                    <div class="mt-2">
                        <label class="flex justify-center w-full h-40 px-4 transition bg-white border-2 border-gray-300 border-dashed rounded appearance-none cursor-pointer hover:border-gray-400 focus:outline-none">
                            <span class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <span class="font-medium text-gray-600">
                                    Drop files to Attach, or
                                    <span class="text-blue-600 underline">browse</span>
                                </span>
                            </span>
                            <input type="file" id="halal_certification" name="halal_certification" class="hidden">
                        </label>
                        {{-- <input type="file" class="" id="halal_certification" name="halal_certification" style="width: 20vw; border: 0px solid rgba(128, 128, 128, 0.418);}"> --}}
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <div class="mt-2">
                    <label for="business_permit" class="form-label">Business Permit</label>
                    <div class="mt-2">
                        {{-- <img class="" src="{{Storage::url("assets/profile/".$user->image)}}" style="width:30px;height:30px;"/> --}}
                        <label class="flex justify-center w-full h-40 px-4 transition bg-white border-2 border-gray-300 border-dashed rounded appearance-none cursor-pointer hover:border-gray-400 focus:outline-none">
                            <span class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <span class="font-medium text-gray-600">
                                    Drop files to Attach, or
                                    <span class="text-blue-600 underline">browse</span>
                                </span>
                            </span>
                            <input type="file" id="business_permit" name="business_permit" class="hidden">
                        </label>
                    </div>
                </div>
            </div>


            @if ($errors->any())
                <div class="text-red-600 font-bold mt-3 text-sm">
                    {{$errors->first()}}
                </div>
            @endif

            <div class="mt-10 flex justify-center w-full">
                <div class="w-full btn-primary">
                    <button type="submit" >Submit</button>
                </div>
            </div>

            <div>
                <p class="mt-5">
                    <a class="text-center text-name text-secondary font-normal hover:text-primary" href="javascript:void(0);" onclick="goBack()">Back to Previous Page</a>
                </p>
            </div>
        </div>
    </form>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
@endsection