<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Flavour Palette</title>
    <link rel="icon" href="{{ asset('storage/assets/general/favicon.png') }}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite('resources/css/app.css')

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        .hide-scroll-bar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .hide-scroll-bar::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>
<body>
    <style>
        body{
            overflow-x: hidden;
            overflow-y: scroll;
        }
    </style>
    <nav class="fixed top-0 left-0 w-screen shadow-sm bg-white z-50">
        <div class="w-[85%] flex items-center justify-between mx-auto py-4">
            <div class="flex items-center gap-10">
                <a href="{{ url('/') }}">
                    <img src="{{ Storage::url('assets/general/logo.png') }}" class="h-14" alt="flavour-palette logo" />
                </a>
                <a href="{{ url('/') }}" class="nav-menu {{ request()->route()->getName() == 'home' ? 'text-secondary border-secondary' : 'text-primary' }}">Home</a>
                <a href="{{ url('/menu') }}" class="nav-menu {{ request()->route()->getName() == 'menu' ? 'text-secondary border-secondary' : 'text-primary' }}">Menu</a>
                @if (!Auth::user() || Auth::user() && Auth::user()->role == 'customer')
                    <a href="{{ url('/#about-us') }}" onclick="scrollToAboutUs()" class="nav-menu">About Us</a>
                @endif
            </div>
            @if (!Auth::user())
                <div class="flex gap-5">
                    <a href="{{ url('/login') }}" class="btn-secondary">Sign In</a>
                    <a href="{{ url('/register') }}" class="btn-primary">Sign Up</a>
                </div>
            @else
                <div class="flex gap-10 items-center justify-center">
                    @if (Auth::user()->role == 'customer')
                        <a href="{{ url('/cart') }}" ><img src="{{ Storage::url('assets/nav-bar/cart.png') }}" alt="cart logo" class="h-7 w-auto"></a>
                    @endif
                    <img id="profile-btn" src="{{ Storage::url("profile/user/".Auth::user()->profile_picture) }}" class="cursor-pointer w-12 h-12 rounded-full border border-primary object-cover">
                </div>
            @endif
        </div>
    </nav>

    <div class="mt-[88px] min-h-screen">
        @yield('content')
    </div>

    <footer>
        <div class="px-[7.5%] py-20  bg-gradient-to-br from-[#FAD6A0] via-[#BAB183] to-[#818666] w-screen h-auto flex items-start justify-between">
            <div class="w-[25%]">
                <div><a href="{{ url('/') }}"><img src="{{Storage::url("assets/general/logo.png")}}" class="h-20"></a></div>
                <div class="mt-5 font-semibold text-subheading text-primary">About Us</div>
                <div class="mt-2 footer-label">We are Flavour Palette, an online catering service that allows you to enjoy quality meals every day.</div>
            </div>

            <div class="flex flex-col items-start gap-3 w-1/5">
                <div class="font-semibold text-subheading text-primary">Fast Links</div>
                <div class="footer-label"><a href="#">Our Menu</a></div>
                <div class="footer-label"><a href="#">Promotions</a></div>
                <div class="footer-label"><a href="#">Partners</a></div>
                <div class="footer-label"><a href="#">Contact Us</a></div>
            </div>

            <div class="flex flex-col items-start gap-3 w-1/5">
                <div class="font-semibold text-subheading text-primary">Contact Info</div>
                <div class="footer-label"><a href="https://twitter.com/">Twitter</a></div>
                <div class="footer-label"><a href="https://www.facebook.com/">Facebook</a></div>
                <div class="footer-label"><a href="https://www.instagram.com/">Instagram</a></div>
                <div class="footer-label"><a href="https://web.whatsapp.com/">Whatsapp</a></div>
            </div>

            <div class="flex flex-col items-baseline gap-1 w-[25%]">
                <div class="font-semibold text-subheading text-primary">Newsletter</div>
                <div class="my-2 footer-label">Stay up to date with us</div>
                <div class="relative flex items-center w-full h-fit">
                    <input type="email" id="email" name="email" required class="block w-full rounded border-0 py-1.5 px-3 text-primary placeholder:text-dgray sm:text-sm sm:leading-6" placeholder="Email" value="{{ Cookie::get('emailcookie') !== null ? Cookie::get('emailcookie') : '' }}">
                    <div class="absolute" style="right: -2px; cursor: pointer;">
                        <button class="py-1.5 px-3 bg-orange text-white rounded">Subscribe</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-4 w-full flex items-center justify-center">
            <p style="color:rgb(172, 172, 172);">
                &copy; 2023 Flavour Palette All Right Reserved
            </p>
        </div>
    </footer>

    <!-- Profile Modal -->
    @if (Auth::user())
        <div id="layer" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40"></div>
        <div id="profile-modal" class="hidden fixed w-5/12 z-50 p-10 bg-white shadow-md rounded" style="top: 50%; left: 50%; transform: translate(-50%, -50%);">
            <div class="flex items-center rounded justify-between p-3 border border-primary border-opacity-20 bg-white shadow-md">
                <div class="flex items-center gap-5">
                    <img id="profile-btn" src="{{ Storage::url("profile/user/".Auth::user()->profile_picture) }}" class="w-12 h-12 rounded-full border border-primary object-cover">
                    <div>
                        @if (Auth::user()->role == 'customer')
                            <p class="font-semibold text-heading text-secondary">{{ Auth::user()->customer->username }}</p>
                        @else
                            <p class="font-semibold text-heading text-secondary">{{ Auth::user()->seller->name }}</p>
                        @endif
                        <p class="font-light text-name" style="color: rgba(52, 60, 45, 0.5);">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <a href="/profile/edit"><i class="far fa-edit fa-lg text-secondary"></i></i></a>
            </div>
            <div class="mt-5 flex">
                <div class="flex flex-col gap-3 flex-grow border-r border-r-primary">
                    <div class="flex gap-2 items-center text-left">
                        <i class="fa fa-phone text-secondary"></i>
                        <p class="font-medium text-subheading text-secondary text-left">{{ Auth::user()->phone_number }}</p>
                    </div>
                    @if (Auth::user()->role == 'customer')
                        <div class="flex gap-2 items-center text-left">
                            <i class="fa fa-birthday-cake fa-lg text-secondary"></i>
                            <p class="font-medium text-subheading text-secondary text-left">{{ \Carbon\Carbon::createFromFormat('Y-m-d', Auth::user()->customer->dob)->format('d F Y') }}</p>
                        </div>
                        <div class="flex gap-2 items-center text-left">
                            <i class="fa fa-venus-mars text-secondary"></i>
                            <p class="font-medium text-subheading text-secondary text-left">{{ ucfirst(Auth::user()->customer->gender) }}</p>
                        </div>
                    @else
                        <div class="flex gap-2 items-center text-left">
                            <i class="far fa-star text-secondary"></i>
                            <p class="font-medium text-subheading text-secondary text-left">{{ Auth::user()->seller->store_rating }}</p>
                        </div>
                        <div class="flex gap-2 items-center text-left">
                            <i class="far fa-hourglass text-secondary"></i>
                            <p class="font-medium text-subheading text-secondary text-left">{{ Auth::user()->seller->opening_hour }} - {{ Auth::user()->seller->closing_hour }}</p>
                        </div>
                    @endif
                    <div class="flex gap-2 items-center text-left">
                        <i class="fa fa-spinner text-secondary"></i>
                        <p class="font-medium text-subheading text-secondary text-left">{{ ucfirst(Auth::user()->status) }}</p>
                    </div>
                </div>
                <div class="flex flex-col justify-between flex-grow ml-5 gap-16">
                    <div class="flex flex-col gap-3">
                        @if (Auth::user()->role == 'customer')
                            <a class="text-primary text-subheading font-medium hover:text-secondary" href="{{ url('/order') }}">Order History</a>
                            <a class="text-primary text-subheading font-medium hover:text-secondary" href="{{ url('/wishlist') }}">Wishlist</a>
                        @else
                            <a class="text-primary text-subheading font-medium hover:text-secondary" href="{{ url('/order/manage') }}">Manage Order</a>
                            <a id="withdraw-pocket" class="text-primary text-subheading font-medium hover:text-secondary">Withdraw Pocket</a>
                        @endif
                    </div>
                    <div class="flex flex-col gap-3">
                        @if(Auth::user()->status == "active")
                            <label id="inactivate-account" class="cursor-pointer text-primary text-lg font-medium hover:text-secondary">Inactivate Account</label>
                        @else
                            <label id="inactivate-account" class="cursor-pointer text-primary text-lg font-medium hover:text-secondary">Activate Account</label>
                        @endif
                        <a class="cursor-pointer text-primary text-subheading font-medium hover:text-secondary" href="{{ url('/logout') }}">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <div id="inactivate-modal" class="hidden flex-col items-center fixed w-3/12 z-50 p-10 bg-white shadow-md rounded" style="top: 50%; left: 50%; transform: translate(-50%, -50%);">
            <form action="/profile/status" method="POST">
                {{ @csrf_field() }}
                @if(Auth::user()->status == "active")
                    <div class="w-full text-center text-subheading text-primary font-medium">Are you sure you want to deactivate your account?</div>
                    <button type="submit" id="deactivate" name="status" value="deactivate" class="mt-5 w-full btn-secondary">Yes</button>
                @else
                    <div class="w-full text-center text-subheading text-primary font-medium">Are you sure you want to activate your account?</div>
                    <button type="submit" id="activate" name="status" value="activate" class="mt-5 w-full btn-secondary">Yes</button>
                @endif
            </form>
            <div class="mt-2 flex justify-center w-full">
                <button id="cancel-btn" class="w-full btn-primary">Cancel</button>
            </div>
        </div>

        @if (Auth::user()->role == 'seller')
            <div id="withdraw-modal" class="hidden flex-col items-center fixed w-3/12 z-50 p-10 bg-white shadow-md rounded" style="top: 50%; left: 50%; transform: translate(-50%, -50%);">
                <form action="/withdraw" method="POST" class="flex flex-col gap-2">
                    {{ @csrf_field() }}
                    <div class="w-full text-heading text-primary font-semibold">Your Pocket</div>
                    <div class="w-full flex items-center justify-between">
                        <p class="text-subheading text-secondary font-medium">Total</p>
                        @if (Auth::user()->seller->pocket > 0)
                            <p class="text-subheading text-secondary font-medium">Rp{{ number_format(Auth::user()->seller->pocket, 2, ',', '.') }}</p>
                        @else
                            <p class="text-subheading text-secondary font-medium">No Balance</p>
                        @endif
                    </div>
                    @if (Auth::user()->seller->pocket > 0)
                        <button type="submit" class="btn-primary w-full">Withdraw</button>
                    @endif
                </form>
            </div>
        @endif
    @endif

    @if (Auth::user())
        <script>
            let layer = document.getElementById('layer');
            let profileBtn = document.getElementById('profile-btn');
            let profileModal = document.getElementById('profile-modal');
            let inactivateLabel = document.getElementById('inactivate-account');
            let inactivateAcc = document.getElementById('inactivate-modal');
            let cancelBtn = document.getElementById('cancel-btn');
            let withdrawLabel = document.getElementById('withdraw-pocket');
            let withdrawModal = document.getElementById('withdraw-modal');

            inactivateLabel.addEventListener('click', function(){
                profileModal.style.display = 'none';
                layer.style.display = 'block';
                inactivateAcc.style.display = 'block';
            });

            profileBtn.addEventListener('click', function() {
                layer.style.display = 'none';
                profileModal.style.display = 'none';
                inactivateAcc.style.display = 'none';

                layer.style.display = 'block';
                profileModal.style.display = 'block';
            });

            layer.addEventListener('click', function() {
                layer.style.display = 'none';
                profileModal.style.display = 'none';
                inactivateAcc.style.display = 'none';
                withdrawModal.style.display = 'none';
            });

            cancelBtn.addEventListener('click', function() {
                profileModal.style.display = 'block';
                inactivateAcc.style.display = 'none';
            });

            @if (Auth::user()->role == 'seller')
                withdrawLabel.addEventListener('click', function() {
                    profileModal.style.display = 'none';
                    withdrawModal.style.display = 'block';
                });
            @endif
        </script>
    @endif

    <script>
        function scrollToAboutUs() {
            var targetOffset = $('#about-us').offset().top - 150; // Adjust the offset as needed
            $('html, body').animate({
                scrollTop: targetOffset
            }, 1000);
        }
    </script>

    @if (Auth::user() && Auth::user()->role == 'customer')
        <script>
            var user_id = "{{ Auth::user()->customer->id }}";
            $(document).ready(function(){
                $('.update-wishlist').click(function(){
                    event.preventDefault();
                    var menu_id = $(this).data('menuid');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: '/wishlist/update',
                        data: {
                            menu_id: menu_id,
                            user_id: user_id
                        },
                        success:function(response){
                            if (response.error == 'false') {
                                if (response.action == 'add') {
                                    $('a[data-menuid=' + menu_id + ']').html('<i class="fas fa-heart fa-2x text-primary"></i>');
                                } else if (response.action == 'remove') {
                                    $('a[data-menuid=' + menu_id + ']').html('<i class="far fa-heart fa-2x text-primary"></i>');
                                }
                            }
                        }
                    });
                });
            });
        </script>
    @endif
</body>
</html>
