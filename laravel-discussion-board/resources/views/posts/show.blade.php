@extends('layouts.app')

@section('content')
<div class="container py-4">

    <!-- Post Details Section -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h1 class="card-title">{{ $post->title }}</h1>
            <p class="card-text">{{ $post->content }}</p>
            <small class="text-muted">Posted by {{ $post->user->name }} on {{ $post->created_at->format('F j, Y') }}</small>
        </div>
    </div>

    <!-- Back to Posts Button -->
    <div class="mb-4">
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle"></i> Back to All Posts
        </a>
    </div>

    <!-- Add Comment Form -->
    <div class="card shadow-sm mb-4">
        
        <div class="card-body">
            <form action="{{ route('comments.store', $post->id) }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="content" class="form-label">Your Comment</label>
                    <textarea class="form-control" id="content" name="content" rows="3" required placeholder="Share your thoughts..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-chat"></i> Add Comment
                </button>
            </form>
        </div>
    </div>

    <!-- Comments Section -->
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Comments ({{ $post->comments->count() }})</h4>
        </div>
        <div class="card-body">
            @if($post->comments->isEmpty())
                <p class="text-muted">No comments yet. Be the first to comment!</p>
            @else
                @foreach ($post->comments as $comment)
                    <div class="border rounded p-3 mb-3">
                        <p class="mb-1">{{ $comment->content }}</p>
                        <small class="text-muted">Commented by {{ $comment->user->name }} on {{ $comment->created_at->format('F j, Y, g:i a') }}</small>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

</div>
@endsection
