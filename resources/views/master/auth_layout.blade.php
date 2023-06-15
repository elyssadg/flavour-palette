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
<body class="relative flex flex-col items-center justify-center w-screen h-fit p-20">
    <img class="fixed top-0 left-0 -z-10 w-full h-full object-cover" src="{{ Storage::url("assets/general/header-photo.png") }}" alt="">
    <div class="flex flex-col bg-white bg-opacity-80 rounded shadow z-10 items-center justify-center w-7/12 h-fit">
        @yield('content')
    </div>
    <script>
        var flag = 0;
        function password(){
            if(flag == 1){
                document.getElementById('password').type='password';
                document.getElementById('eye-icon').classList.remove('fa-eye');
                document.getElementById('eye-icon').classList.add('fa-eye-slash');
                flag = 0;
            } else {
                document.getElementById('password').type='text';
                document.getElementById('eye-icon').classList.remove('fa-eye-slash');
                document.getElementById('eye-icon').classList.add('fa-eye');
                flag = 1;
            }
        }
    </script>
</body>
</html>
