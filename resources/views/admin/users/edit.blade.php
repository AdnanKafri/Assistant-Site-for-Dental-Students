<!-- resources/views/admin/edit_user.blade.php -->
@extends('layouts.admin')

@section('title', 'Edit User')

@section('header', 'Edit User')

@section('content')
    <form action="{{ route('admin.users.update', ['type' => $type, 'id' => $user->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $user->name }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="{{ $user->phone }}" required>
        </div>
        <div class="form-group">
            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="supervisor" {{ $user->role == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                <option value="student" {{ $user->role == 'student' ? 'selected' : '' }}>Student</option>
                <option value="patient" {{ $user->role == 'patient' ? 'selected' : '' }}>Patient</option>
            </select>
        </div>
        <div class="form-group actions">
            <button type="submit" class="edit-button">Save Changes</button>
        </div>
    </form>
@endsection
