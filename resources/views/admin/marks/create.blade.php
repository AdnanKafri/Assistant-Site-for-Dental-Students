@extends('layouts.admin')

@section('title', 'Admin - Add Mark')

@section('header', 'Add Student Mark')

@section('content')
    <div class="container">
        <h1>إضافة علامة جديدة</h1>
        <form action="{{ route('admin.marks.store') }}" method="POST">
            @csrf
            <table class="table">
                <thead>
                <tr>
                    <th>الطالب</th>
                    <th>المادة</th>
                    <th>العلامة</th>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $student)
                    @foreach($subjects as $subject)
                        @php
                            $mark = $student->marks->where('su_id', $subject->su_id)->first();
                        @endphp
                        <tr>
                            <td>{{ $student->user->name }}</td>
                            <td>{{ $subject->name }}</td>
                            <td>
                                @if($mark)
                                    {{ $mark->mark }}
                                @else
                                    <input type="number" name="marks[{{ $student->id }}][{{ $subject->su_id }}]" min="0" max="100" class="form-control">
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-success">حفظ</button>
        </form>
    </div>
@endsection
