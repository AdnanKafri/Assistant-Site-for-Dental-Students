@extends('layouts.navb')

@section('title', 'طلب معالجة')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@section('content')
    {{--<link rel="stylesheet" href="{{ asset('css/cs.css') }}">--}}
    <style>
        .intro-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            margin-bottom: 20px;
        }
        .rtl {
            direction: rtl;
            text-align: right;
        }
        .intro-box {
            background-color: #f8f9fa;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 600px;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: flex-start;
            padding: 20px;
        }

        .card {
            border: 1px solid #ddd;
            background-color: #fff;
            padding: 16px;
            margin: 16px;
            width: 300px;
            text-align: center;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
            border-radius: 8px;
        }

        .card img {
            max-width: 100%;
            border-radius: 8px;
            margin-bottom: 12px;
        }

        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transform: translateY(-5px);
        }
    </style>

    <div class="intro-container rtl">
        <div class="intro-box">
            <h1>من فضلك قم بإختيار المشرف الذي تريد ارسال الحاله له</h1>
            <p>ليقوم بتقييمها واتخاذ الاجراء المناسب حيالها.</p>
        </div>
    </div>

    <div class="container">
        @foreach($supervisors as $index => $supervisor)
            <div class="card"
                 id="card-{{ $index }}"
                 data-supervisor-id="{{ $supervisor->id }}"
                 data-name="{{ $supervisor->user->name }}">
                <img style="height: 300px; width: 300px;" src="{{ asset('storage/' . $supervisor->photo) }}" alt="{{ $supervisor->user->name }}">
                <h2>{{ $supervisor->user->name }}</h2>
            </div>
        @endforeach
    </div>

    <form id="request-form" method="POST" action="{{ route('submit_request') }}">
        @csrf
        <input type="hidden" name="post_id" value="{{ request()->query('post_id') }}">
        <input type="hidden" name="supervisor_id" id="supervisor-id-input">
    </form>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('js/js.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var cards = document.querySelectorAll('.card');
            var supervisorIdInput = document.getElementById('supervisor-id-input');

            cards.forEach(function (card) {
                card.addEventListener('click', function () {
                    var name = card.getAttribute('data-name');
                    var supervisorId = card.getAttribute('data-supervisor-id');

                    Swal.fire({
                        title: 'تأكيد اختيار المشرف',
                        text: 'هل أنت متأكد أنك تريد اختيار ' + name + ' كمشرف؟',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'نعم، اخترت هذا المشرف',
                        cancelButtonText: 'إلغاء'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            supervisorIdInput.value = supervisorId;
                            document.getElementById('request-form').submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
