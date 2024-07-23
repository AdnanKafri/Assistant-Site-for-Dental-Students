<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <style>
        .background-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('images/bg.jpg');
            background-size: cover;
            background-position: center;
            opacity: 0.5;
            z-index: -1;
        }
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="website icon" type="png" href="{{ asset('images/img.png') }}">

    <title>Dental Aid - Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">

<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 relative z-10">
    <div>
        <style>
            .custom-logo {
                width: 100px;
                height: 100px;
            }
        </style>
        <a href="{{url('/')}}" class="logo-link">
            <img src="images/img.png" alt="Logo" class="custom-logo mt-2 mb-2">
        </a>
        <h1 class="text-2xl font-semibold">Dental Aid</h1>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
</body>
</html>
