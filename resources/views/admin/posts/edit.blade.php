<!-- resources/views/admin/posts/edit.blade.php -->
@extends('layouts.admin')

@section('title', 'Admin - Edit Post')

@section('header', 'Edit Post')

@section('content')
    <form action="{{ route('admin.posts.update', $post->po_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="t_id" class="block text-gray-700 text-sm font-bold mb-2">Status Type:</label>
            <select name="t_id" id="t_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @foreach($statusTypes as $type)
                    <option value="{{ $type->t_id }}" {{ $post->t_id == $type->t_id ? 'selected' : '' }}>{{ $type->name }}</option>
                @endforeach
            </select>
            @error('t_id')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="Description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
            <textarea name="Description" id="Description" placeholder="Enter your description here" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $post->Description }}</textarea>
            @error('Description')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="images" class="block text-gray-700 text-sm font-bold mb-2">Images:</label>
            <input type="file" name="images[]" id="images" multiple class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('images')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
            @error('images.*')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Current Images:</label>
            @foreach(json_decode($post->images, true) as $image)
                <div class="current-image">
                    <img src="{{ asset('storage/' . $image) }}" alt="Post Image" class="post-image">
                    <input type="checkbox" name="delete_images[]" value="{{ $image }}"> Delete
                </div>
            @endforeach
        </div>
        <div class="mb-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update Post</button>
        </div>
    </form>
@endsection
