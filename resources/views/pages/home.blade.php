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
        @else
            <div class="p-10 bg-lgray rounded border border-primary border-opacity-20 shadow-md">
                <h1 class="text-secondary font-semibold text-title text-left">Order Activities</h1>
                <p class="text-primary text-heading font-normal text-left">Activities that you need to monitor to maintain your order</p>
                <div class="mt-5 flex justify-between items-center">
                    <div class="flex gap-5">
                        <div class="w-20 h-20 bg-primary rounded-full"></div>
                        <div>
                            <h2 class="text-orange font-semibold text-subheading text-left">New Order</h2>
                            <h1 class="text-secondary font-semibold text-title text-left">{{ Auth::user()->seller->order_detail->where('status', '=', 'Waiting')->count() }}</h1>
                        </div>
                    </div>
                    <div class="flex gap-5">
                        <div class="w-20 h-20 bg-primary rounded-full"></div>
                        <div>
                            <h2 class="text-orange font-semibold text-subheading text-left">In Progress</h2>
                            <h1 class="text-secondary font-semibold text-title text-left">{{ Auth::user()->seller->order_detail->where('status', '=', 'In Progress')->count() }}</h1>
                        </div>
                    </div>
                    <div class="flex gap-5">
                        <div class="w-20 h-20 bg-primary rounded-full"></div>
                        <div>
                            <h2 class="text-orange font-semibold text-subheading text-left">In Delivery</h2>
                            <h1 class="text-secondary font-semibold text-title text-left">{{ Auth::user()->seller->order_detail->where('status', '=', 'In Delivery')->count() }}</h1>
                        </div>
                    </div>
                    <div class="flex gap-5">
                        <div class="w-20 h-20 bg-primary rounded-full"></div>
                        <div>
                            <h2 class="text-orange font-semibold text-subheading text-left">Done</h2>
                            <h1 class="text-secondary font-semibold text-title text-left">{{ Auth::user()->seller->order_detail->where('status', '=', 'Done')->count() }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <img class="w-full h-auto shadow-md" src="{{ Storage::url('assets/home/second-image.png') }}" alt="">

        <!-- Popular Menu -->
        <div class="flex flex-col gap-5 w-full">
            <div class="w-full flex flex-row justify-between items-baseline">
                <h1 class="text-title text-secondary font-semibold">
                    @if (!Auth::user() || Auth::user() && Auth::user()->role == 'customer')
                        Popular Menu For The Week
                    @else
                        Top Menus From You
                    @endif
                </h1>
                <a href="{{ url('/menu') }}" class="mt-auto text-dgray font-light text-name hover:underline">See More</a>
            </div>

            <div class="flex h-max overflow-x-scroll hide-scroll-bar">
                <div class="flex gap-5 p-1">
                    @foreach ($menus as $index => $m)
                        <div id="menu-{{ $m->id }}" class="relative w-80 h-fit rounded bg-white shadow-md overflow-hidden cursor-pointer">
                            <a href="/menu/{{ $m->id }}">
                                <img class="w-full aspect-square object-cover" src="{{ Storage::url("profile/menu/".$m->profile_menu) }}"/>
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

                                @if (Auth::user() && Auth::user()->role == 'customer')
                                    <div class="ml-auto">
                                        <div class="flex gap-2 items-center justify-center">
                                            <a href="/wishlist/update" data-menuid="{{ $m->id }}" class="update-wishlist flex items-center justify-center w-12 h-12 rounded hover:bg-primary hover:bg-opacity-10">
                                                @if (Auth::user()->customer->wishlist->where('menu_id', $m->id)->isNotEmpty())
                                                    <i class="fas fa-heart fa-2x text-primary"></i>
                                                @else
                                                    <i class="far fa-heart fa-2x text-primary"></i>
                                                @endif
                                            </a>
                                            <form action="cart/add" method="POST">
                                                {{ @csrf_field() }}
                                                <input type="hidden" id="available_date" name="available_date" value="{{ $m->available_date }}">
                                                <input type="hidden" id="menu_id" name="menu_id" value="{{ $m->id }}"/>
                                                <input type="hidden" name="quantity" value="1">
                                                <button class="bg-primary rounded-full h-12 w-12 flex items-center justify-center text-white font-medium text-title hover:shadow-primary hover:shadow" type="submit">+</button>
                                            </form>
                                        </div>
                                    </div>
                                @elseif (Auth::user() && Auth::user()->role == 'seller')
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
                                                                    document.getElementById('cb-{{ $m->id }}-{{ $c->id }}" value="{{ $c->id }}').checked = !document.getElementById('cb-{{ $m->id }}-{{ $c->id }}" value="{{ $c->id }}').checked;
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
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        @if (!Auth::user() || Auth::user() && Auth::user()->role == 'customer')
            <!-- About Us -->
            <div class="w-full flex justify-between">
                <img src="{{ Storage::url('assets/home/food-photo.png') }}" alt="food image" class="mb-auto w-[35%]">
                <div class="flex flex-col items-end justify-between w-[60%] gap-10">
                    <div>
                        <div class="h-full flex flex-col gap-5 w-full items-start">
                            <h1 id="about-us" class="text-title text-secondary font-semibold">About Us</h1>
                            <p class="text-heading text-secondary font-normal">We are Flavour Palette, an online catering service that allows you to enjoy quality meals every day. We have more than 100 professional catering kitchens that are ready to cook your favorite menu, from healthy, fusion, oriental, to traditional dishes. You can order daily catering menu through Flavour Palette app with affordable price and flexible booking. You can also freely customize your catering menu according to your taste and schedule.</p>
                        </div>
                    </div >
                    <div class="flex justify-between items-center">
                        <img src="{{ Storage::url('assets/home/delivery-photo.png') }}" alt="delivery image" class="w-[45%] h-full object-cover">
                        <img src="{{ Storage::url('assets/home/katsu-photo.png') }}" alt="katsu image" class="w-[52%] h-full object-cover">
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
                                <img src="{{ Storage::url('profile/user/'.$seller->user->profile_picture) }}" alt="seller image" class="object-cover">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <div class="flex flex-col items-start justify-center gap-5 w-full bg-white rounded shadow p-10 border border-primary border-opacity-50">
                <div class="title text-secondary">
                    Orders
                </div>
                <div class="flex justify-between w-full">
                    <div class="w-1/2 text-heading font-semibold text-primary ">
                        Order ID
                    </div>
                    <div class="w-2/12 text-heading font-semibold text-primary">
                        Status
                    </div>
                    <div class="w-2/12 text-heading font-semibold text-primary">
                        Date
                    </div>
                    <div class="w-2/12 text-heading font-semibold text-primary">
                        Buyer
                    </div>
                    <div class="w-2/12 text-heading font-semibold text-primary">
                        Total
                    </div>
                </div>
                <div class="flex flex-col gap-5 w-full">
                    @foreach ($orders as $o)
                        <a href="/order/{{ $o->order_id }}" class="flex justify-between w-full">
                            <div class="w-1/2">
                                <div class="text-name text-secondary font-medium">
                                    {{ $o->order_id }}
                                </div>
                                <div>
                                    <div class="text-base text-dgray">Preview</div>
                                    <div class="flex w-full items-center gap-2">
                                        <div class="w-16 h-16 rounded">
                                            <img class="w-full h-full object-cover" src="{{ Storage::url("profile/menu/".$o->menu->profile_menu) }}"/>
                                        </div>
                                        <div class="text-base text-black font-medium">
                                            {{ $o->menu->name }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="w-2/12 flex items-center">
                                <div class="w-max py-1 px-2 border border-secondary text-secondary font-medium rounded flex items-center justify-center">
                                    {{ $o->status }}
                                </div>
                            </div>

                            <div class="font-medium w-2/12 flex items-center">
                                {{ date('d/m/Y', strtotime($o->arrival_date)) }}
                            </div>

                            <div class="flex gap-3 items-center w-2/12">
                                <div class="w-9 h-9 rounded-full overflow-hidden">
                                    <img class="object-cover w-full h-full" src="{{ Storage::url("profile/user/".$o->order_header->customer->user->profile_picture) }}" alt="Profile Image">
                                </div>
                                <div class="font-medium">
                                    {{ $o->order_header->customer->username }}
                                </div>
                            </div>
                            <div class="font-semibold w-2/12 flex items-center">
                                Rp{{ number_format($o->order_header->total_price/1000, 3, '.', ',') }},00
                            </div>
                        </a>
                        @if (!$loop->last)
                            <hr class="line">
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
