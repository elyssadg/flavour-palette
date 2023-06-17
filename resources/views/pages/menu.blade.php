@extends('master.layout')

@section('title')
    Menu
@endsection

@section('content')
    <style>
        .indicator-container{
            display: flex;
            flex-direction: column;
            position: absolute;
            top: 50%;
            left: 5%;
            transform: translateX(-50%);
            z-index: 50;
            transition: all 0.3s;
        }

        .indicator-container input[type="radio"] {
            display: none;
        }

        .indicator-container label {
            display: inline-block;
            width: 1rem;
            height: 1rem;
            border-radius: 50%;
            margin: 10px 5px;
            cursor: pointer;
        }

        .indicator-container input[type="radio"]:not(:checked)+label {
            background-color: rgba(255, 255, 255, 0.411);
        }

        .indicator-container input[type="radio"]:checked+label {
            border: 1px solid white;
            background-color: white;
        }

        .slide {
            width: 100%;
            height: 100%;
            background-position: center;
            background-size: cover;
            transition: display 1s, transform 1s;
            display: none;
        }

        .active-slide{
            display: block;
        }
    </style>

    <div>
        @if (Auth::user() && Auth::user()->role == 'seller')
            <div class="px-20 mt-10">
                <div>
                    <h1 class="text-4xl text-primary font-semibold mb-5">Your Catering Menus</h1>
                </div>
                <div style="display: ">
                    <form id="my-form" action="/catalog">
                        <input type="hidden" name="date_btn" value="{{ $selectedDate }}">
                        <input type="date" id="date" name="date" required class="block w-full rounded border-0 py-1.5 px-3 text-primary shadow-sm ring-1 ring-inset ring-dgray placeholder:text-dgray focus:ring-2 focus:ring-inset focus:ring-orange sm:text-sm sm:leading-6">
                    </form>
                </div>
            </div>
        @else
            <!-- Carousel -->
            <div class="carousel-background flex w-screen overflow-x-hidden">
                <div class="slide slide-1 w-full">
                    <img src="{{ Storage::url('slider/slide-1.png') }}" alt="slide 1" class="w-full">
                </div>
                <div class="slide slide-2 w-full">
                    <img src="{{ Storage::url('slider/slide-2.png') }}" alt="slide 2" class="w-full">
                </div>
                <div class="slide slide-3 w-full">
                    <img src="{{ Storage::url('slider/slide-3.png') }}" alt="slide 3" class="w-full">
                </div>
            </div>
            <div class="indicator-container">
                <input type="radio" name="carousel-indicator" id="indicator-1" class="page-indicator" checked>
                <label for="indicator-1" class="page-indicator-style"></label>

                <input type="radio" name="carousel-indicator" id="indicator-2" class="page-indicator">
                <label for="indicator-2" class="page-indicator-style"></label>

                <input type="radio" name="carousel-indicator" id="indicator-3" class="page-indicator">
                <label for="indicator-3" class="page-indicator-style"></label>
            </div>
            <script>
                var carousel = document.querySelector('.carousel-background');
                var slides = carousel.querySelectorAll('.slide');
                var radioButtons = document.querySelectorAll('.page-indicator');
                var indexNow = 0;
                const slideInterval = 3000;

                function displaySlide(index) {
                    for (var i = 0; i < slides.length; i++) {
                        slides[i].classList.remove('active-slide');
                    }
                    slides[index].classList.add('active-slide');
                }

                function changeSlide() {
                    for (var i = 0; i < radioButtons.length; i++) {
                        if (radioButtons[i].checked) {
                            indexNow = i;
                            displaySlide(indexNow);
                            break;
                        }
                    }
                }

                function nextSlide(){
                    radioButtons[indexNow].checked = false;
                    indexNow++;
                    if (indexNow >= slides.length) {
                        indexNow = 0;
                    }
                    radioButtons[indexNow].checked = true;
                    changeSlide(indexNow);
                }

                function startCarousel() {
                    setInterval(nextSlide, slideInterval);
                }

                displaySlide(indexNow);
                startCarousel();
            </script>
        @endif
    </div>

    <div class="w-[85%] mx-auto my-20 flex flex-col gap-20">
        <!-- Utility Bar -->
        <div class="flex flex-col gap-5">
            @if (Auth::user() && Auth::user()->role == 'customer')
                <div class="bg-primary flex flex-col gap-3 px-5 py-3 rounded">
                    <label class="text-white font-medium">Location</label>
                    <div class="flex items-center gap-2">
                        <img src="{{ Storage::url("assets/icon/location.png") }}" style="width: 20px">
                        <input class="w-full outline-none border-0 bg-transparent text-white text-heading font-medium placeholder:text-white placeholder:font-normal" type="text" name="address" id="address" placeholder="Input Your Address">
                    </div>
                </div>
            @endif

            <div class="flex flex-col items-center w-full gap-5">
                <div class="flex items-center w-full gap-5">
                    <div class="flex justify-between items-center gap-5">
                        <img src="{{ Storage::url("assets/icon/calendar.png") }}" class="w-10">
                        <div class="flex justify-between items-center gap-5">
                            @foreach ($dates as $date)
                                <form action="/menu">
                                    @if ($date == $selectedDate)
                                        <button class="flex gap-2 border-2 border-secondary px-6 py-2 rounded text-heading bg-secondary text-white" type="submit" name="date_btn" value="{{ $date }}">
                                            <div class="font-medium">
                                                {{ $date->format('D') }}
                                            </div>
                                            <div class="font-semibold">
                                                {{ $date->format(' d') }}
                                            </div>
                                        </button>
                                    @else
                                        <button class="flex gap-2 border-2 border-secondary px-6 py-2 rounded text-secondary text-heading hover:bg-secondary hover:text-white" type="submit" name="date_btn" value="{{ $date }}">
                                            <div class="font-medium">
                                                {{ $date->format('D') }}
                                            </div>
                                            <div class="font-semibold">
                                                {{ $date->format(' d') }}
                                            </div>
                                        </button>
                                    @endif
                                </form>
                            @endforeach
                        </div>
                    </div>
                    <div class="border-l-2 border-secondary flex gap-5 pl-5">
                        <div class="cursor-pointer border-2 border-secondary px-4 py-2 rounded">
                            <img id="sort-btn" class="" src="{{ Storage::url("assets/icon/sort.png") }}" style="width: 30px;"/>
                        </div>
                        <div class="cursor-pointer border-2 border-secondary px-4 py-2 rounded">
                            <img id="filter-btn" class="" src="{{ Storage::url("assets/icon/filter.png") }}" style="width: 30px;"/>
                        </div>
                    </div>
                </div>
                <div class="relative flex justify-center items-center w-full h-fit mb-10">
                    <i class="mx-auto absolute fa fa-search left-5"></i>
                    <form class="pl-14 p-3 border-2 border-dgray rounded shadow-md w-full" action="{{ url('/search') }}">
                        <input type="hidden" name="date_btn" value="{{ $selectedDate }}">
                        <input class="form-control w-full outline-none border-0 text-secondary" type="search" placeholder="Enter a keyword" name="search">
                    </form>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap gap-10 justify-center p-1">
            @foreach ($menus as $index => $m)
                <div id="menu-{{ $m->id }}" class="relative w-80 h-fit rounded bg-white shadow-md overflow-hidden cursor-pointer">
                    <div>
                        <img class="" src="{{ Storage::url("profile/menu/".$m->profile_menu) }}"/>
                    </div>
                    <div class="flex flex-col gap-5 p-5">
                        <div class="flex justify-between h-auto">
                            <div class="max-w-[65%] h-20 text-secondary font-semibold text-heading">
                                {{ $m->name }}
                            </div>
                            <div>
                                <i class="fa fa-star" style="color: #E39D36"></i>
                                <?php
                                    $total_rating = 0;
                                    $total_review = 0;
                                ?>
                                @foreach ($m->review as $rw)
                                    <?php
                                        $total_rating = $total_rating + $rw->rating;
                                        $total_review++;
                                    ?>
                                @endforeach
                                <?php
                                    if ($total_review < 1) {
                                        ?>
                                        <span class="text-secondary font-normal text-subname">No Rating</span>
                                        <?php
                                    } else {
                                        $total_rating = $total_rating / $total_review;
                                        ?>
                                        <span class="font-semibold">
                                            {{ number_format((float)$total_rating, 2, '.', '') }}
                                        </span>
                                        <sub>/5</sub>
                                        <?php
                                    }
                                ?>
                            </div>
                        </div>

                        <div class="flex flex-col h-12">
                            <div id="" class="text-secondary text-opacity-50 text-subname font-normal">
                                By {{ $m->seller->name }}
                            </div>
                            <div class="text-secondary font-medium text-name">
                                @foreach ($m->menu_category as $index => $mc)
                                    {{ $mc->category->name }}
                                    @if (!$loop->last)
                                        |
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <div>
                                <div class="text-secondary text-opacity-50 text-name font-normal">Price</div>
                                <div id="" class="text-secondary text-subheading font-semibold">
                                    Rp{{ number_format($m->price/1000, 3, '.', ',') }},00
                                </div>
                            </div>
                            <div class="pl-2 border-l-2 border-secondary border-opacity-20">
                                <div class="text-secondary text-opacity-50 text-name font-normal">Ordered</div>
                                <div id="" class="text-secondary text-subheading font-semibold">
                                    {{ $m->order_detail->count() }}
                                </div>
                            </div>
                        </div>
                        <div class="ml-auto">
                            <div class="flex gap-2 items-center justify-center">
                                @if (Auth::user()->customer->wishlist->where('menu_id', $m->id)->isNotEmpty())
                                    <a href="/wishlist/remove/{{ $m->id }}" class="flex items-center justify-center w-12 h-12 rounded hover:bg-primary hover:bg-opacity-10">
                                        <i class="fas fa-heart fa-2x text-primary"></i>
                                    </a>
                                @else
                                    <a href="/wishlist/add/{{ $m->id }}" class="flex items-center justify-center w-12 h-12 rounded hover:bg-primary hover:bg-opacity-10">
                                        <i class="far fa-heart fa-2x text-primary"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    document.getElementById('menu-{{ $m->id }}').addEventListener('click', function(event) {
                        window.location.href = 'menu/{{ $m->id }}?date_btn={{ $m->available_date }}';
                        event.stopPropagation();
                    });
                </script>
            @endforeach
        </div>
    </div>

    <!-- Layer -->
    <div id="layer-utility" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40"></div>

    <!-- Filter Modal -->
    <div id="filter-modal" class="hidden fixed z-50 p-10 bg-white shadow-md rounded" style="top: 55%; left: 50%; transform: translate(-50%, -50%);">
        <form class="w-full flex flex-col items-start gap-5" action="/menu" enctype="multipart/form-data">
            <label for="filter" class="font-semibold text-heading text-primary">Filter</label>
            <div class="flex flex-col gap-2 w-full">
                <label class="text-secondary font-medium text-subheading">Price Range</label>
                <div class="flex items-center justify-between w-full">
                    <input class="input-form" type="number" name="lowest_price" id="lowest_price" placeholder="Lowest Price">
                    <hr class="mt-3 w-[5%] h-1 border-secondary">
                    <input class="input-form" type="number" name="highest_price" id="highest_price" placeholder="Highest Price">
                </div>
            </div>
            <hr class="w-full h-[2px] bg-secondary bg-opacity-20">
            <div class="flex flex-col items-start gap-3 w-full">
                <label class="text-secondary font-medium text-subheading">Rating</label>
                <div class="flex flex-col gap-2">
                    <div class="flex items-center gap-3 font-medium text-subheading text-secondary">
                        <input type="radio" name="rating" value="all">All
                    </div>
                    <div class="flex items-center gap-3 font-medium text-subheading text-secondary">
                        <input type="radio" name="rating" value="5">5
                    </div>
                    <div class="flex items-center gap-3 font-medium text-subheading text-secondary">
                        <input type="radio" name="rating" value="4">4+
                    </div>
                    <div class="flex items-center gap-3 font-medium text-subheading text-secondary">
                        <input type="radio" name="rating" value="3">3+
                    </div>
                </div>
            </div>
            <hr class="w-full h-[2px] bg-primary bg-opacity-20">
            <div class="flex flex-col items-start gap-5 w-full">
                <label class="text-secondary font-medium text-subheading">Category</label>
                <div class="flex flex-wrap gap-2">
                    @foreach ($categories as $c)
                        <div class="flex">
                            <input type="checkbox" id="{{ $c->id }}" name="categories[]" value="{{ $c->id }}" class="peer hidden">
                            <label for="{{ $c->id }}"
                                class="cursor-pointer rounded border border-secondary py-1 px-3 transition-colors duration-200 peer-checked:bg-secondary peer-checked:text-white peer-checked:border-secondary">
                                {{ $c->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            <input type="hidden" name="date_btn" value="{{ $selectedDate }}">

            <button type="submit" class="w-full btn-primary" name="filter" value="submit">Filter</button>
        </form>
    </div>

    <!-- Sort Modal -->
    <div id="sort-modal" class="hidden fixed z-50 p-10 bg-white shadow-md rounded" style="top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <form action="/menu" class="flex flex-col gap-5">
            <label for="sort_by" class="font-semibold text-heading text-primary">Sort By</label>
            <div class="flex flex-col gap-2">
                <div class="flex items-center gap-3 font-medium text-subheading text-secondary">
                    <input type="radio" name="sort_by" value="highest_rating">Highest Rating
                </div>
                <div class="flex items-center gap-3 font-medium text-subheading text-secondary">
                    <input type="radio" name="sort_by" value="lowest_price">Lowest Price
                </div>
                <div class="flex items-center gap-3 font-medium text-subheading text-secondary">
                    <input type="radio" name="sort_by" value="highest_price">Highest Price
                </div>
            </div>
            <input type="hidden" name="date_btn" value="{{ $selectedDate }}">
            <button type="submit" class="mr-5 w-full btn-primary">Sort</button>
        </form>
    </div>

    <script>
        let filterBtn = document.getElementById('filter-btn');
        let sortBtn = document.getElementById('sort-btn');
        let utilityLayer = document.getElementById('layer-utility');
        let filterModal = document.getElementById('filter-modal');
        let sortModal = document.getElementById('sort-modal');

        filterBtn.addEventListener('click', function() {
            utilityLayer.classList.remove('hidden');
            filterModal.classList.remove('hidden');
        });

        sortBtn.addEventListener('click', function() {
            utilityLayer.classList.remove('hidden');
            sortModal.classList.remove('hidden');
        });

        utilityLayer.addEventListener('click', function() {
            utilityLayer.classList.add('hidden');
            sortModal.classList.add('hidden');
            filterModal.classList.add('hidden');
        });
    </script>
@endsection
