<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    <link rel="website icon" type="png" href="{{ asset('images/img.png') }}">

    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            max-width: 600px;
            width: 100%;
        }
        .form-group label {
            font-weight: 600;
        }
        .form-text {
            font-size: 0.875rem;
            color: #6b7280;
        }
        .btn-primary {
            background-color: #08f4fd;
            border-color: #08f4fd;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #08f4fd;
            border-color: #08f4fd;
        }
        .logo {
            text-align: center;
            margin-bottom: 1rem;
            padding-top: 20rem;
        }
        .logo img {
            max-width: 100px;
        }
        .back-button {
            display: inline-block;
            margin-bottom: 1rem;
            color: #333;
            text-decoration: none;
            font-weight: 600;
        }
        .back-button:hover {
            text-decoration: underline;
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
    </style>
    <title>Student Registration</title>
</head>
<body>
<div class="background-image"></div>

<div class="container">
    <div class="logo">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/img.png') }}" alt="Logo">
        </a>
        <h1 class="text-2xl font-semibold">Dental Aid</h1>
    </div>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="form-group">
            <label for="exampleInputName">Full Name</label>
            <input type="text" name="name" required class="form-control" id="exampleInputName" aria-describedby="nameHelp" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input required type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('email') }}">
            <small id="emailHelp" class="form-text text-muted">ستبقى معلوماتك محفوظة ولن يتم مشاركتها مع احد.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input required type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Confirm Password</label>
            <input required type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="form-group">
            <label for="exampleInputPhone">Phone</label>
            <input type="text" required class="form-control" id="exampleInputPhone" name="phone" value="{{ old('phone') }}">
        </div>
        <div class="form-group">
            <label for="exampleInputBdate">Study Year</label>
            <input type="text" required class="form-control" name="study_year" id="exampleInputBdate" value="{{ old('study_year') }}">
        </div>
        <div class="form-group">
            <label for="exampleInputBdate">Card ID</label>
            <input type="text" required class="form-control" name="card" id="exampleInputBdate" value="{{ old('card') }}">
        </div>
        <div class="form-group">
            <label for="exampleInputGender">Gender</label><br>
            <label class="radio-inline">
                <input type="radio" class="form-check-input" id="exampleInputGender" name="gender" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}> Male
            </label>
            <label class="radio-inline">
                <input type="radio" class="form-check-input" id="exampleInputGender" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}> Female
            </label>
        </div>

        <input type="hidden" name="role" value="student">
        <button type="submit" class="btn btn-primary btn-block">Register</button>
        <a href="{{ url()->previous() }}" class="back-button">← Back</a>
    </form>
</div>
</body>
</html>
