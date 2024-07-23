@extends('layouts.navb')

@section('title', 'Profile')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Open image modal and display images
        function openModal(imageElement) {
            const modal = document.getElementById('imageModal');
            const carouselInner = document.getElementById('carouselImages');
            const images = imageElement.closest('.case-images').querySelectorAll('img');
            let carouselContent = '';

            images.forEach((img, index) => {
                carouselContent += `
                    <div class="carousel-item ${index === 0 ? 'active' : ''}">
                        <img src="${img.src}" class="d-block w-100" alt="...">
                    </div>
                `;
            });

            carouselInner.innerHTML = carouselContent;
            const imageModal = new bootstrap.Modal(modal);
            imageModal.show();
        }

        document.querySelectorAll('.case-image').forEach(image => {
            image.addEventListener('click', function() {
                openModal(this);
            });
        });

        const sortOptions = document.getElementById('sort-options');
        const postsContainer = document.getElementById('posts-container');

        function sortPosts() {
            const sortBy = sortOptions.value;
            const posts = Array.from(postsContainer.getElementsByClassName('case-container'));

            posts.sort((a, b) => {
                if (sortBy === 'created_at_desc') {
                    return new Date(b.getAttribute('data-created-at')) - new Date(a.getAttribute('data-created-at'));
                } else if (sortBy === 'created_at_asc') {
                    return new Date(a.getAttribute('data-created-at')) - new Date(b.getAttribute('data-created-at'));
                }
            });

            posts.forEach(post => postsContainer.appendChild(post));
        }

        sortOptions.addEventListener('change', sortPosts);

        // Set default sort to "created_at_desc" and sort posts initially
        sortOptions.value = 'created_at_desc';
        sortPosts();

        // Edit post action
        document.querySelectorAll('.edit-post').forEach(button => {
            button.addEventListener('click', function(e) {
                const postId = e.target.getAttribute('data-post-id');
                window.location.href = `/posts/${postId}/edit`;
            });
        });

        // Delete post action
        document.querySelectorAll('.delete-post').forEach(button => {
            button.addEventListener('click', function(e) {
                const postId = e.target.getAttribute('data-post-id');
                Swal.fire({
                    title: 'هل أنت متأكد؟',
                    text: "لن تتمكن من التراجع عن هذا!",
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonColor: '#3085d6',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'نعم، احذفه!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/posts/${postId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        }).then(response => {
                            if (response.ok) {
                                Swal.fire(
                                    'تم الحذف!',
                                    'تم حذف المنشور بنجاح.',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            } else {
                                response.text().then(text => {
                                    try {
                                        const data = JSON.parse(text);
                                        Swal.fire(
                                            'خطأ!',
                                            data.message || 'حدث خطأ أثناء محاولة حذف المنشور.',
                                            'error'
                                        );
                                    } catch {
                                        Swal.fire(
                                            'تم الحذف!',
                                            'تم حذف المنشور بنجاح.',
                                            'success'
                                        ).then(() => {
                                            location.reload();
                                        });
                                    }
                                }).catch(() => {
                                    Swal.fire(
                                        'خطأ!',
                                        'حدث خطأ أثناء محاولة حذف المنشور.',
                                        'error'
                                    );
                                });
                            }
                        }).catch(() => {
                            Swal.fire(
                                'خطأ!',
                                'حدث خطأ أثناء محاولة حذف المنشور.',
                                'error'
                            );
                        });
                    }
                });
            });
        });

        // Send request action
        document.querySelectorAll('.send-request').forEach(button => {
            button.addEventListener('click', function(e) {
                const postId = e.target.getAttribute('data-post-id');
                window.location.href = `/request-treatment?post_id=${postId}`;
            });
        });

        // Send second request action
        document.querySelectorAll('.send-request2').forEach(button => {
            button.addEventListener('click', function(e) {
                const postId = e.target.getAttribute('data-post-id');
                window.location.href = `/request-treatment2?post_id=${postId}`;
            });
        });
    });
</script>

