@extends('layouts.navb')

@section('title', 'Dental Cases')
@if(auth()->check())
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
@endif
@section('content')

    <style>

        .rtl {
            direction: rtl;
            text-align: right; /* اختيارية */
        }

        .case-image {
            width: 150px;
            height: auto;
            margin-right: 10px;
            cursor: pointer;
        }

        .case-images {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .case-container {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 10px;
            background-color: #f9f9f9;}

    </style>
    <div class="container mx-auto px-4 py-8 mt-28 rtl">
        <h1 class="text-4xl font-bold text-center mb-8">الحالات المرضية</h1>
        <div class="bg-white p-8 rounded-lg shadow-md">
            @foreach($statusTypes as $status)
                <div class="case-container">
                    <h2 class="text-2xl font-semibold mb-4">{{ $status->name }}</h2>
                    <div class="case-images mb-4">
                        @foreach($status->images as $image)
                            <img src="{{ asset('storage/' . $image) }}" alt="{{ $status->name }}" class="case-image rounded shadow-sm" onclick="openModal(this)">
                        @endforeach
                    </div>
                    <p class="text-gray-700 mb-8 text-2xl font-semibold">{{ $status->description }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">عرض الصور</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner" id="carouselImages">
                            <!-- Images will be dynamically inserted here -->
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal(image) {
            var container = image.parentElement;
            var images = container.getElementsByTagName("img");

            var carouselInner = document.getElementById("carouselImages");
            carouselInner.innerHTML = "";

            for (var i = 0; i < images.length; i++) {
                var imgSrc = images[i].src;
                var carouselItem = document.createElement("div");
                carouselItem.className = "carousel-item";
                if (images[i] === image) {
                    carouselItem.className += " active";
                }
                var img = document.createElement("img");
                img.className = "d-block w-100";
                img.src = imgSrc;
                carouselItem.appendChild(img);
                carouselInner.appendChild(carouselItem);
            }

            $("#imageModal").modal("show");
        }
    </script>
@endsection
