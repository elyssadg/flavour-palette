@extends('master.layout')

@section('title')
    Home
@endsection

@section('content')
    <section class="relative h-screen w-screen">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-[60%] w-[65%] h-max px-24 py-12 flex flex-col gap-10 items-center justify-center z-20 rounded bg-white bg-opacity-70 text-center text-primary shadow-md">
            @if (Auth::user() && Auth::user()->role == 'seller')
                <h1 class="text-title font-bold drop-shadow-md">Increase Your Sales with Flavour Palette</h1>
                <p class="text-secondary text-heading font-medium">Welcome to our online catering website! We provide an easy and convenient way for you to showcase and sell your delicious food to a wide audience. Our platform offers a simple and user-friendly interface for you to manage your orders and reach new customers. Join us and become part of our growing community of satisfied sellers and customers. Start selling on our website today and let us help you grow your business!</p>
            @else
                <h1 class="text-title font-bold drop-shadow-md">Savor with Ease Delicious Meals for All</h1>
                <p class="text-secondary text-heading font-medium">Welcome to our online catering website! We provide a wide variety of delicious food that can be easily enjoyed by everyone. We offer a wide selection of food that can satisfy your taste buds. We believe that good food doesn't have to be difficult to enjoy. Therefore, we provide easy and fast online catering services so you can enjoy delicious food anytime, anywhere.</p>
                <a href="{{ url('/menu') }}" class="btn-primary">View Menu</a>
            @endif
        </div>
        <div class="absolute inset-0 z-10">
            <img src="{{ Storage::url('assets/general/header-photo.png') }}" alt="" class="w-full h-screen object-cover">
        </div>
    </section>

    <div class="w-[85%] h-max mx-auto my-20 flex flex-col gap-20">
        @if (!Auth::user() || Auth::user() && Auth::user()->role == 'customer')
            <div class="flex w-full h-max justify-between items-center">
                <div class="h-full flex flex-col gap-10 w-[45%]">
                    <h1 class="text-secondary font-semibold text-title text-left">Revolutionize Your Daily Meals</h1>
                    <p class="text-secondary text-heading font-normal  text-left">Are you tired of the same boring meals every day? Say goodbye to mealtime monotony with our catering subscription service! Our platform allows you to customize your daily meals according to your dietary preferences and taste buds.</p>
                    <a href="{{ url('/menu') }}" class="btn-secondary">View Menu</a>
                </div>
                <img class="w-[50%] h-auto" src="{{ Storage::url('assets/home/first-image.png') }}" alt="">
            </div>
        @endif

        <img class="w-full h-auto shadow-md" src="{{ Storage::url('assets/home/second-image.png') }}" alt="">

        @if (!Auth::user() || Auth::user() && Auth::user()->role == 'customer')
            <!-- Popular Menu -->
            <!-- About Us -->
            <div class="w-full flex justify-between">
                <div>
                    <img src="{{Storage::url('assets/home/food-photo.png')}}" alt="" class="mb-auto w-auto">
                </div>

                <div class="flex flex-col items-end justify-between w-3/5 gap-16">
                    <div>
                        <div class="h-full flex flex-col gap-10 w-full items-start">
                            <h1 id="about-us" class="text-title text-secondary font-semibold">About Us</h1>
                            <p class="text-heading text-secondary font-normal">We are Flavour Palette, an online catering service that allows you to enjoy quality meals every day. We have more than 100 professional catering kitchens that are ready to cook your favorite menu, from healthy, fusion, oriental, to traditional dishes. You can order daily catering menu through Flavour Palette app with affordable price and flexible booking. You can also freely customize your catering menu according to your taste and schedule.</p>
                            <a href="{{ url('/menu') }}" class="btn-secondary">View Menu</a>
                        </div>
                    </div >
                    <div class="flex justify-between items-center w-[99%]">
                        <img src="{{Storage::url('assets/delivery-photo.png')}}" alt="" class="h-full">
                        <img src="{{Storage::url('assets/katsu-photo.png')}}" alt="" class="h-full">
                    </div>
                </div>
            </div>
            <!-- Our Partners -->
        @endif
    </div>
@endsection