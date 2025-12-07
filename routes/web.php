<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home', [
        'posts' => Post::with(['categories', 'author', 'players', 'teams'])->latest()->limit(5)->get()
    ]);
})->name('home');

Route::get('/home', function () {
    return redirect('/');
});

Route::get('/players', function () {
    return view('players');
})->name('players');

Route::get('/teams', function () {
    return view('teams');
})->name('teams');

Route::get('/search', function () {
    return view('search');
})->name('search');

Route::get('/create-post', function () {
    return view('create-post');
})->name('post.create');

Route::post('/create-post', [PostController::class, 'store'])->name('post.store')->middleware('auth');

Route::get('/posts/{post:slug}', function (Post $post) {
    return view('post', [
        'post' => $post
    ]);
})->name('post.show');

Route::get('/category/{category:label}', function ($category) {
    return view('category', [
        'categoryLabel' => $category,
        'posts' => Post::whereHas('categories', function ($query) use ($category) {
            $query->where('label', $category);
        })->with(['categories', 'author', 'players', 'teams'])->latest()->get()
    ]);
})->name('category.show');

Route::get('/teams/{team:name}', function ($team) {
    return view('category', [
        'categoryLabel' => $team,
        'posts' => Post::whereHas('teams', function ($query) use ($team) {
            $query->where('name', $team);
        })->with(['categories', 'author', 'players', 'teams'])->latest()->get()
    ]);
})->name('team.show');

Route::get('/players/{firstname}-{name}', function ($firstname, $name) {
    return view('category', [
        'categoryLabel' => $firstname . ' ' . $name,
        'posts' => Post::whereHas('players', function ($query) use ($firstname, $name) {
            $query->where('firstname', $firstname)->where('name', $name);
        })->with(['categories', 'author', 'players', 'teams'])->latest()->get()
    ]);
})->name('player.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/picture', [ProfileController::class, 'deletePicture'])->name('profile.picture.delete');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
