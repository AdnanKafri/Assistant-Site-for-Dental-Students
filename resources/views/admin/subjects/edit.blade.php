{{--resources/views/admin/subjects/edit.blade.php--}}
@extends('layouts.admin')

@section('content')
    <div class="container">

        <h1>تعديل المادة</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.subjects.update', $subject->su_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">اسم المادة</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $subject->name }}" required>
            </div>

            <div class="form-group">
                <label for="subject_year">السنة الدراسية</label>
                <input type="number" class="form-control" id="subject_year" name="subject_year" value="{{ $subject->subject_year }}" required>
            </div>

            <button type="submit" class="btn btn-primary">تحديث</button>
        </form>

    </div>

@endsection
