@extends('layouts.admin')

@section('title', 'Edit User')

@section('header', 'Edit User')

@section('content')
    <form action="{{ route('admin.users.update', ['type' => $type, 'id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
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

        @if($user->role == 'supervisor')
            <div class="form-group">
                <label for="check_state">Check State:</label>
                <select id="check_state" name="check_state" required>
                    <option value="0" {{ $user->supervisor->check_state == '0' ? 'selected' : '' }}>Pending</option>
                    <option value="1" {{ $user->supervisor->check_state == '1' ? 'selected' : '' }}>Approved</option>
                    <option value="2" {{ $user->supervisor->check_state == '2' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>
            <div class="form-group">
                <label for="current_photo">Current Photo:</label>
                @if($user->supervisor->photo)
                    <div>
                        <img src="{{ asset('storage/' . $user->supervisor->photo) }}" alt="Supervisor Photo" >
                    </div>
                @endif
                <label for="photo">Change Photo:</label>
                <input type="file" id="photo" name="photo" class="form-control-file">
            </div>
        @endif

        <div class="form-group actions">
            <button type="submit" class="edit-button">Save Changes</button>
        </div>
    </form>
@endsection
