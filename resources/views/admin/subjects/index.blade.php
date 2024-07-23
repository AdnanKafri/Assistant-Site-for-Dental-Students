{{--resources/views/admin/subjects/index.blade.php--}}
@extends('layouts.admin')
@section('title', 'Admin - Subjects')

@section('header', 'Subjects')

@section('content')
    <div class="content">


        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="content">
            <a href="{{ route('admin.subjects.create') }}" class="add-subject-button">Add Subject</a>

            <div class="table-container">

        <table class="table-container">

            <thead>

            <tr>

                <th>Subject Name</th>

                <th>Subject Year</th>

                <th>Actions</th>

            </tr>

            </thead>

            <tbody>

            @foreach($subjects as $subject)

                <tr>

                    <td>{{ $subject->name }}</td>

                    <td>{{ $subject->subject_year }}</td>

                    <td class="actions">
                        <a href="{{ route('admin.subjects.edit', $subject->su_id) }}" class="edit-button">Edit</a>

                        <form action="{{ route('admin.subjects.delete', $subject->su_id) }}" method="POST" style="display:inline;" class="delete-subject-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-subject-button">Delete</button>
                        </form>
                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

        </div>
    </div>

@endsection
