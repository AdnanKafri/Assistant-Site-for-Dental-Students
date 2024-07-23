@extends('layouts.nav')

@section('cont')
<div class="flex justify-center mt-16">
    <!-- My Posts -->
    <div class="w-3/4 bg-gray-200 p-8 m-3 rounded-lg">
        <div id="posts" class="mb-8">
            <h2 class="text-3xl font-bold mb-4">My Posts</h2>
            <!-- Display user's posts -->
            <div class="bg-white p-4 rounded-lg shadow-md mb-4">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-semibold">Post Title</h3>
                    <span class="text-gray-500">Posted 3 Days Ago</span>
                </div>
                <p class="mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec ex nec nulla volutpat semper a et lectus. Fusce auctor, neque sit amet cursus elementum.</p>
                <div class="grid grid-cols-3 gap-4 mt-4">
                    <img src="images\1.jpg" alt="img" class="w-full">
                    <img src="images\2.jpg" alt="img" class="w-full">
                    <img src="images\3.jpeg" alt="img" class="w-full">
                </div>
            </div>
            <!-- Add more posts as needed -->
        </div>
    </div>
</div>

<div class="flex justify-center mt-16">
    <!-- Add Post Form -->
    <div class="w-3/4 bg-gray-200 p-8 rounded-lg">
        <div id="add-post" class="mb-8">
            <h2 class="text-3xl font-bold mb-4">Add Post</h2>
            <!-- Form for adding a new post -->
            <form class="space-y-4">
                <div class="flex flex-col">
                    <label for="post-title" class="font-semibold">Title</label>
                    <input type="text" id="post-title" name="post-title" class="border border-gray-400 rounded-md px-4 py-2">
                </div>
                <div class="flex flex-col">
                    <label for="post-content" class="font-semibold">Content</label>
                    <textarea id="post-content" name="post-content" rows="4" class="border border-gray-400 rounded-md px-4 py-2"></textarea>
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add Post</button>
            </form>
        </div>
    </div>
</div>

<div class="flex justify-center mt-16">
    <!-- Profile Settings -->
    <div class="w-3/4 bg-gray-200 p-8 m-3 rounded-lg">
        <div id="settings">
            <h2 class="text-3xl font-bold mb-4">Settings</h2>
            <!-- Settings options -->
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold mb-2">Account Settings</h3>
                <!-- Add different settings options -->
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" class="form-checkbox text-blue-500">
                        <span class="ml-2">Enable Notifications</span>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
