<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Method to display all posts
    public function index()
    {
        $posts = Post::latest()->get(); // Retrieves all posts sorted by latest
        $posts = Post::latest()->paginate(10);
        return view('posts.index', compact('posts')); // Renders the 'index' view with posts data
    }

    // Method to show the form to create a new post
    public function create()
    {
        return view('posts.create'); // Returns the view for creating a post
    }

    // Method to store a new post
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Store the new post
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('posts.index');
    }

    // Method to show a specific post
    public function show(Post $post)
    {
        return view('posts.show', compact('post')); // Renders the 'show' view for a specific post
    }

    // Method to display the form to edit a specific post
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post')); // Returns the 'edit' view
    }

    // Method to update a specific post
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

         // Update the post
         $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
    }
}
