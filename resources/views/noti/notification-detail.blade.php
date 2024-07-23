@extends("layouts.navb")

@section('title', 'تفاصيل الإشعار')

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

@section('content')
    <div class="container mx-auto rtl mt-5 p-4">
        @if(auth()->user()->role=='supervisor')
            <h1 class="text-center text-3xl font-bold mb-4">تفاصيل الإشعار</h1>
            <p class="text-lg mb-4">
                قم بتقييم الحالة من فضلك ثم اتخذ الإجراء المناسب حيالها إذا كانت مقبولة أم مرفوضة.
            </p>
            <p class="text-lg mb-4">
                وفي حال كانت الحالة معقدة أو تحتاج إلى مراجعة إجبارية في الجامعة (لإجراء صورة أو طبعة أو غيرها) يمكنك اختيار الخيار "مراجعة".
            </p>
        @endif

        @if(session('success'))
            <div class="alert alert-success bg-green-100 text-green-700 p-4 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger bg-red-100 text-red-700 p-4 mb-4 rounded">
                {{ session('error') }}
            </div>
        @endif

        <div class="card mb-3 bg-white shadow-md rounded p-4">
            <div class="card-body">
                <p class="card-text text-xl mb-4">{{ $notification1->Description }}</p>
                <p class="card-text text-lg mb-2">اسم الطالب: {{ $notification1->student && $notification1->student->user ? $notification1->student->user->name : 'غير متوفر' }}</p>
                <p class="card-text text-lg mb-4">اسم المريض: {{ $notification1->patient && $notification1->patient->user ? $notification1->patient->user->name : 'غير متوفر' }}</p>
                <hr class="mb-4">
                <div class="row flex flex-wrap">
                    @foreach (json_decode($notification1->post->images) as $image)
                        <div class="col-md-4 mb-3 p-2">
                            <img src="{{ asset('storage/' . $image) }}" class="img-thumbnail h-auto w-auto rounded shadow-md" alt="صورة المنشور">
                        </div>
                    @endforeach
                </div>

                @if(auth()->user()->role == 'supervisor' && $notification1->type == 0)
                    <hr class="my-4">
                    <form action="{{ route('notifications.update', $notification1->n_id) }}" method="POST" class="flex flex-col items-center">
                        @csrf
                        @method('PUT')
                        <div class="btn-group flex justify-center space-x-4" role="group">
                            <button type="submit" name="action" value="accept" class="btn btn-success bg-green-500 text-white py-2 px-4 rounded hover:bg-green-700">قبول</button>&nbsp;
                            <button type="submit" name="action" value="reject" class="btn btn-danger bg-red-500 text-white py-2 px-4 rounded hover:bg-red-700">رفض</button>
                            <button type="submit" name="action" value="review" class="btn btn-warning bg-yellow-500 text-white py-2 px-4 rounded hover:bg-yellow-700">طلب مراجعة</button>
                        </div>
                    </form>
                @elseif(auth()->user()->role == 'supervisor')
                    <p class="text-center text-lg text-gray-700 mt-4">تم اتخاذ إجراء بشأن هذا الإشعار بالفعل.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
