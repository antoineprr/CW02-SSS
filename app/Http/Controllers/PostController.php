<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
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
