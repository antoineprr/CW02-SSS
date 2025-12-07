<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function getAuthorArticles($firstname, $lastname) {
        $author = User::where('firstname', $firstname)
                                    ->where('name', $lastname)
                                    ->where('is_author', true)
                                    ->firstOrFail();
        return view('category', [
            'type' => 'author',
            'categoryLabel' => $author,
            'posts' => $author->posts()->with(['categories', 'author', 'players', 'teams'])->latest()->get()
        ]);
    }
}
