<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Role Selection</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="website icon" type="png" href="{{ asset('images/img.png') }}">

    <!-- Styles -->
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #ffffff;
            color: #333;
            margin: 0;
            padding: 0;
            position: relative;
            overflow: hidden;
        }
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
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
            padding: 2rem;
            position: relative;
            z-index: 1;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 2rem;
            max-width: 1200px;
            width: 100%;
        }
        @media (min-width: 768px) {
            .grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        .card {
            background-color: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            text-decoration: none;
            color: inherit;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-content {
            padding: 2rem;
            text-align: center;
        }
        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        .card-description {
            font-size: 1rem;
            color: #6b7280;
        }
        .card-icon {
            width: 3rem;
            height: 3rem;
            margin-bottom: 1rem;
            color: #ef4444;
        }
        .logo {
            margin-bottom: 2rem;
        }
        .logo img {
            width: 100px;
            height: 100px;
        }
    </style>
</head>
<body class="antialiased">
<div class="background-image"></div>
<div class="container">
    <div class="logo">
        <a href="{{ url('/') }}">
            <img src="images/img.png" alt="Logo">
        </a>
        <h1 class="text-2xl font-semibold"> Dental Aid</h1>
    </div>
    <div class="grid">
        <a href="{{ route('roles.patients') }}" class="card">
            <div class="card-content">
                <img src="images/pat%20icon.png" width="200px" height="200px">
                <div class="card-title">المريض</div>
                <div class="card-description">
                    يمكنك التسجيل بعضوية مريض لنشر حالاتك المرضية أو ايجاد حالة مرضية تعاني منها<br>لنساعدك على ايجاد طبيبك المثالي.
                </div>
            </div>
        </a>
        <a href="{{ route('roles.student') }}" class="card">
            <div class="card-content">
                <img src="images/stu%20icon.png" width="200px" height="200px">
                <div class="card-title">الطالب</div>
                <div class="card-description">
                    سجل كطالب لتتمكن من العثور على حالات المعالجة المطلوبة منك بالجامعة.
                </div>
            </div>
        </a>
        <a href="{{ route('supervisor') }}" class="card">
            <div class="card-content">
                <img src="images/super%20icon.png" width="200px" height="200px">
                <div class="card-title">المشرف</div>
                <div class="card-description">
                    سجل كمشرف بالجامعة لتتمكن من مراجعة وتقييم الحالات التي يستلمها الطلاب.
                </div>
            </div>
        </a>
    </div>
</div>
</body>
</html>
