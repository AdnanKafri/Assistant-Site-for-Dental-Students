@extends("layouts.navb")
@section('title', 'About')
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

<div class="container mx-auto px-4 py-8 mt-28 rtl">
    <h1 class="text-4xl font-bold text-center mb-8">حولنا</h1>
    <div class="bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4">من نحن </h2>
        <p class="text-gray-700 mb-4">Dental Aid هي منصة مخصصة لدعم طلاب طب الأسنان في تدريبهم العملي من خلال ربطهم بالمرضى الذين يحتاجون إلى رعاية الأسنان. مهمتنا هي تعزيز جودة تعليم طب الأسنان وتوفير رعاية أسنان يمكن الوصول إليها للمجتمع.</p>

        <h2 class="text-2xl font-semibold mb-4">مهمتنا</h2>
        <p class="text-gray-700 mb-4">مهمتنا هي سد الفجوة بين طلاب طب الأسنان والمرضى. نحن نهدف إلى إنشاء شبكة تفيد الطلاب والمرضى على حد سواء من خلال توفير منصة للتدريب العملي ورعاية الأسنان .</p>

        <h2 class="text-2xl font-semibold mb-4">رؤيتنا</h2>
        <p class="text-gray-700 mb-4">نحن نتصور مستقبلًا يتمتع فيه طلاب طب الأسنان بفرص كبيرة للتدريب العملي، ويتمتع المرضى بسهولة الوصول إلى رعاية أسنان عالية الجودة. ومن خلال الابتكار والتكنولوجيا، نسعى جاهدين لتحسين تعليم طب الأسنان والصحة العامة.</p>

        <h2 class="text-2xl font-semibold mb-4">قيمنا</h2>
        <ul class="list-disc list-inside text-gray-700 mb-4">
            <li>الالتزام بالتعليم</li>
            <li>رعاية أسنان عالية الجودة</li>
            <li>المشاركة المجتمعية</li>
            <li>الابتكار والتكنولوجيا</li>
        </ul>
    </div>
</div>



<div class="container mx-auto px-4 py-8 mt-28">
    <h1 class="text-4xl font-bold text-center mb-8">About Us</h1>
    <div class="bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4">Who We Are</h2>
        <p class="text-gray-700 mb-4">Dental Aid is a platform dedicated to supporting dental students in their
            practical training by connecting them with patients who need dental care. Our mission is to enhance the
            quality of dental education and provide accessible dental care to the community.</p>

        <h2 class="text-2xl font-semibold mb-4">Our Mission</h2>
        <p class="text-gray-700 mb-4">Our mission is to bridge the gap between dental students and patients. We aim
            to create a network that benefits both students and patients by providing a platform for practical
            training and affordable dental care.</p>

        <h2 class="text-2xl font-semibold mb-4">Our Vision</h2>
        <p class="text-gray-700 mb-4">We envision a future where dental students have ample opportunities for
            hands-on training, and patients have easy access to high-quality dental care. Through innovation and
            technology, we strive to improve dental education and public health.</p>

        <h2 class="text-2xl font-semibold mb-4">Our Values</h2>
        <ul class="list-disc list-inside text-gray-700 mb-4">
            <li>Commitment to Education</li>
            <li>Quality Dental Care</li>
            <li>Community Engagement</li>
            <li>Innovation and Technology</li>
        </ul>
    </div>
</div>
@endsection
