<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Flavour Palette</title>
    <link rel="icon" href="{{ asset('storage/assets/general/favicon.png') }}" type="image/x-icon">
    @vite('resources/css/app.css')

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <nav class="w-screen">
        <div class="w-[85%] flex items-center justify-between mx-auto py-5">
            <div class="flex items-center gap-10">
                <a href="{{ url('/') }}">
                    <img src="{{ Storage::url('assets/general/logo.png') }}" class="h-14" alt="flavour-palette logo" />
                </a>
                <a href="{{ url('/') }}" class="nav-menu {{ request()->route()->getName() == 'home' ? 'text-secondary border-secondary' : 'text-primary' }}">Home</a>
                <a href="{{ url('/catalog') }}" class="nav-menu {{ request()->route()->getName() == 'menu' ? 'text-secondary border-secondary' : 'text-primary' }}">Menu</a>
                <a href="{{ url('/about') }}" class="nav-menu {{ request()->route()->getName() == 'about' ? 'text-secondary border-secondary' : 'text-primary' }}">About Us</a>
            </div>
            @if (!Auth::user())
                <div class="flex gap-5">
                    <a href="{{ url('/login') }}" class="btn-secondary">Sign In</a>
                    <a href="{{ url('/register') }}" class="btn-primary">Sign Up</a>
                </div>
            @else
                <div class="flex gap-10">
                    @if (Auth::user()->role == 'customer')
                        <div class="flex gap-7 items-center">
                            <a href="{{url('/cart')}}" ><i class="fa fa-bag-shopping fa-2x text-secondary"></i></a>
                        </div>
                    @endif
                    <div class="w-10 h-10 mt-2 rounded-full overflow-hidden">
                        <img id="profile-btn" src="{{ Storage::url("profile/user/".Auth::user()->profile_picture) }}" class="object-cover w-full h-full">
                    </div>
                </div>
            @endif
        </div>
    </nav>

    
</body>
</html>