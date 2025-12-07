<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   public function getCategoryArticles($category) {
        return view('category', [
            'type' => 'category',
            'categoryLabel' => $category,
            'posts' => Post::whereHas('categories', function ($query) use ($category) {
                $query->where('label', $category);
            })->with(['categories', 'author', 'players', 'teams'])->latest()->get()
        ]);
    }
}
