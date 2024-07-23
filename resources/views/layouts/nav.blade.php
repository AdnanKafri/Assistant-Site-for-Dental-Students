<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Document</title>
    <style>
        /* Hover effect for navigation links */
        .nav-link:hover {
            color: #4299e1;
            transition: color 0.3s ease-in-out;
        }

        /* Hover effect for login and sign up buttons */
        .btn-login:hover,
        .btn-signup:hover {
            background-color: #4299e1;
            transition: background-color 0.3s ease-in-out;
        }
    </style>
</head>

<body class="bg-gray-100">

    <nav class="bg-gray-800 text-white fixed w-full top-0 py-4">
        <div class="container mx-auto flex justify-between items-center">
            <a class="text-xl font-bold" href="/">DENTAL ASSISTANT</a>
            <div class="flex items-center space-x-4">
                <a class="px-4 nav-link transition duration-300" href="/">Home</a>
                <a class="px-4 nav-link transition duration-300" href="#">Status</a>
                <a class="px-4 nav-link transition duration-300" href="#">About</a>
                <a class="px-4 nav-link transition duration-300" href="#">Contact</a>
                <a class="px-4 nav-link transition duration-300" href="/profile">Profile</a>
                <div class="ml-auto">
                    <a class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md btn-login transition duration-300" href="#">Login</a>
                    <a class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md btn-signup transition duration-300" href="#">Sign Up</a>
                </div>
            </div>
        </div>
    </nav>

    @yield('cont')
    <footer class="text-center bg-gray-200 py-3  bottom-0 w-full">
        <div>
            <h3 class="text-sm font-semibold">Made By ...</h3>
        </div>
    </footer>
</body>

</html>
