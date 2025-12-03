<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Post;
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
        'posts' => Post::latest()->limit(5)->get()
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/picture', [ProfileController::class, 'deletePicture'])->name('profile.picture.delete');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
