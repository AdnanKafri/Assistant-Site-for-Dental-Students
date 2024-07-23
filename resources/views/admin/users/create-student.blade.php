 @extends('layouts.admin')
    @section('title', 'Admin - Add Student')

    @section('header', 'Add Student')

    @section('content')
    <div class="content">
        <form action="{{ route('admin.users.storeStudent') }}" method="POST">
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

            <input type="hidden" name="role" value="student">
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" required>
            </div>
            <div>
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div>
                <label for="study_year">Study Year:</label>
                <input type="text" id="study_year" name="study_year" required>
            </div>
            <div>
                <label for="rating">Rating:</label>
                <input type="number" max="10" id="rating" name="rating" required>
            </div>
            <div>
                <label for="card">card</label> <!-- Ensure the name attribute matches the validated field -->
                <input type="text" id="card" name="card" required>
            </div>
            <button type="submit">Add Student</button>
        </form>
    </div>
    @endsection

