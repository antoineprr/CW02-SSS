<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
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

Route::get('/', [PostController::class, 'getHomePage'])->name('home');

Route::get('/home', function () {
    return redirect('/');
});

Route::get('/articles', [PostController::class, 'getAllArticles'])->name('articles');

Route::get('/players', [PlayerController::class, 'getAllPlayers'])->name('players');
Route::get('/players/{firstname}-{name}', [PlayerController::class, 'getPlayerByName'])->name('player.show');

Route::get('/teams', [TeamController::class, 'getAllTeams'])->name('teams');
Route::get('/teams/{team:name}', [TeamController::class, 'getTeamByName'])->name('team.show');

Route::get('/posts/{post:slug}', [PostController::class, 'getPostBySlug'])->name('post.show');

Route::get('/articles/authors/{firstname}-{lastname}', [AuthorController::class, 'getAuthorArticles'])->name('articles.author');
Route::get('/articles/category/{category:label}', [CategoryController::class, 'getCategoryArticles'])->name('articles.category');
Route::get('/articles/teams/{team:name}', [TeamController::class, 'getTeamArticles'])->name('articles.team');
Route::get('/articles/players/{firstname}-{name}', [PlayerController::class, 'getPlayerArticles'])->name('articles.player');

Route::middleware('author')->group(function () {
    Route::get('/create-post', [PostController::class, 'showCreatePost'])->name('show.create-post');
    Route::post('/create-post', [PostController::class, 'store'])->name('post.store');
});

Route::middleware('admin')->group(function () {
    Route::get('/admin-dashboard/users', [UserController::class, 'showUsers'])->name('admin-dashboard.users');
    Route::get('/admin-dashboard/users/{user}', [UserController::class, 'editUser'])->name('admin-dashboard.user');
    Route::put('/admin-dashboard/users/{user}', [UserController::class, 'updateUser'])->name('admin-dashboard.user.update');
    Route::delete('/admin-dashboard/users/{user}', [UserController::class, 'deleteUser'])->name('admin-dashboard.delete-user');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/picture', [ProfileController::class, 'deletePicture'])->name('profile.picture.delete');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
