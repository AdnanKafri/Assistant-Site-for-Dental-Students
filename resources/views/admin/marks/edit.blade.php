{{--resources/views/admin/marks/edit.blade.php--}}
@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>تعديل العلامة</h1>
        <form action="{{ route('admin.marks.update', $mark->m_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="student">الطالب</label>
                <input type="text" class="form-control" id="student" value="{{ $mark->student->user->name }}" disabled>
            </div>
            <div class="form-group">
                <label for="subject">المادة</label>
                <input type="text" class="form-control" id="subject" value="{{ $mark->subject->name }}" disabled>
            </div>
            <div class="form-group">
                <label for="mark">العلامة</label>
                <input type="number" class="form-control" id="mark" name="mark" value="{{ $mark->mark }}">
            </div>
            <button type="submit" class="btn btn-success">حفظ</button>
        </form>
    </div>
@endsection
