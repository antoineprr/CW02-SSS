<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getHomePage() 
    {
        return view('home', [
            'posts' => Post::with(['categories', 'author', 'players', 'teams'])->latest()->limit(5)->get()
        ]);
    }

    public function showCreatePost()
    {
        return view('create-post', [
            'categories' => Category::all(),
            'players' => Player::all(),
            'teams' => Team::all(),
        ]);
    }

    public function getPostBySlug(Post $post) {
        return view('post', [
            'post' => $post->load(['categories', 'author', 'players', 'teams'])
        ]);
    }

    public function getAllArticles() 
    {
        return view('articles', [
            'type' => 'all',
            'categoryLabel' => 'All Articles',
            'posts' => Post::with(['categories', 'author', 'players', 'teams'])->latest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:posts,slug|max:255',
            'body' => 'required|string',
            'thumbnail' => 'nullable|image|max:2048',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'teams' => 'nullable|array',
            'teams.*' => 'exists:teams,id',
            'players' => 'nullable|array',
            'players.*' => 'exists:players,id',
        ]);

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
            $validated['thumbnail'] = $path;
        }

        $validated['user_id'] = auth()->id();

        $post = Post::create($validated);

        if (isset($validated['categories'])) {
            $post->categories()->attach($validated['categories']);
        }

        if (isset($validated['teams'])) {
            $post->teams()->attach($validated['teams']);
        }

        if (isset($validated['players'])) {
            $post->players()->attach($validated['players']);
        }

        return redirect()->route('post.show', $post->slug)->with('success', 'Post created successfully!');
    }
}
