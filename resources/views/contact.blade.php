@extends("layouts.navb")
@section('title', 'Contact Us')

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
    </style>
    <div class="container mx-auto px-4  mt-28 rtl">
        <h1 class="text-4xl font-bold text-center mb-4">اتصل بنا</h1>
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-4">ابقى على تواصل</h2>
            <p class="text-gray-700 mb-4">إذا كانت لديك أي أسئلة أو كنت بحاجة إلى مزيد من المعلومات، فلا تتردد في التواصل معنا من خلال تفاصيل الاتصال التالية أو عن طريق ملء نموذج الاتصال.</p>

            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-2">بيانات المتصل</h3>
                <p class="text-gray-700 mb-2">البريد الإلكتروني:</p>
                <p class="text-gray-700 mb-2">dental-aid@aid.com</p>
                <p class="text-gray-700 mb-2">الهاتف:</p>
                <p class="text-gray-700 mb-2">+96398657423</p>
                <p class="text-gray-700">العنوان:</p>
                <p class="text-gray-700">سوريا - حماه (ضاحية ابي الفداء - مشاع جنوب الملعب)</p>
            </div>

            <h2 class="text-2xl font-semibold mb-4">نموذج الاتصال</h2>
            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-gray-700">الاسم</label>
                    <input type="text" id="name" name="name" class="w-full p-2 border border-gray-300 rounded-lg"
                           value="{{ auth()->check() ? auth()->user()->name : '' }}" required>
                </div>
                <div>
                    <label for="email" class="block text-gray-700">البريد الإلكتروني</label>
                    <input type="email" id="email" name="email" class="w-full p-2 border border-gray-300 rounded-lg"
                           value="{{ auth()->check() ? auth()->user()->email : '' }}" required>
                </div>
                <div>
                    <label for="message" class="block text-gray-700">الرسالة</label>
                    <textarea id="message" name="message" class="w-full p-2 border border-gray-300 rounded-lg"
                              rows="4" required></textarea>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">إرسال</button>
            </form>
        </div>
    </div>

    <div class="container mx-auto px-4 mt-28">
        <h1 class="text-4xl font-bold text-center mb-8">@yield('title')</h1>
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-4">Contact Form</h2>
            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-gray-700">Name</label>
                    <input type="text" id="name" name="name" class="w-full p-2 border border-gray-300 rounded-lg"
                           value="{{ auth()->check() ? auth()->user()->name : '' }}" required>
                </div>
                <div>
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" id="email" name="email" class="w-full p-2 border border-gray-300 rounded-lg"
                           value="{{ auth()->check() ? auth()->user()->email : '' }}" required>
                </div>
                <div>
                    <label for="message" class="block text-gray-700">Message</label>
                    <textarea id="message" name="message" class="w-full p-2 border border-gray-300 rounded-lg"
                              rows="4" required></textarea>
                </div>
                <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Send</button>
            </form>
        </div>
    </div>
@endsection
