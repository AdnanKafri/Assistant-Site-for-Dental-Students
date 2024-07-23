<!-- resources/views/admin/marks.blade.php -->
@extends('layouts.admin')

@section('title', 'Admin - Marks')

@section('header', 'Marks')

@section('content')
    <h3>Marks Management</h3>
    <!-- هنا يمكن إضافة محتوى صفحة العلامات مثل عرض العلامات أو إدارتها -->
    <div class="table-container">
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Student Name</th>
                <th>Subject</th>
                <th>Marks</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($marks as $mark)
                <tr>
                    <td>{{ $mark->id }}</td>
                    <td>{{ $mark->student_name }}</td>
                    <td>{{ $mark->subject }}</td>
                    <td>{{ $mark->marks }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.marks.edit', $mark->id) }}" class="edit-button">Edit</a>
                        <form action="{{ route('admin.marks.delete', $mark->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-button">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
