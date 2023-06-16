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
            <div class="flex flex-col gap-5 w-full">
                <div class="w-full flex flex-row justify-between items-baseline">
                    <h1 class="text-title text-secondary font-semibold">Popular Menu for The Week</h1>
                    <a href="{{ url('/menu') }}" class="mt-auto text-dgray font-light text-name hover:underline">See More</a>
                </div>
                <div class="flex h-max overflow-x-scroll hide-scroll-bar">
                    <div class="flex gap-5 p-1">
                        @foreach ($menus as $m)
                            <div class="w-80 h-[580px] rounded bg-white shadow-md overflow-hidden">
                                <div>
                                    <a href="/menu/detail/{{ $m->id }}">
                                        <img class="" src="{{ Storage::url("profile/menu/".$m->profile_menu) }}"/>
                                    </a>
                                </div>
                                <div class="flex flex-col gap-5 p-5">
                                    <div class="flex justify-between h-auto">
                                        <div class="max-w-[65%] text-secondary font-semibold text-heading">
                                            {{ $m->name }}
                                        </div>
                                        <div>
                                            <i class="fa fa-star" style="color: #E39D36"></i>
                                            <?php
                                                $total_rating = 0;
                                                $total_review = 0;
                                                foreach ($m->review as $rw) {
                                                    $total_rating = $total_rating + $rw->rating;
                                                    $total_review++;
                                                }
                                                if ($total_review < 1) {
                                                    ?>
                                                    <span class="text-secondary font-normal text-name">No Rating</span>
                                                    <?php
                                                } else {
                                                    $total_rating = $total_rating / $total_review;
                                                    ?>
                                                    <span class="text-secondary font-semibold text-name">
                                                        {{ number_format((float)$total_rating, 2, '.', '') }}
                                                    </span>
                                                    <sub>/5</sub>
                                                    <?php
                                                }
                                            ?>
                                        </div>

                                    </div>

                                    <div class="">
                                        <div id="" class="text-primary font-regular text-sm">
                                            By {{ $m->seller->name }}
                                        </div>

                                        <div id=""  class="text-primary font-semibold text-base">
                                            @foreach ($m->menu_category as $index => $mc)
                                                {{$mc->category->name}}
                                                @if (!$loop->last)
                                                    |
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="flex justify-between items-center">
                                        <div>
                                            <div class="text-primary font-regular text-sm">Price</div>
                                            <div id="" class="text-primary font-semibold text-base">
                                                Rp{{ number_format($m->price/1000, 3, '.', ',') }},00
                                            </div>
                                        </div>
                                        <div class="border-l-2 border-gray-400 pl-2">
                                            <div class="text-primary font-regular text-sm">Ordered</div>
                                            <div id="" class="text-primary font-semibold text-base">
                                                {{$m->ordered}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="ml-auto">
                                        @if (!Auth::user())
                                        <a href="/login" class="bg-secondary rounded-full h-12 w-12 flex items-center justify-center text-white font-medium text-4xl hover:shadow-secondary  hover:shadow-md">+</a>
                                        @elseif (Auth::user()->role == 'customer')
                                            @php $countWishlist = 0 @endphp
                                            @if(Auth::check())
                                                @php $countWishlist = App\Models\wishlist::countWishlist($m['id']) @endphp
                                            @endif
                                            <div class="flex gap-5 items-center ">
                                                <a href="#" data-menuid="{{$m->id}}" class="update_wishlist">
                                                    @if ($countWishlist > 0)
                                                        <i class="fas fa-heart fa-2x"></i>
                                                    @else
                                                        <i class="far fa-heart fa-2x"></i>
                                                    @endif
                                                </a>

                                                <button class="bg-secondary rounded-full h-10 w-10 flex items-center justify-center text-white font-medium text-4xl hover:shadow-secondary hover:shadow-md" type="submit" >+</button>
                                            </div>
                                        @else
                                        <button class="flex w-full justify-center rounded bg-secondary px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:scale-105 hover:shadow-md transition-all duration-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary" type="submit" name="action" value="Edit">Edit</button>
                                        <button class="font-medium text-secondary px-5" type="submit" name="action" value="Delete">Delete</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- About Us -->
            <div class="w-full flex justify-between">
                <img src="{{ Storage::url('assets/home/food-photo.png') }}" alt="food image" class="mb-auto w-[35%]">
                <div class="flex flex-col items-end justify-between w-[60%] gap-10">
                    <div>
                        <div class="h-full flex flex-col gap-5 w-full items-start">
                            <h1 id="about-us" class="text-title text-secondary font-semibold">About Us</h1>
                            <p class="text-heading text-secondary font-normal">We are Flavour Palette, an online catering service that allows you to enjoy quality meals every day. We have more than 100 professional catering kitchens that are ready to cook your favorite menu, from healthy, fusion, oriental, to traditional dishes. You can order daily catering menu through Flavour Palette app with affordable price and flexible booking. You can also freely customize your catering menu according to your taste and schedule.</p>
                            <a href="{{ url('/menu') }}" class="btn-secondary">View Menu</a>
                        </div>
                    </div >
                    <div class="flex justify-between items-center">
                        <img src="{{ Storage::url('assets/home/delivery-photo.png') }}" alt="delivery image" class="w-[40%] h-full">
                        <img src="{{ Storage::url('assets/home/katsu-photo.png') }}" alt="katsu image" class="w-[60%] h-full">
                    </div>
                </div>
            </div>

            <!-- Our Partners -->
            <div class="flex flex-col gap-5">
                <div>
                    <h1 class="text-title text-secondary font-semibold">Meet Our Partners</h1>
                </div>
                <div>
                    <div class="flex flex-wrap justify-between h-[350px] gap-y-5">
                        @foreach ($sellers as $seller)
                            <div class="w-[13.5%] h-1/2 flex justify-center items-center">
                                <img src="{{ Storage::url('profile/user/'.$seller->user->profile_picture) }}" alt="seller image" class="w-fit h-fit">
                            </div>
                        @endforeach
                        <div class="w-[13.5%] bg-orange h-1/2 flex justify-center items-center"></div>
                        <div class="w-[13.5%] bg-orange h-1/2 flex justify-center items-center"></div>
                        <div class="w-[13.5%] bg-orange h-1/2 flex justify-center items-center"></div>
                        <div class="w-[13.5%] bg-orange h-1/2 flex justify-center items-center"></div>
                        <div class="w-[13.5%] bg-orange h-1/2 flex justify-center items-center"></div>
                        <div class="w-[13.5%] bg-orange h-1/2 flex justify-center items-center"></div>
                        <div class="w-[13.5%] bg-orange h-1/2 flex justify-center items-center"></div>
                        <div class="w-[13.5%] bg-orange h-1/2 flex justify-center items-center"></div>
                        <div class="w-[13.5%] bg-orange h-1/2 flex justify-center items-center"></div>
                        <div class="w-[13.5%] bg-orange h-1/2 flex justify-center items-center"></div>
                        <div class="w-[13.5%] bg-orange h-1/2 flex justify-center items-center"></div>
                        <div class="w-[13.5%] bg-orange h-1/2 flex justify-center items-center"></div>
                        <div class="w-[13.5%] bg-orange h-1/2 flex justify-center items-center"></div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection