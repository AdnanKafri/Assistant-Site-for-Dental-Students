@extends('layouts.admin')

@section('title', 'Edit State')

@section('header', 'Edit State')

@section('content')
    <div class="container">
        <form action="{{ route('admin.state.update', $state->t_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $state->name }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control">{{ $state->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="current_images">Current Photos</label>
                <div>
                    @foreach($state->images as $image)
                        <div class="photo-block">
                            <img src="{{ asset('storage/' . $image) }}" alt="{{ $state->name }}" width="100">
                            <input type="checkbox" name="delete_images[]" value="{{ $image }}"> Delete
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="form-group">
                <label for="images">Add New Photos</label>
                <input type="file" name="images[]" id="images" class="form-control-file" multiple>
            </div>
            <button type="submit" class="btn btn-success">Update State</button>
        </form>
    </div>
@endsection
