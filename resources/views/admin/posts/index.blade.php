<!-- resources/views/admin/posts/index.blade.php -->
@extends('layouts.admin')

@section('title', 'Admin - Posts')

@section('header', 'Posts')

@section('content')
    <h3>Posts Management</h3>
    <div class="table-container">
        <table>
            <thead>
            <tr>
                <th>Post ID</th>
                <th>Publisher Id's</th>
                <th>Publisher</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->po_id }}</td>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.posts.show', $post->po_id) }}" class="view-button">View</a>
                        <a href="{{ route('admin.posts.edit', $post->po_id) }}" class="edit-button">Edit</a>
                        <form action="{{ route('admin.posts.delete', $post->po_id) }}" method="POST" style="display:inline;">
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
