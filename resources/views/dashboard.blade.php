{{--<x-app-layout>--}}
{{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-gray-800 leading-tight">--}}
{{--            {{ __('Dashboard') }}--}}
{{--        </h2>--}}
{{--    </x-slot>--}}

{{--    <div class="py-12">--}}
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
{{--            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">--}}
{{--                <div class="p-6 text-gray-900">--}}
{{--                    {{ __("You're logged in!") }} <br>--}}
{{--                    Welcome {{ auth()->user()->name }} <br>--}}
{{--                    You are an {{ auth()->user()->role }} <br>--}}
{{--                    @if(auth()->user()->role=='student')--}}
{{--                        your rate is {{$average}}--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="mt-4">--}}
{{--                <a href="{{ route('notifications.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">--}}
{{--                    عرض الإشعارات--}}
{{--                </a>--}}
{{--            </div>--}}

{{--            @if (session('success'))--}}
{{--                <div class="bg-green-500 text-white p-4 rounded mb-4">--}}
{{--                    {{ session('success') }}--}}
{{--                </div>--}}
{{--            @endif--}}

{{--            @if (session('error'))--}}
{{--                <div class="bg-red-500 text-white p-4 rounded mb-4">--}}
{{--                    {{ session('error') }}--}}
{{--                </div>--}}
{{--            @endif--}}

{{--            <div class="create-post bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">--}}
{{--                <div class="p-6">--}}
{{--                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">--}}
{{--                        @csrf--}}
{{--                        <div class="mb-4">--}}
{{--                            <label for="t_id" class="block text-gray-700 text-sm font-bold mb-2">Status Type:</label>--}}
{{--                            <select name="t_id" id="t_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">--}}
{{--                                @foreach($statusTypes as $type)--}}
{{--                                    <option value="{{ $type->t_id }}">{{ $type->name }}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            @error('t_id')--}}
{{--                            <p class="text-red-500 text-xs italic">{{ $message }}</p>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                        <div class="mb-4">--}}
{{--                            <label for="Description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>--}}
{{--                            <textarea name="Description" id="Description" placeholder="Enter your description here" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>--}}
{{--                            @error('Description')--}}
{{--                            <p class="text-red-500 text-xs italic">{{ $message }}</p>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                        <div class="mb-4">--}}
{{--                            <label for="images" class="block text-gray-700 text-sm font-bold mb-2">Images:</label>--}}
{{--                            <input type="file" name="images[]" id="images" multiple class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">--}}
{{--                            @error('images')--}}
{{--                            <p class="text-red-500 text-xs italic">{{ $message }}</p>--}}
{{--                            @enderror--}}
{{--                            @error('images.*')--}}
{{--                            <p class="text-red-500 text-xs italic">{{ $message }}</p>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                        <div class="mb-4">--}}
{{--                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create Post</button>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="mt-4">--}}
{{--                <form action="{{ route('dashboard') }}" method="GET">--}}
{{--                    <label for="sort_type" class="block text-gray-700 text-sm font-bold mb-2">فرز حسب:</label>--}}
{{--                    <select name="sort_type" id="sort_type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">--}}
{{--                        <option value="created_at" {{ request('sort_type') == 'created_at' ? 'selected' : '' }}>وقت الإنشاء</option>--}}
{{--                        <option value="status_name" {{ request('sort_type') == 'status_name' ? 'selected' : '' }}>نوع الطلب</option>--}}
{{--                    </select>--}}

{{--                    <label for="sort_order" class="block text-gray-700 text-sm font-bold mb-2 mt-2">ترتيب الفرز:</label>--}}
{{--                    <select name="sort_order" id="sort_order" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">--}}
{{--                        <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>تنازلي</option>--}}
{{--                        <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>تصاعدي</option>--}}
{{--                    </select>--}}

{{--                    <label for="filter_status" class="block text-gray-700 text-sm font-bold mb-2 mt-2">فلترة حسب نوع الطلب:</label>--}}
{{--                    <select name="filter_status" id="filter_status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">--}}
{{--                        <option value="all" {{ request('filter_status') == 'all' ? 'selected' : '' }}>كل الطلبات</option>--}}
{{--                        <option value="طلب معالجة" {{ request('filter_status') == 'طلب معالجة' ? 'selected' : '' }}>طلب معالجة</option>--}}
{{--                        <option value="طلب حالة" {{ request('filter_status') == 'طلب حالة' ? 'selected' : '' }}>طلب حالة</option>--}}
{{--                    </select>--}}

{{--                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2">تطبيق</button>--}}
{{--                </form>--}}
{{--            </div>--}}

{{--            <div class="post-container mt-4">--}}
{{--                @foreach($posts as $post)--}}
{{--                    <div class="post bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4" data-post-id="{{ $post->po_id }}">--}}
{{--                        <div class="p-6 relative flex justify-between items-start">--}}
{{--                            <div class="post-details">--}}
{{--                                <h3 class="text-lg font-bold">--}}
{{--                                    @if($post->user_role == 'student')--}}
{{--                                        طلب حالة--}}
{{--                                    @else--}}
{{--                                        طلب معالجة--}}
{{--                                    @endif--}}
{{--                                </h3>--}}

{{--                                @if(auth()->user()->role == 'patient' && $post->state == 2 && auth()->user()->id == $post->id && is_null($post->patient_rate))--}}
{{--                                    <form action="{{ route('posts.rateStudent', $post->po_id) }}" method="POST">--}}
{{--                                        @csrf--}}
{{--                                        <div class="rating-form mb-4">--}}
{{--                                            <label for="rating" class="block text-yellow-700 text-sm font-bold mb-2">تقييم الطالب:</label>--}}
{{--                                            <select name="rating" id="rating" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>--}}
{{--                                                <option value="1">1</option>--}}
{{--                                                <option value="2">2</option>--}}
{{--                                                <option value="3">3</option>--}}
{{--                                                <option value="4">4</option>--}}
{{--                                                <option value="5">5</option>--}}
{{--                                            </select>--}}
{{--                                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2">إرسال التقييم</button>--}}
{{--                                        </div>--}}
{{--                                    </form>--}}
{{--                                @endif--}}

{{--                                <p>--}}
{{--                                    <strong>--}}
{{--                                        @if($post->user_role == 'student' || auth()->user()->role == 'student')--}}
{{--                                            {{ $post->user_name }}--}}
{{--                                        @else--}}
{{--                                            {{ auth()->id() == $post->id ? $post->user_name : 'Student' }}--}}
{{--                                        @endif--}}
{{--                                    </strong>--}}
{{--                                </p>--}}
{{--                                @if($post->user_role == 'student')--}}
{{--                                    <p>تقييم الطالب: {{ $post->student_rating }}</p>--}}
{{--                                @endif--}}
{{--                                <p>{{ $post->Description }}</p>--}}
{{--                                <p><strong>نوع الحالة:</strong> {{ $post->status_name }}</p>--}}

{{--                                <div class="images">--}}
{{--                                    @foreach(json_decode($post->images, true) as $image)--}}
{{--                                        <img src="{{ asset('storage/' . $image) }}" alt="Post Image" class="post-image">--}}
{{--                                    @endforeach--}}
{{--                                </div>--}}

{{--                                <div class="actions-and-rating text-right">--}}
{{--                                    @if(auth()->user()->id == $post->id)--}}
{{--                                        <div class="relative inline-block text-left">--}}
{{--                                            <button class="settings-button">⚙️</button>--}}
{{--                                            <div class="settings-menu hidden">--}}
{{--                                                <button class="edit-post">تعديل</button>--}}
{{--                                                <button class="delete-post">حذف</button>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    @elseif(auth()->user()->role == 'student' && $post->user_role == 'patient')--}}
{{--                                        @if($post->state == 0)--}}
{{--                                            <button class="send-request" id="sendRequestButton" data-post-id="{{ $post->po_id }}">إرسال طلب</button>--}}
{{--                                        @endif--}}
{{--                                    @elseif(auth()->user()->role == 'patient' && $post->user_role == 'student')--}}
{{--                                        <button class="send-request2" id="sendRequestButton" data-post-id="{{ $post->po_id }}">إرسال طلب</button>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                                <p class="timestamp">{{ $post->created_at->diffForHumans() }}</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="status-indicator text-right" data-state="{{ $post->state }}">--}}
{{--                            {{ $post->state == 0 ? 'متاحة' : ($post->state == 1 ? 'مرفوضة' : ($post->state == 2 ? 'منتهية' : 'معلقة') ) }}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <link rel="stylesheet" href="{{ asset('css/post.css') }}">--}}
{{--    <script src="{{ asset('js/post.js') }}"></script>--}}
{{--</x-app-layout>--}}
{{--//================================================================================--}}
{{--@extends('layouts.navb')--}}

{{--@section('title', 'Home')--}}

{{--@section('content')--}}
{{--    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"--}}
{{--            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">--}}
{{--    </script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"--}}
{{--            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">--}}
{{--    </script>--}}
{{--    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"--}}
{{--            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">--}}
{{--    </script>--}}
{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"--}}
{{--          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">--}}

{{--    <div class="flex mt-6">--}}
{{--        <!-- Sidebar الأيسر -->--}}
{{--        <aside class="bg-white p-6 border-r border-gray-700 sidebar p-">--}}
{{--            <div class="text-center">--}}
{{--                <h2 class="mt-4 text-xl font-bold text-black">--}}
{{--                    Welcome {{ auth()->user()->name }} <br>--}}
{{--                </h2>--}}

{{--                <p class="text-black">--}}
{{--                    You are an {{ auth()->user()->role }} <br>--}}
{{--                    @if(auth()->user()->role == 'student')--}}
{{--                        Your rate is {{ $average }}--}}
{{--                    @endif--}}
{{--                </p>--}}
{{--            </div>--}}
{{--            <div class="mt-6">--}}
{{--                <a href="/dist/profil std.html" class="block px-4 py-2 text-white hover:bg-gray-700 hover:text-white rounded">الملف الشخصي</a>--}}
{{--                <br>--}}
{{--                <a href="#" class="block px-4 py-2 text-white hover:bg-gray-700 hover:text-white rounded">الإعدادات</a>--}}
{{--            </div>--}}
{{--        </aside>--}}

{{--        <!-- Main Content -->--}}
{{--        <div class="flex-1 p-6 main-content">--}}
{{--            <br>--}}
{{--            <h1 class="text-2xl font-bold text-black mb-6 text-center" >المنشورات العامة</h1>--}}
{{--            <div class="space-y-6">--}}

{{--            <div class="mt-4" dir="rtl">--}}
{{--                <form action="{{ route('dashboard') }}" method="GET" class="flex items-center space-x-4">--}}
{{--                    <div class="flex items-center space-x-2">--}}
{{--                        <label for="sort_type" class="text-gray-700 text-sm font-bold">فرز حسب:</label>--}}
{{--                        &nbsp;--}}
{{--                        &nbsp;--}}
{{--                        &nbsp;--}}
{{--                        <select name="sort_type" id="sort_type" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">--}}
{{--                            <option value="created_at" {{ request('sort_type') == 'created_at' ? 'selected' : '' }}>وقت الإنشاء</option>--}}
{{--                            <option value="status_name" {{ request('sort_type') == 'status_name' ? 'selected' : '' }}>نوع الطلب</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    &nbsp;--}}
{{--                    &nbsp;--}}
{{--                    &nbsp;--}}
{{--                    &nbsp;--}}
{{--                    &nbsp;--}}
{{--                    <div class="flex items-center space-x-2">--}}
{{--                        <label for="sort_order" class="text-gray-700 text-sm font-bold">ترتيب الفرز:</label>--}}
{{--                        &nbsp;--}}
{{--                        &nbsp;--}}
{{--                        &nbsp;--}}
{{--                        <select name="sort_order" id="sort_order" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">--}}
{{--                            <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>تنازلي</option>--}}
{{--                            <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>تصاعدي</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}

{{--                    <div class="flex items-center space-x-2">--}}
{{--                        <label for="filter_status" class="text-gray-700 text-sm font-bold">فلترة حسب نوع الطلب:</label>--}}
{{--                        &nbsp;--}}
{{--                        &nbsp;--}}
{{--                        <select name="filter_status" id="filter_status" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">--}}
{{--                            <option value="all" {{ request('filter_status') == 'all' ? 'selected' : '' }}>كل الطلبات</option>--}}
{{--                            <option value="طلب معالجة" {{ request('filter_status') == 'طلب معالجة' ? 'selected' : '' }}>طلب معالجة</option>--}}
{{--                            <option value="طلب حالة" {{ request('filter_status') == 'طلب حالة' ? 'selected' : '' }}>طلب حالة</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}

{{--                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">تطبيق</button>--}}
{{--                </form>--}}
{{--            </div>--}}

{{--                <div class="space-y-6">--}}
{{--                @foreach($posts as $post)--}}
{{--                    <div class="post bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4" data-post-id="{{ $post->po_id }}">--}}
{{--                        <div class="p-6 relative flex justify-between items-start">--}}
{{--                            <div class="post-details">--}}
{{--                                <h3 class="text-lg font-bold">--}}
{{--                                    @if($post->user_role == 'student')--}}
{{--                                        طلب حالة--}}
{{--                                    @else--}}
{{--                                        طلب معالجة--}}
{{--                                    @endif--}}
{{--                                </h3>--}}

{{--                                @if(auth()->user()->role == 'patient' && $post->state == 2 && auth()->user()->id == $post->id && is_null($post->patient_rate))--}}
{{--                                    <form action="{{ route('posts.rateStudent', $post->po_id) }}" method="POST">--}}
{{--                                        @csrf--}}
{{--                                        <div class="rating-form mb-4">--}}
{{--                                            <label for="rating" class="block text-yellow-700 text-sm font-bold mb-2">تقييم الطالب:</label>--}}
{{--                                            <select name="rating" id="rating" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>--}}
{{--                                                <option value="1">1</option>--}}
{{--                                                <option value="2">2</option>--}}
{{--                                                <option value="3">3</option>--}}
{{--                                                <option value="4">4</option>--}}
{{--                                                <option value="5">5</option>--}}
{{--                                            </select>--}}
{{--                                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2">إرسال التقييم</button>--}}
{{--                                        </div>--}}
{{--                                    </form>--}}
{{--                                @endif--}}

{{--                                <p>--}}
{{--                                    <strong>--}}
{{--                                        @if($post->user_role == 'student' || auth()->user()->role == 'student')--}}
{{--                                            {{ $post->user_name }}--}}
{{--                                        @else--}}
{{--                                            {{ auth()->id() == $post->id ? $post->user_name : 'Student' }}--}}
{{--                                        @endif--}}
{{--                                    </strong>--}}
{{--                                </p>--}}
{{--                                @if($post->user_role == 'student')--}}
{{--                                    <p>تقييم الطالب: {{ $post->student_rating }}</p>--}}
{{--                                @endif--}}
{{--                                <p>{{ $post->Description }}</p>--}}
{{--                                <p><strong>نوع الحالة:</strong> {{ $post->status_name }}</p>--}}



{{--                                    <div class=" modal-body">--}}
{{--                                        @foreach(json_decode($post->images, true) as $image)--}}
{{--                                            <img src="{{ asset('storage/' . $image) }}"--}}
{{--                                                 alt="وصف الصورة" class="w-full h-auto mt-4 mb-4" class="afi" class="btn btn-primary"--}}
{{--                                                 data-toggle="modal" data-target="#exampleModal">--}}
{{--                                        @endforeach--}}
{{--                                    </div>--}}
{{--                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"--}}
{{--                                     aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--                                    <div class="modal-dialog" role="document">--}}
{{--                                        <div class="modal-content">--}}
{{--                                            <!-- Modal heading -->--}}
{{--                                            <div class="modal-header">--}}
{{--                                                <!-- <h5 class="modal-title" id="exampleModalLabel">--}}
{{--                                                    وصف الحالة--}}
{{--                                                </h5> -->--}}
{{--                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                        <span aria-hidden="true">--}}
{{--                                            ×--}}
{{--                                        </span>--}}
{{--                                                </button>--}}
{{--                                            </div>--}}
{{--                                            <!-- Modal body with image -->--}}
{{--                                            <div class="modal-body">--}}
{{--                                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSg_FwHdc5kmgmK_NYHF_GzzWysvaLon03ADw&s"--}}
{{--                                                     alt="وصف الصورة" class="w-full h-auto mt-4 mb-4">--}}

{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                </div>--}}

{{--                                <div class="actions-and-rating text-right">--}}
{{--                                    @if(auth()->user()->id == $post->id)--}}
{{--                                        <div class="relative inline-block text-left">--}}
{{--                                            <button class="settings-button">⚙️</button>--}}
{{--                                            <div class="settings-menu hidden">--}}
{{--                                                <button class="edit-post">تعديل</button>--}}
{{--                                                <button class="delete-post">حذف</button>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    @elseif(auth()->user()->role == 'student' && $post->user_role == 'patient')--}}
{{--                                        @if($post->state == 0)--}}
{{--                                            <button class="send-request" id="sendRequestButton" data-post-id="{{ $post->po_id }}">إرسال طلب</button>--}}
{{--                                        @endif--}}
{{--                                    @elseif(auth()->user()->role == 'patient' && $post->user_role == 'student')--}}
{{--                                        <button class="send-request2" id="sendRequestButton" data-post-id="{{ $post->po_id }}">إرسال طلب</button>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                                <p class="timestamp">{{ $post->created_at->diffForHumans() }}</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="status-indicator text-right" data-state="{{ $post->state }}">--}}
{{--                            {{ $post->state == 0 ? 'متاحة' : ($post->state == 1 ? 'مرفوضة' : ($post->state == 2 ? 'منتهية' : 'معلقة') ) }}--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                <div class="post bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4" data-post-id="{{ $post->po_id }}">--}}
{{--                    <h2 class="text-xl font-bold text-white mb-2"> {{ $post->state == 0 ? 'متاحة' : ($post->state == 1 ? 'مرفوضة' : ($post->state == 2 ? 'منتهية' : 'معلقة') ) }}--}}
{{--                    </h2>--}}

{{--                </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </main>--}}

{{--        <!-- Sidebar الأيمن -->--}}
{{--        <aside class="bg-white p-6 border-l border-gray-700 sidebar">--}}
{{--            <h2 class="text-xl font-bold mb-6 text-center text-black">الحالات</h2>--}}
{{--            <div class="space-y-4">--}}
{{--                <a href="/dist/statues.html#nkhor" class="block p-4 rounded-lg hover:bg-blue-600 text-white">--}}
{{--                    <img src="https://www.ibelieveinsci.com/wp-content/uploads/dental-decay.jpg" alt="">--}}
{{--                    <h3 class="text-center font-semibold">نخور</h3>--}}
{{--                </a>--}}
{{--                <a href="#" class="block p-4 rounded-lg hover:bg-blue-600 text-white">--}}
{{--                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSg_FwHdc5kmgmK_NYHF_GzzWysvaLon03ADw&s" alt="">--}}
{{--                    <h3 class="text-center font-semibold">قلح</h3>--}}
{{--                </a>--}}
{{--                <a href="/dist/statues.html#gsr" class="block p-4 rounded-lg hover:bg-blue-600 text-white">--}}
{{--                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRXvI5qS0FmLgtO5z4kJbrHFSa0OYKUNJ8AZg&s" alt="">--}}
{{--                    <h3 class="text-center font-bold mp-8">الجسور وقلب الوتد</h3>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </aside>--}}
{{--    </div>--}}
{{--    <link rel="stylesheet" href="{{ asset('css/post.css') }}">--}}
{{--        <script src="{{ asset('js/post.js') }}"></script>--}}
{{--@endsection--}}



@extends('layouts.navb')

@section('title', 'Home')
<!-- ... الأكواد الحالية ... -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle notification list visibility
        document.getElementById('notificationButton').addEventListener('click', function() {
            const notificationList = document.getElementById('notificationList');
            notificationList.classList.toggle('hidden');
        });

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
            $('#imageModal').modal('show');
        }

        document.querySelectorAll('.case-image').forEach(image => {
            image.addEventListener('click', function() {
                openModal(this);
            });
        });

        // Existing sorting logic
        const sortOptions = document.getElementById('sort-options');
        const postsContainer = document.getElementById('posts-container');

        sortOptions.addEventListener('change', function() {
            const sortBy = this.value;
            const posts = Array.from(postsContainer.getElementsByClassName('case-container'));

            posts.sort((a, b) => {
                if (sortBy === 'created_at_desc') {
                    return new Date(b.getAttribute('data-created-at')) - new Date(a.getAttribute('data-created-at'));
                } else if (sortBy === 'created_at_asc') {
                    return new Date(a.getAttribute('data-created-at')) - new Date(b.getAttribute('data-created-at'));
                } else if (sortBy === 'user_role') {
                    return a.getAttribute('data-user-role').localeCompare(b.getAttribute('data-user-role'));
                } else if (sortBy === 'state') {
                    return a.getAttribute('data-state') - b.getAttribute('data-state');
                }
            });

            posts.forEach(post => postsContainer.appendChild(post));
        });

        // Event listeners for edit and delete actions
        document.querySelectorAll('.edit-post').forEach(button => {
            button.addEventListener('click', function(e) {
                const postId = e.target.getAttribute('data-post-id');
                window.location.href = `/posts/${postId}/edit`;
            });
        });

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

        // Event listeners for sending requests
        document.querySelectorAll('.send-request').forEach(button => {
            button.addEventListener('click', function(e) {
                const postId = e.target.getAttribute('data-post-id');
                window.location.href = `/request-treatment?post_id=${postId}`;
            });
        });

        document.querySelectorAll('.send-request2').forEach(button => {
            button.addEventListener('click', function(e) {
                const postId = e.target.getAttribute('data-post-id');
                Swal.fire({
                    title: 'هل أنت متأكد أنك لديك هذه الحالة؟',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'نعم',
                    cancelButtonText: 'لا'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/confirm-request-treatment`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ post_id: postId }) // استخدام 'post_id' بدلاً من 'po_id'
                        }).then(response => {
                            if (response.ok) {
                                Swal.fire(
                                    'تم الإرسال!',
                                    'تم إرسال الطلب بنجاح.',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            } else {
                                response.text().then(text => {
                                    Swal.fire(
                                        'خطأ!',
                                        text || 'حدث خطأ أثناء محاولة إرسال الطلب.',
                                        'error'
                                    );
                                });
                            }
                        }).catch(() => {
                            Swal.fire(
                                'خطأ!',
                                'حدث خطأ أثناء محاولة إرسال الطلب.',
                                'error'
                            );
                        });
                    }
                });
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

    /* تعديل المارجن الأعلى للأقسام الرئيسية والجانبية */
    main, aside {
        margin-top: 0; /* أو يمكن تعيين قيمة صغيرة مثل 5px */
    }

    /* تعديل لموضع قائمة الإشعارات */
    #notificationList {
        left: 0;
        right: auto;
    }
    .hidden {
        display: none;
    }
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
    .checked {
        color: orange;
    }



</style>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@section('noti')
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
                        <a href="{{ route('notifications.show', $notification->n_id) }}" class="block text-black hover:bg-blue-200 flex-grow">
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-button');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(event) {
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
@endsection
@section('content')
    <div class="flex mt-0">
        <!-- Sidebar الأيسر -->
        <aside class="p-6 border-r border-gray-700 sidebar">
            <div class="text-center">
                <h2 class="mt-4 text-xl font-bold text-black">{{ auth()->user()->name }}</h2>
                <p class="text-black">You are a {{ auth()->user()->role }}</p>
            </div>
            <div class="mt-6">
                <a href="{{ route('share') }}" class="block px-4 py-2 text-black hover:bg-gray-700 hover:text-white rounded">الملف الشخصي</a>
                <br>
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-black hover:bg-gray-700 hover:text-white rounded">الإعدادات</a>
                <br>
            </div>
        </aside>
        <!-- Main Content -->
        <main class="container mx-auto px-4 py-8 rtl">
            <h1 class="text-4xl font-bold text-center mb-8">المنشورات العامة</h1>

            <!-- عرض رسائل النجاح والخطأ -->
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-500 text-white p-4 rounded mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white p-8 rounded-lg shadow-md">
                <!-- Sorting Toolbar -->
                <div class="mb-6 flex justify-end">
                    <label for="sort-options" class="mr-2 text-sm">فرز حسب   :   &nbsp;</label>
                    <select id="sort-options" class="px-4 py-2 border rounded text-xs">
                        <option value="created_at_desc">الأحدث</option>
                        <option value="created_at_asc">الأقدم</option>
                        <option value="user_role">دور المستخدم</option>
                        <option value="state">الحالة</option>
                    </select>
                </div>
                <div class="space-y-6" id="posts-container">
                    @foreach($posts as $post)
                        <div class="case-container" data-created-at="{{ $post->created_at }}" data-user-role="{{ $post->user_role }}" data-state="{{ $post->state }}" data-post-id="{{ $post->po_id }}">
                            <h2 class="text-2xl font-semibold mb-4">
                                @if($post->user_role == 'student')
                                    طلب حالة<br>
                                    تقييم الطالب
                                    {{$post->user->student->rating}}

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
                                    @if(in_array($post->po_id, $notificationPostIds))
                                        <span class="bg-green-500 text-white px-4 py-2 rounded">تم إرسال طلبك</span>
                                    @else
                                        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 send-request2" data-post-id="{{ $post->po_id }}">إرسال طلب</button>
                                    @endif
                                @endif
                            </div>
                            <br><br>
                            <p class="timestamp">{{ $post->created_at->diffForHumans() }}</p>
                            <div class="status-indicator" data-state="{{ $post->state }}">
                                {{ $post->state == 0 ? 'متاحة' : ($post->state == 1 ? 'مرفوضة' : ($post->state == 2 ? 'منتهية' : 'معلقة') ) }}
                            </div>
                        </div>
                    @endforeach
                </div>


            </div>
        </main>

        <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel">صور الحالة</h5>
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
                                <span class="sr-only">السابق</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">التالي</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar الأيمن -->
        <aside class="p-6 border-l border-gray-700 sidebar">
            <h2 class="text-xl font-bold mb-6 text-center text-black">الحالات</h2>
            <div class="space-y-4">
                @foreach ($statusTypes as $status)
                    <a href="{{route('status')}}" class="block p-4 rounded-lg hover:bg-blue-600 text-white">
                        @if (!empty($status->images) && is_array($status->images))
                            @foreach ($status->images as $image)
                                <img src="{{ asset('storage/' . $image) }}" alt="{{ $status->name }}">
                                @break <!-- نخرج من الحلقة بعد أول صورة -->
                            @endforeach
                        @endif
                        <h3 class="text-center font-semibold">{{ $status->name }}</h3>
                    </a>
                @endforeach
            </div>
        </aside>
    </div>
@endsection
