<!-- resources/views/admin/admin.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
<div class="sidebar">
    <h2>Admin Dashboard</h2>
    <ul>
        <li><a href="{{ route('admin') }}">Home</a></li>
        <li><a href="{{route('admin.users')}}">Managment</a></li>
        <li><a href="{{ route('logout') }}">Logout</a></li>
    </ul>
</div>
<div class="main-content">
    <header>
        <h2>Dashboard</h2>
    </header>
    <div class="content">
        <h3>Welcome, Admin!</h3>
        <p>Here you can manage your application.</p>
    </div>
</div>

<script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>
