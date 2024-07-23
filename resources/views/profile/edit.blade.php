@extends('layouts.navb')
@section('noti')
    <style>
        .icon-button {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            color: #333333;
            /*background: #dddddd;*/
            border: none;
            outline: none;
            border-radius: 50%;
        }

        .icon-button:hover {
            cursor: pointer;
        }

        .icon-button:active {
            background: #cccccc;
        }

        .icon-button__badge {
            position: absolute;
            top: -10px;
            right: -10px;
            width: 25px;
            height: 25px;
            background: red;
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
        }

        #notificationList {
            left: 0;
            right: auto;
        }

        .hidden {
            display: none;
        }
    </style>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const notificationButton = document.getElementById('notificationButton');
            const notificationList = document.getElementById('notificationList');

            notificationButton.addEventListener('click', function() {
                notificationList.classList.toggle('hidden');
            });

            document.addEventListener('click', function(event) {
                const isClickInside = notificationButton.contains(event.target) || notificationList.contains(event.target);

                if (!isClickInside) {
                    notificationList.classList.add('hidden');
                }
            });

            const deleteButtons = document.querySelectorAll('.delete-button');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.stopPropagation(); // Prevent the click from closing the menu

                    const notificationId = this.getAttribute('data-id');

                    fetch(`/notifications/${notificationId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                window.location.reload(); // Reload the page on successful delete
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>
    <div class="relative">
        <button id="notificationButton" type="button" class="icon-button block px-4 py-2 text-black hover:bg-gray-700 hover:text-white rounded">
            <span class="material-icons flex justify-center">notifications</span>
            @if($count)
                <span class="icon-button__badge">{{$count}}</span>
            @endif
        </button>

        <div id="notificationList" class="absolute left-0 mt-2 w-64 bg-white border border-gray-300 rounded shadow-lg hidden">
            <ul>
                @foreach ($notifications as $notification)
                    <li class="px-4 py-2 border-b border-gray-300 flex justify-between items-center">
                        <a href="{{ route('notifications.show', $notification->n_id) }}" class="block text-black hover:bg-blue-400 flex-grow">
                            {{ $notification->Description }}
                        </a>
                        <button class="delete-button text-red-500 hover:text-red-700" data-id="{{ $notification->n_id }}">
                            <span class="material-icons">delete</span>
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

@endsection

<x-app-layout>
    @section('content')
        <div class="py-12 background">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                @if(auth()->user()->role == 'student')
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @if($marks->isEmpty())
                                @include('roles.subjects', ['subjects' => $subjects])
                            @else
                                <h2 class="text-lg font-medium text-gray-900">
                                    {{ __('علاماتي') }}
                                </h2>
                                <table class="table-auto w-full mt-4">
                                    <thead>
                                    <tr>
                                        <th class="px-4 py-2">{{ __('اسم المادة') }}</th>
                                        <th class="px-4 py-2">{{ __('العلامة') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($marks as $mark)
                                        <tr>
                                            <td class="border px-4 py-2">{{ $mark->subject->name }}</td>
                                            @if($mark->mark)
                                                <td class="border px-4 py-2">{{ $mark->mark }}</td>
                                            @else
                                                <td class="border px-4 py-2">
                                                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="addMark({{ $mark->subject->su_id }})">
                                                        أدخل العلامة
                                                    </button>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <form id="addMarkForm" method="post" action="{{ route('subject.update', ['id' => auth()->user()->id]) }}" style="display: none;">
            @csrf
            <input type="hidden" id="subjectId" name="subject_id">
            <input type="hidden" id="mark" name="mark">
        </form>
    @endsection
</x-app-layout>
