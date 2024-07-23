{{--resources/views/admin/users/index.blade.php--}}
@extends('layouts.admin')

@section('title', 'Admin - Users')

@section('header', 'Users')

@section('content')

    <div class="content">
    <button id="addUserButton" class="add-user-button">Add User</button>
        <h3>Supervisors</h3>
        <div class="table-container">
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($supervisors as $supervisor)
                    <tr>
                        <td>{{ $supervisor->id }}</td>
                        <td>{{ $supervisor->name }}</td>
                        <td>{{ $supervisor->email }}</td>
                        <td>{{ $supervisor->role }}</td>
                        <td>{{ $supervisor->phone }}</td>
                        <td class="actions">
                            <a href="{{ route('admin.users.show', ['type' => 'supervisor', 'id' => $supervisor->id]) }}" class="edit-button">Edit</a>
                            <form action="{{ route('admin.users.delete', ['type' => 'supervisor', 'id' => $supervisor->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-user-button">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <h3>Students</h3>
        <div class="table-container">
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->role }}</td>
                        <td>{{ $student->phone }}</td>
                        <td class="actions">
                            <a href="{{ route('admin.users.show', ['type' => 'student', 'id' => $student->id]) }}" class="edit-button">Edit</a>
                            <form action="{{ route('admin.users.delete', ['type' => 'student', 'id' => $student->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-user-button">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <h3>Patients</h3>
        <div class="table-container">
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($patients as $patient)
                    <tr>
                        <td>{{ $patient->id }}</td>
                        <td>{{ $patient->name }}</td>
                        <td>{{ $patient->email }}</td>
                        <td>{{ $patient->role }}</td>
                        <td>{{ $patient->phone }}</td>
                        <td class="actions">
                            <a href="{{ route('admin.users.show', ['type' => 'patient', 'id' => $patient->id]) }}" class="edit-button">Edit</a>
                            <form action="{{ route('admin.users.delete', ['type' => 'patient', 'id' => $patient->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-user-button">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Repeat for Students and Patients -->
@endsection
