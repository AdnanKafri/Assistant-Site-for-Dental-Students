<!-- resources/views/admin/users/create-supervisor.blade.php -->
@extends('layouts.admin')

@section('title', 'Admin - Add Supervisor')

@section('header', 'Add Supervisor')

@section('content')
    <div class="content">
        <form action="{{ route('admin.users.storeSupervisor') }}" method="POST" enctype="multipart/form-data">
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

            <input type="hidden" name="role" value="supervisor">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>

            <input type="hidden" name="check_state" value="0">
            <div class="form-group">
                <label for="photo">Photo:</label>
                <input type="file" id="photo" name="photo" required>
            </div>
            <input type="hidden" name="password" value="00000000">
            <input type="hidden" name="password" value="00000000">
            <button type="submit">Add Supervisor</button>
        </form>
    </div>
@endsection
