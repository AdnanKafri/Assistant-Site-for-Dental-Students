@extends('layouts.admin')

@section('title', 'Add State')

@section('header', 'Add State')

@section('content')
    <div class="container">
        <!-- عرض رسائل النجاح -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

    <!-- عرض رسائل الخطأ -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.state.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="images">Add Photos</label>
                <input type="file" name="images[]" id="images" class="form-control-file" multiple>
            </div>
            <button type="submit" class="btn btn-success">Add State</button>
        </form>
    </div>
@endsection
