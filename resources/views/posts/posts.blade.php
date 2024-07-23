@extends('layouts.nav')

@section('cont')
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')

    <title>Timeline</title>
</head>

<body class="flex flex-col min-h-screen bg-gray-100">

<div class="container mx-auto py-20 flex-grow">

    <!-- بوست 1 -->
    <div class="max-w-3xl mx-auto bg-white rounded-lg overflow-hidden shadow-lg mb-8">
        <!-- قسم التوصيف -->
        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2 text-gray-800">Post1</div>
            <!-- تاريخ النشر -->
            <p class="text-gray-600 mb-2 text-sm">Published 1 hour ago</p>
            <p class="text-gray-700">This is the description of Post1. It contains some text to describe the post.</p>
        </div>
        <!-- قسم الصور -->
        <div class="px-6 py-4">
            <img src="images\09.jpg" alt="img" class="w-full">
        </div>
        <!-- زر الإرسال -->
        <div class="flex justify-between items-center px-6 py-4">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Submit</button>
            <div>
                <button class="text-blue-500 hover:text-blue-700 mr-2">Edit</button>
                <button class="text-red-500 hover:text-red-700">Delete</button>
            </div>
        </div>
    </div>

    <!-- بوست 2 -->
    <div class="max-w-3xl mx-auto bg-white rounded-lg overflow-hidden shadow-lg mb-8">
        <!-- قسم التوصيف -->
        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2 text-gray-800">Post2</div>
            <!-- تاريخ النشر -->
            <p class="text-gray-600 mb-2 text-sm">Published 2 days ago</p>
            <p class="text-gray-700">This is the description of Post2. It contains some text to describe the post.</p>
        </div>
        <!-- قسم الصور -->
        <div class="px-6 py-4">
            <img src="images\09.jpg" alt="img" class="w-full">
        </div>
        <!-- زر الإرسال -->
        <div class="flex justify-between items-center px-6 py-4">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Submit</button>
            <div>
                <button class="text-blue-500 hover:text-blue-700 mr-2">Edit</button>
                <button class="text-red-500 hover:text-red-700">Delete</button>
            </div>
        </div>
    </div>

    <!-- بوست 3 -->
    <div class="max-w-3xl mx-auto bg-white rounded-lg overflow-hidden shadow-lg mb-8">
        <!-- قسم التوصيف -->
        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2 text-gray-800">Post3</div>
            <!-- تاريخ النشر -->
            <p class="text-gray-600 mb-2 text-sm">Published 1 week ago</p>
            <p class="text-gray-700">This is the description of Post3. It contains some text to describe the post.</p>
        </div>
        <!-- قسم الصور -->
        <div class="px-6 py-4">
            <img src="images\09.jpg" alt="img" class="w-full">
        </div>
        <!-- زر الإرسال -->
        <div class="flex justify-between items-center px-6 py-4">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Submit</button>
            <div>
                <button class="text-blue-500 hover:text-blue-700 mr-2">Edit</button>
                <button class="text-red-500 hover:text-red-700">Delete</button>
            </div>
        </div>
    </div>

</div>



</body>

</html>
@endsection
