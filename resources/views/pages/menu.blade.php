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
        @if (!Auth::user() || Auth::user() && Auth::user()->role == 'customer')
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

    <div class="w-[85%] mx-auto flex flex-col py-20">
        @if (Auth::user() && Auth::user()->role == 'seller')
            <div>
                <h1 class="text-title text-secondary font-semibold">Your Catering Menus</h1>
            </div>
            <form id="date-form" action="/menu" class="flex justify-between w-full">
                <input type="hidden" name="date_btn" value="{{ $selectedDate }}">
                <input type="date" id="date" name="start_date" required class="input-form">
            </form>

            <script>
                document.getElementById('date').addEventListener('change', function() {
                    var selectedDate = new Date(this.value);
                    if (selectedDate.getDay() !== 1) {
                        alert('Start date must be in Monday!');
                        this.value = '';
                    }else{
                        document.getElementById('date-form').submit();
                    }
                });
            </script>
        @endif

        <!-- Utility Bar -->
        <div class="flex flex-col gap-5 mt-5">
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
                @if (!Auth::user() || Auth::user() && Auth::user()->role == 'customer')
                    <div class="relative flex justify-center items-center w-full h-fit mb-10">
                        <i class="mx-auto absolute fa fa-search left-5"></i>
                        <form class="pl-14 p-3 border-2 border-dgray rounded shadow-md w-full" action="{{ url('/search') }}">
                            <input type="hidden" name="date_btn" value="{{ $selectedDate }}">
                            <input class="form-control w-full outline-none border-0 text-secondary" type="search" placeholder="Enter a keyword" name="search">
                        </form>
                    </div>
                @endif
            </div>
        </div>

        <!-- Menu -->
        @if (Auth::user() && Auth::user()->role == 'seller')
            <div class="flex h-max overflow-x-scroll hide-scroll-bar mt-5">
                <div class="flex gap-5 p-1">
                    @foreach ($availableMenus as $index => $m)
                        <div id="menu-{{ $m->id }}" class="relative w-80 h-fit rounded bg-white shadow-md overflow-hidden">
                            <a href="/menu/{{ $m->id }}">
                                <img class="" src="{{ Storage::url("profile/menu/".$m->profile_menu) }}"/>
                            </a>
                            <div class="flex flex-col gap-5 p-5">
                                <div class="flex justify-between h-auto">
                                    <div class="max-w-[65%] h-20 text-secondary font-semibold text-heading">
                                        {{ $m->name }}
                                    </div>
                                    <div>
                                        <i class="fa fa-star" style="color: #E39D36"></i>
                                        <?php
                                            if ($m->average_rating < 1) {
                                                ?>
                                                <span class="text-secondary font-normal text-subname">No Rating</span>
                                                <?php
                                            } else {
                                                ?>
                                                <span class="text-secondary font-semibold text-name">
                                                    {{ number_format($m->average_rating, 2, '.', '') }}
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

                                <div class="flex items-center justify-center">
                                    <button id="edit-btn-{{ $m->id }}" class="w-3/4 btn-primary">Edit</button>
                                    <a href="/menu/{{ $m->id }}/delete" class="ml-auto text-primary text-subheading font-medium">Delete</a>
                                </div>
                                <div id="layer-{{ $m->id }}" class="z-50 hidden fixed inset-0 bg-black bg-opacity-50"></div>
                                <div id="edit-modal-{{ $m->id }}" class="hidden fixed w-5/12 z-50 p-10 bg-white shadow-md rounded" style="top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                    <form action="/menu/edit" id="menu-update-form-{{ $m->id }}" class="flex flex-col gap-5 w-full" method="POST" enctype="multipart/form-data" style="z-index: 100;">
                                        {{ csrf_field() }}
                                        <div class="font-semibold text-heading text-primary">Update Menu Detail</div>
                                        <input type="hidden" name="menu_id" value="{{ $m->id }}">
                                        <div>
                                            <label for="menu_name" class="form-label">Image</label>
                                            <input type="file" class="input-form p-0 ring-0" name="menu_image" placeholder="Menu Image">
                                        </div>

                                        <div>
                                            <label for="menu_name" class="form-label">Name</label>
                                            <input type="text" class="input-form" name="menu_name" placeholder="Menu Name" value="{{ $m->name }}">
                                        </div>

                                        <div>
                                            <label for="menu_price" class="form-label">Price</label>
                                            <input type="number" class="input-form" name="menu_price" placeholder="Menu Price" value="{{ $m->price }}">
                                        </div>

                                        <div>
                                            <label for="menu_description" class="form-label">Description</label>
                                            <textarea class="input-form" name="menu_description" placeholder="Menu Description">{{ $m->description }}</textarea>
                                        </div>

                                        <div>
                                            <label for="menu_category" class="form-label">Category</label>
                                            <div class="mt-2 flex flex-wrap gap-2 text-secondary font-semibold text-subheading" style="z-index: 200;">
                                                @foreach ($categories as $c)
                                                    <div class="flex">
                                                        <input type="checkbox" name="categories[]" id="cb-{{ $m->id }}-{{ $c->id }}" value="{{ $c->id }}" class="peer hidden" {{ $m->menu_category->where('category_id', $c->id)->isNotEmpty() ? 'checked' : '' }}>
                                                        <label id="lbl-{{ $m->id }}-{{ $c->id }}" for="cb-{{ $m->id }}-{{ $c->id }}" 
                                                            class="cursor-pointer rounded border border-secondary py-1 px-3 transition-colors duration-200 peer-checked:bg-secondary peer-checked:text-white peer-checked:border-secondary">
                                                            {{ $c->name }}
                                                        </label>
                                                        <script>
                                                            document.getElementById('lbl-{{ $m->id }}-{{ $c->id }}').addEventListener('click', function(){
                                                                document.getElementById('cb-{{ $m->id }}-{{ $c->id }}"').checked = !document.getElementById('cb-{{ $m->id }}-{{ $c->id }}"').checked;
                                                            });
                                                        </script>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div id="menu-update-error-{{ $m->id }}" class="text-center text-red-500 text-name font-semibold mt-5"></div>
        
                                        <button type="submit" class="btn-primary">Save</button>
                                    </form>
                                </div>
                                <script>
                                    document.getElementById('edit-btn-{{ $m->id }}').addEventListener('click', function(event){
                                        event.preventDefault();
                                        document.getElementById('edit-modal-{{ $m->id }}').classList.remove('hidden');
                                        document.getElementById('layer-{{ $m->id }}').classList.remove('hidden');
                                        event.stopPropagation();
                                    });

                                    document.getElementById('layer-{{ $m->id }}').addEventListener('click', function() {
                                        document.getElementById('edit-modal-{{ $m->id }}').classList.add('hidden');
                                        document.getElementById('layer-{{ $m->id }}').classList.add('hidden');
                                        event.stopPropagation();
                                    });


                                    $('#menu-update-form-{{ $m->id }}').submit(function(e) {
                                        e.preventDefault();
                                        var form_data = new FormData(this);
                                        $.ajax({
                                            url: '/menu/edit',
                                            method: 'POST',
                                            data: form_data,
                                            dataType: 'json',
                                            contentType: false,
                                            processData: false,
                                            success: function(response) {
                                                if (response.error) {
                                                    $('#menu-update-error-{{ $m->id }}').text(response.error_message).show();
                                                } else {
                                                    window.location.href = response.redirect;
                                                }
                                            },
                                            error: function(xhr, status, error) {
                                                console.error(error);
                                            }
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <div class="flex flex-col gap-5 mt-20">
                <h1 class="text-title text-secondary font-semibold">Archived Menus</h1>
                <div class="flex h-max overflow-x-scroll hide-scroll-bar">
                    <div class="flex gap-5 p-1">
                        @foreach ($archivedMenus as $index => $m)
                            <div id="menu-{{ $m->id }}" class="relative w-80 h-fit rounded bg-white shadow-md overflow-hidden"> 
                                <img class="" src="{{ Storage::url("profile/menu/".$m->profile_menu) }}"/>
                                <div class="flex flex-col gap-5 p-5">
                                    <div class="flex justify-between h-auto">
                                        <div class="max-w-[65%] h-20 text-secondary font-semibold text-heading">
                                            {{ $m->name }}
                                        </div>
                                        <div>
                                            <i class="fa fa-star" style="color: #E39D36"></i>
                                            <?php
                                                if ($m->average_rating < 1) {
                                                    ?>
                                                    <span class="text-secondary font-normal text-subname">No Rating</span>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <span class="text-secondary font-semibold text-name">
                                                        {{ number_format($m->average_rating, 2, '.', '') }}
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
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="flex flex-col items-center justify-center p-10 mx-auto bg-white rounded shadow w-1/2 mt-20 border border-primary border-opacity-50">
                <form id="menu-add-form" action="menu/add" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="flex w-full flex-col gap-5">
                        <div>
                            <h2 class="text-center text-title font-semibold text-secondary" >Add New Menu</h2>
                        </div>
                        <div>
                            <label for="menu_name" class="form-label">Image</label>
                            <input type="file" class="input-form p-0 ring-0" name="menu_image" placeholder="Menu Image">
                        </div>

                        <div>
                            <label for="menu_name" class="form-label">Name</label>
                            <input type="text" class="input-form" name="menu_name" placeholder="Menu Name">
                        </div>

                        <div>
                            <label for="menu_price" class="form-label">Price</label>
                            <input type="number" class="input-form" name="menu_price" placeholder="Menu Price">
                        </div>

                        <div>
                            <label for="menu_description" class="form-label">Description</label>
                            <textarea class="input-form" name="menu_description" placeholder="Menu Description"></textarea>
                        </div>

                        <div>
                            <label for="menu_category" class="form-label">Category</label>
                            <div class="mt-2 flex flex-wrap gap-2 text-secondary font-semibold text-subheading" style="z-index: 200;">
                                @foreach ($categories as $c)
                                    <div class="flex">
                                        <input type="checkbox" name="categories[]" id="cb-{{ $c->id }}" value="{{ $c->id }}" class="peer hidden">
                                        <label id="lbl-{{ $c->id }}" for="cb-{{ $c->id }}" 
                                            class="cursor-pointer rounded border border-secondary py-1 px-3 transition-colors duration-200 peer-checked:bg-secondary peer-checked:text-white peer-checked:border-secondary">
                                            {{ $c->name }}
                                        </label>
                                        <script>
                                            document.getElementById('lbl-{{ $c->id }}').addEventListener('click', function(){
                                                document.getElementById('cb-{{ $c->id }}"').checked = !document.getElementById('cb-{{ $c->id }}"').checked;
                                            });
                                        </script>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <label for="menu_date" class="form-label">Available Date</label>
                            <input type="date" class="input-form" name="menu_date" placeholder="Menu Available Date">
                        </div>

                        <div id="menu-add-error" class="text-center text-red-500 text-name font-semibold mt-5"></div>

                        <button type="submit" class="btn-primary">Save</button>
                    </div>
                </form>
            </div>
            <script>
                $('#menu-add-form').submit(function(e) {
                    e.preventDefault();
                    var form_data = new FormData(this);
                    $.ajax({
                        url: '/menu/add',
                        method: 'POST',
                        data: form_data,
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.error) {
                                $('#menu-add-error').text(response.error_message).show();
                            } else {
                                window.location.href = response.redirect;
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                });
            </script>
        @else
            <div class="flex flex-wrap gap-y-10 gap-x-[5%] justify-center p-1">
                @foreach ($menus as $index => $m)
                    <div id="menu-{{ $m->id }}" class="relative w-[30%] h-fit rounded bg-white shadow-md overflow-hidden cursor-pointer">
                        <a href="/menu/{{ $m->id }}?date_btn={{ $m->available_date }}">
                            <img class="" src="{{ Storage::url("profile/menu/".$m->profile_menu) }}"/>
                        </a>
                        <div class="flex flex-col gap-5 p-5">
                            <div class="flex justify-between h-auto">
                                <div class="max-w-[65%] h-14 text-secondary font-semibold text-heading">
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

                            <div class="flex flex-col h-10">
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
                            @if (Auth::user() && Auth::user()->role == 'customer')
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
                                        <form action="cart/add" method="POST">
                                            {{ @csrf_field() }}
                                            <input type="hidden" id="available_date" name="available_date" value="{{ $m->available_date }}">
                                            <input type="hidden" id="menu_id" name="menu_id" value="{{ $m->id }}"/>
                                            <input type="hidden" name="quantity" value="1">
                                            <button class="bg-primary rounded-full h-12 w-12 flex items-center justify-center text-white font-medium text-title hover:shadow-primary hover:shadow" type="submit">+</button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
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
            <hr class="line">
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
            <hr class="line">
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
