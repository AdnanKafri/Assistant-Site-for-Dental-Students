<!-- resources/views/admin/posts/show.blade.php -->
@extends('layouts.admin')

@section('title', 'Admin - View Post')

@section('header', 'Post Details')

@section('content')
    <h3>Post Details</h3>
    <div class="post-details">
        <p><strong>ID:</strong> {{ $post->id }}</p>
        <p><strong>Publisher Id's</strong> {{ $post->id }}</p>
        <p><strong>Publisher</strong> {{ $post->user->name }}</p>
        <p><strong>Description</strong> {{ $post->Description }}</p>
        <p><strong>Post State:</strong>
            @if ($post->state == 0)
                متاحة
            @elseif ($post->state == 1)
                مرفوضة
            @elseif ($post->state == 2)
                منتهية
            @elseif ($post->state == 3)
                معلقة
            @endif
        </p>
        <p><strong>Post Type:</strong>
            @if ($postType == 'student')
                طلب حالة
            @elseif ($postType == 'patient')
                طلب معالجة
            @endif
        </p>
        <p><strong>Images:</strong>
            @foreach(json_decode($post->images, true) as $image)
                <img src="{{ asset('storage/' . $image) }}" alt="Post Image" width="20%" height="20%" class="post-image">
            @endforeach
        </p>
    </div>
@endsection
