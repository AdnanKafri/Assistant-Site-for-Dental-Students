@extends('layouts.navb')

@section('title', 'Edit Post')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 rtl">
                    <form action="{{ route('posts.update', $post->po_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="t_id" class="block text-gray-700 text-sm font-bold mb-2">نوع الحالة</label>
                            <select name="t_id" id="t_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @foreach($statusTypes as $type)
                                    <option value="{{ $type->t_id }}" {{ $post->t_id == $type->t_id ? 'selected' : '' }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                            @error('t_id')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="Description" class="block text-gray-700 text-sm font-bold mb-2">الوصف:</label>
                            <textarea name="Description" id="Description" placeholder="Enter your description here" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $post->Description }}</textarea>
                            @error('Description')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="images" class="block text-gray-700 text-sm font-bold mb-2">اضافة صور</label>
                            <input type="file" name="images[]" id="images" multiple class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('images')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                            @error('images.*')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">الصور الحالية:</label>
                            <p>قم بتحديد الصور التي ترغب بحذفها</p>
                            <div class="flex flex-wrap gap-4">
                                @foreach(json_decode($post->images, true) as $image)
                                    <div class="relative w-32 h-32">
                                        <img src="{{ asset('storage/' . $image) }}" alt="Post Image" class="w-24 h-22 object-cover rounded">
                                        <input type="checkbox" name="delete_images[]" value="{{ $image }}" class="absolute top-0 right-0 m-2 bg-white rounded p-1">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">حفظ التعديل</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
