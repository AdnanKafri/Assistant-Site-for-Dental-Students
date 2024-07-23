<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
<div class="sidebar">
    <h2>Admin Dashboard</h2>
    <ul>
        <li>
            <a href="{{ route('admin') }}">Home</a>
        </li>
        <li>
            <a href="#" class="toggle-menu">Users<i class="fas fa-caret-down"></i></a>
            <ul class="submenu">
                <li><a href="{{ route('admin.users') }}">All Users</a></li>
                <li><a href="{{ route('admin.users.create.student') }}">Add Student</a></li>
                <li><a href="{{ route('admin.users.create.patient') }}">Add Patient</a></li>
                <li><a href="{{ route('admin.users.create.supervisor') }}">Add Supervisor</a></li>
            </ul>
        </li>
        <li>
            <a href="{{ route('admin.posts') }}">Posts</a>
        </li>
        <li>
            <a href="#" class="toggle-menu">Subjects<i class="fas fa-caret-down"></i></a>
            <ul class="submenu">
                <li><a href="{{ route('admin.subjects') }}">All Subjects</a></li>
                <li><a href="{{ route('admin.subjects.create') }}">Add Subject</a></li>
            </ul>
        </li>
        <li>
            <a href="#" class="toggle-menu">Marks<i class="fas fa-caret-down"></i></a>
            <ul class="submenu">
                <li><a href="{{ route('admin.marks') }}">All Marks</a></li>
                <li><a href="{{ route('admin.marks.create') }}">Add Mark</a></li>
            </ul>
        </li>
        <li>
            <a href="#" class="toggle-menu">States<i class="fas fa-caret-down"></i></a>
            <ul class="submenu">
                <li><a href="{{ route('admin.states') }}">All States</a></li>
                <li><a href="{{ route('admin.state.create') }}">Add State</a></li>
            </ul>
        </li>

        <li><a href="{{route('logout')}}">Logout</a></li>
    </ul>
</div>
<div class="main-content">
    <header>
        <h2>@yield('header')</h2>
    </header>
    <div class="content">
        @yield('content')
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>
