{{-- resources/views/layouts/navb.blade.php --}}
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="website icon" type="png" href="{{ asset('images/img.png') }}">
    <!-- Scripts and CSS links -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('final/output.css') }}">
    <link rel="stylesheet" href="{{ asset('final/Front.css') }}">
    <script src="{{ asset('final/java.js') }}"></script>
    <style>
        .rtl {
            direction: rtl;
            text-align: right; /* اختيارية */
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        .main-content {
            margin-top: 100px; /* تعديل القيمة حسب ارتفاع شريط التنقل */
        }
    </style>
</head>
<body class="bg-white">
<!-- Navbar -->
<nav class="navbar bg-white border-b border-gray-500 shadow-md">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <div class="flex items-center">
            <a href="{{url('/')}}" class="logo-link">
                <img src="{{asset('images/img.png')}}" alt="Logo" class="custom-logo mt-2 mb-2">
            </a>
            <div class="text-2xl font-bold text-black">
                <marquee>&nbsp;Dental Aid</marquee>
            </div>
        </div>
        <div class="flex items-center space-x-4 relative">
            @yield('noti')
            <a href="{{route('dashboard')}}">Home</a>
            <a href="{{route('status')}}">Status</a>
            <a href="{{route('about')}}">About</a>
            <a href="{{route('contact')}}">Contact</a>
            @if (Route::has('login'))
                @auth
                    <a href="{{route('share')}}">{{ auth()->user()->name }}</a>
                    <a href="{{route('logout')}}">Log Out</a>
                @else
                    <a href="{{ route('login') }}">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{route('roles.select')}}">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</nav>
<div class="main-content" style="background-image: url('images/bg.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="content">
        @yield('content')
    </div>
</div>
</body>
</html>
