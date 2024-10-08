@extends('layouts.app')

@section('content')
<div class="container mx-auto py-5">
    <!-- Heading -->
    <h1 class="text-2xl font-bold mb-5 text-center">All Posts</h1>

    <!-- Button to Create New Post -->
    <div class="text-center mb-5">
        <a href="{{ route('posts.create') }}" 
           class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-500 transition duration-200">
           Create Post
        </a>
    </div>

    <!-- Posts List -->
    @if($posts->isEmpty())
        <p class="text-center text-gray-600">No posts available. Be the first to create one!</p>
    @else
        <div class="space-y-6">
            @foreach($posts as $post)
            <div class="bg-white border border-gray-300 rounded-lg shadow-sm p-5">
                <!-- Post Title and Author -->
                <div class="mb-3">
                    <h5 class="text-lg font-semibold">{{ $post->title }}</h5>
                    <small class="text-gray-500">Posted by {{ $post->user->name }} | {{ $post->created_at->diffForHumans() }}</small>
                </div>

                <!-- Post Content (truncated for preview) -->
                <p class="text-gray-700 mb-3">{{ Str::limit($post->content, 150) }}</p>

                <!-- Post Interaction Buttons (View, Edit, etc.) -->
                <div class="flex items-center justify-between">
                    <a href="{{ route('posts.show', $post->id) }}" 
                       class="text-blue-600 font-bold hover:underline">
                       View Full Post
                    </a>

                    <div class="flex space-x-3">
                        <a href="{{ route('posts.edit', $post->id) }}" 
                           class="bg-blue-600 text-white font-bold py-1 px-3 rounded hover:bg-blue-500 transition duration-200">Edit
                        </a>

                        <!-- Show delete button only if the user is an admin -->
                        @if(Auth::check() && Auth::user()->is_admin === 1)
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-600 text-white font-bold py-1 px-3 rounded hover:bg-red-500 transition duration-200">
                                    Delete
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination Links -->
        <div class="mt-5">
            {{ $posts->links('pagination::bootstrap-4') }}
        </div>

        <!-- Comment Management (Show controls if the user is an admin) -->
        @if(Auth::check() && Auth::user()->role === 'admin')
            <div class="flex space-x-3 mt-5">
               
                        <!-- Delete Comment Button (Only visible for admin users) -->
                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white font-bold py-1 px-3 rounded hover:bg-red-500">
                                Delete Comment
                            </button>
                        </form>
                        @endif
                        @foreach($posts as $post)
                        @foreach($post->comments as $comment)
                        <!-- Report Comment Button -->
                        <form action="{{ route('comments.report', $comment->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-yellow-600 text-white font-bold py-1 px-3 rounded hover:bg-yellow-500">Report Comment</button>
                        </form>

                        <!-- Report User Button -->
                        <form action="{{ route('users.report', $comment->user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-yellow-600 text-white font-bold py-1 px-3 rounded hover:bg-yellow-500">Report User</button>
                        </form>
                    @endforeach
                @endforeach
            </div>
        

    @endif
</div>
@endsection
