{{--resources/views/admin/marks/index.blade.php--}}
@extends('layouts.admin')

@section('title', 'Admin - Marks')

@section('header', 'Students Marks')

@section('content')
    <div class="container">

        <!-- عرض رسائل النجاح والأخطاء -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="content">
            <div class="table-container">
                @php
                    $marksByStudent = $marks->groupBy(function($mark) {
                        return isset($mark->student->user) ? $mark->student->user->name : 'N/A';
                    });
                @endphp

                @foreach($marksByStudent as $studentName => $studentMarks)
                    <div class="student-marks-section mb-4">
                        <h3 class="student-name bg-primary text-white p-2 rounded">{{ $studentName }}</h3>
                        <table class="table table-striped table-bordered mt-2">
                            <thead class="thead-dark">
                            <tr>
                                <th>Subject</th>
                                <th>Mark</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($studentMarks as $mark)
                                <tr>
                                    <td>{{ isset($mark->subject) ? $mark->subject->name : 'N/A' }}</td>
                                    <td>{{ $mark->mark }}</td>
                                    <td class="actions">
                                        <a href="{{ route('admin.marks.edit', $mark->m_id) }}" class="edit-button">Edit</a>
                                        <form action="{{ route('admin.marks.delete', $mark->m_id) }}" method="POST" style="display:inline;" class="delete-mark-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-mark-button">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

<style>
    .student-marks-section {
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 15px;
    }
    .student-name {
        font-size: 1.5em;
    }
    .table-container {
        margin-top: 20px;
    }
    .actions form {
        display: inline-block;
        margin: 0;
    }
</style>
