<!-- resources/views/admin/subjects/trashed.blade.php -->
@extends('layouts.admin')
@section('title', 'Admin - Trashed Subjects')

@section('header', 'Trashed Subjects')
@section('content')

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($subjects->isEmpty())
            <p>No trashed subjects found.</p>
    @else
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Subject Year</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($subjects as $subject)
                <tr>
                    <td>{{ $subject->su_id }}</td>
                    <td>{{ $subject->name }}</td>
                    <td>{{ $subject->subject_year }}</td>
                    <td>
                        <form action="{{ route('admin.subjects.restore', $subject->su_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success">Restore</button>
                        </form>

                        <form action="{{ route('admin.subjects.forceDelete', $subject->su_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete Permanently</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
