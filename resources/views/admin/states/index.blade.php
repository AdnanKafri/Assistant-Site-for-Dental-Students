{{--resources/views/admin/states/index.blade.php--}}
@extends('layouts.admin')

@section('title', 'All States')

@section('header', 'All States')

@section('content')
    <div class="container">
        <a href="{{ route('admin.state.create') }}" class="btn btn-primary mb-3">Add State</a>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($states as $state)
                <tr>
                    <td>{{ $state->t_id }}</td>
                    <td>{{ $state->name }}</td>
                    <td>{{ $state->description }}</td>
                    <td>
                        <a href="{{ route('admin.state.edit', $state->t_id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.state.destroy', $state->t_id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
