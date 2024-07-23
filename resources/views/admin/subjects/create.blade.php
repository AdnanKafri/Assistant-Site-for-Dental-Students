{{--resources/views/admin/subjects/create.blade.php--}}
@extends('layouts.admin')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

@section('content')
    <div class="container">

        <h1>إضافة مادة جديدة</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.subjects.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">اسم المادة</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="subject_year">السنة الدراسية</label>
                <input type="number" class="form-control" id="subject_year" name="subject_year" value="{{ old('subject_year') }}" required>
            </div>

            <button type="submit" class="btn btn-primary">إضافة</button>
        </form>

    </div>

@endsection