<style>
    .rtl {
        direction: rtl;
        text-align: right;
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
        background-color: #f9f9f9;
        position: relative;
    }

    .case-container .status-indicator {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        position: absolute;
        bottom: 15px;
        left: 15px;
        border: 2px solid #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        font-weight: bold;
        color: #ffffff;
    }

    .case-container .status-indicator[data-state="0"] {
        background-color: blue;
    }

    .case-container .status-indicator[data-state="1"] {
        background-color: red;
    }

    .case-container .status-indicator[data-state="2"] {
        background-color: green;
    }

    .case-container .status-indicator[data-state="3"] {
        background-color: orange;
    }

    .case-container .timestamp {
        font-size: 0.8rem;
        color: #555;
        position: absolute;
        bottom: 10px;
        right: 10px;
        font-weight: bold;
    }

    .modal-body img {
        max-width: 100%;
        height: auto;
    }

    main, aside {
        margin-top: 0;
    }

    .settings-menu {
        display: none;
        position: absolute;
        top: 35px;
        right: 0;
        background: white;
        border: 1px solid #ddd;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        z-index: 10;
    }

    .settings-menu.hidden {
        display: none;
    }

    .settings-menu button {
        display: block;
        width: 100%;
        padding: 10px;
        text-align: left;
        background: none;
        border: none;
        cursor: pointer;
    }

    .settings-menu button:hover {
        background: #f1f1f1;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
    <div class="container mx-auto px-4 py-8 mt-24 rtl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @if(auth()->user()->role!='supervisor')
            <div class="md:col-span-1 ml-10">
                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-4 text-black">نشر حالة جديدة</h2>
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="t_id" class="block text-gray-700 text-sm font-bold mb-2">نوع الحالة:</label>
                                <select name="t_id" id="t_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    @foreach($status as $type)
                                        <option value="{{ $type->t_id }}" {{ old('t_id') == $type->t_id ? 'selected' : '' }}>{{ $type->name }}</option>
                                    @endforeach
                                    <option value="0" {{ old('t_id') == '0' ? 'selected' : '' }}>غير ذلك (وضحها بالصور والوصف)</option>
                                </select>
                                @error('t_id')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="Description" class="block text-gray-700 text-sm font-bold mb-2">وصف الحالة:</label>
                                <textarea name="Description" id="Description" placeholder="أدخل وصف الحالة هنا" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{ old('Description') }}</textarea>
                                @error('Description')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="images" class="block text-gray-700 text-sm font-bold mb-2">الصور:</label>
                                <input type="file" name="images[]" id="images" multiple class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @error('images')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                                @error('images.*')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">نشر</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif

            <div class="md:col-span-1">
                <div class="border profile-image-container mb-8 text-center p-4 bg-white rounded-lg shadow-md">
                    <label for="profile-image" class="img-profile relative">
                        @if(auth()->user()->role == 'patient')
                            <img src="{{asset('images/pat icon.png')}}" alt="Profile Image">
                        @elseif(auth()->user()->role == 'student')
                            <img src="{{asset('images/stu icon.png')}}" alt="Profile Image">
                        @else
                            <img src="{{asset('images/super icon.png')}}" alt="Profile Image">
                        @endif
                    </label>
                    <div>
                        <h1 class="text-2xl font-bold mb-2 text-black">{{ $user->name }}</h1>
                        <h3>{{ $user->email }}</h3>
                        <h3>{{ $user->phone }}</h3>
                    </div>
                    <div>
                        <a class="rounded" href="{{ route('profile.edit') }}">
                            تعديل بيانات الخصوصية
                        </a>
                    </div>
                </div>
                @if(auth()->user()->role!='supervisor')
                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-4 text-black">حالاتي المنشورة</h2>
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        @if($posts->isEmpty())
                            <p class="text-gray-400">لا توجد حالات منشورة.</p>
                        @else
                            <div class="mb-6 flex justify-end">
                                <label for="sort-options" class="mr-2 text-sm">فرز حسب :</label>
                                <select id="sort-options" class="px-4 py-2 border rounded text-xs">
                                    <option value="created_at_desc">الأحدث</option>
                                    <option value="created_at_asc">الأقدم</option>
                                </select>
                            </div>
                            <div class="space-y-6" id="posts-container">
                                @foreach($posts as $post)
                                    <div class="case-container" data-created-at="{{ $post->created_at }}" data-user-role="{{ $post->user_role }}" data-state="{{ $post->state }}" data-post-id="{{ $post->po_id }}">
                                        <h2 class="text-2xl font-semibold mb-4">
                                            @if($post->user_role == 'student')
                                                طلب حالة
                                            @else
                                                طلب معالجة
                                            @endif
                                        </h2>
                                        <p class="text-gray-700 mb-4">{{ $post->StatusType->name }}</p>
                                        <p class="text-gray-700 mb-4">{{ $post->Description }}</p>
                                        <div class="case-images mb-4">
                                            @foreach(json_decode($post->images, true) as $image)
                                                <img src="{{ asset('storage/' . $image) }}" alt="Post Image" class="case-image rounded shadow-sm" onclick="openModal(this)">
                                            @endforeach
                                        </div>
                                        <div class="actions-and-rating text-right">
                                            @if(auth()->user()->id == $post->id)
                                                <button class="delete-post bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600" data-post-id="{{ $post->po_id }}">🗑 حذف</button>
                                                @if($post->state=='0')
                                                <button class="edit-post bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" data-post-id="{{ $post->po_id }}">🖉 تعديل</button>
                                                @endif
                                            @elseif(auth()->user()->role == 'student' && $post->user_role == 'patient')
                                                @if($post->state == 0)
                                                    <button class="send-request bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" data-post-id="{{ $post->po_id }}">إرسال طلب</button>
                                                @endif
                                            @elseif(auth()->user()->role == 'patient' && $post->user_role == 'student')
                                                <button class="send-request2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" data-post-id="{{ $post->po_id }}">إرسال طلب</button>
                                            @endif
                                        </div>
                                        <br><br>
                                        <p class="timestamp">{{ $post->created_at->diffForHumans() }}</p>
                                        <div class="status-indicator flex top-0" data-state="{{ $post->state }}">
                                            {{ $post->state == 0 ? 'متاحة' : ($post->state == 1 ? 'مرفوضة' : ($post->state == 2 ? 'منتهية' : 'معلقة') ) }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                    @endif
            </div>
        </div>
    </div>
    <!-- Modal for image display -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">صور الحالة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner" id="carouselImages"></div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


