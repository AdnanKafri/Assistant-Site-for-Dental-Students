@extends('layouts.admin')

@section('title', 'Admin - Trashed Marks')
@section('header', 'Trashed Marks')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($marks->isEmpty())
        <p>No trashed marks found.</p>
    @else
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Student Name</th>
                <th>Subject</th>
                <th>Mark</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($marks as $mark)
                <tr>
                    <td>{{ $mark->m_id }}</td>
                    <td>{{ $mark->student->user->name }}</td>
                    <td>{{ $mark->subject->name }}</td>
                    <td>{{ $mark->mark }}</td>
                    <td>
                        <form action="{{ route('admin.marks.restore', $mark->m_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success">Restore</button>
                        </form>

                        <form action="{{ route('admin.marks.forceDelete', $mark->m_id) }}" method="POST" style="display:inline;">
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
