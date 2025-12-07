<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Post;
use App\Models\Player;
use App\Models\Team;
use App\Models\User;
use App\Models\Category;
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
    return view('players', ['players' => Player::with(['team'])->get()->sortBy('name')]);
})->name('players');

Route::get('/players/{firstname}-{name}', function ($firstname, $name) {
    $player = Player::where('firstname', $firstname)
                                ->where('name', $name)
                                ->firstOrFail()
                                ->load('team', 'position', 'country');
    return view('player', ['player' => $player]);
})->name('player.show');

Route::get('/teams', function () {
    return view('teams', ['teams' => Team::all()->sortBy('name')]);
})->name('teams');

Route::get('/teams/{team:name}', function (Team $team) {
    return view('team', ['team' => $team->load('players')]);
})->name('team.show');

Route::get('/search', function () {
    return view('search');
})->name('search');

Route::get('/create-post', function () {
    return view('create-post', [
        'categories' => Category::all(),
        'players' => Player::all(),
        'teams' => Team::all(),
    ]);
})->name('post.create')->middleware('author');

Route::post('/create-post', [PostController::class, 'store'])->name('post.store')->middleware('author');

Route::get('/posts/{post:slug}', function (Post $post) {
    return view('post', [
        'post' => $post->load(['categories', 'author', 'players', 'teams'])
    ]);
})->name('post.show');

Route::get('/articles/authors/{firstname}-{lastname}', function ($firstname, $lastname) {
    $author = User::where('firstname', $firstname)
                                ->where('name', $lastname)
                                ->where('is_author', true)
                                ->firstOrFail();
    return view('category', [
        'type' => 'author',
        'categoryLabel' => $author,
        'posts' => $author->posts()->with(['categories', 'author', 'players', 'teams'])->latest()->get()
    ]);
})->name('articles.author');

Route::get('/articles/category/{category:label}', function ($category) {
    return view('category', [
        'type' => 'category',
        'categoryLabel' => $category,
        'posts' => Post::whereHas('categories', function ($query) use ($category) {
            $query->where('label', $category);
        })->with(['categories', 'author', 'players', 'teams'])->latest()->get()
    ]);
})->name('articles.category');

Route::get('/articles/teams/{team:name}', function (Team $team) {
    return view('category', [
        'type' => 'team',
        'categoryLabel' => $team,
        'posts' => $team->posts()->with(['categories', 'author', 'players', 'teams'])->latest()->get()
    ]);
})->name('articles.team');

Route::get('/articles/players/{firstname}-{name}', function ($firstname, $name) {
    $player = Player::where('firstname', $firstname)
                                ->where('name', $name)
                                ->firstOrFail();
    return view('category', [
        'type' => 'player',
        'categoryLabel' => $player,
        'posts' => $player->posts()->with(['categories', 'author', 'players', 'teams'])->latest()->get()
    ]);
})->name('articles.player');

Route::middleware('author')->group(function () {
    Route::get('/create-post', function () {
        return view('create-post', [
            'categories' => Category::all(),
            'players' => Player::all(),
            'teams' => Team::all(),
        ]);
    })->name('post.create');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/picture', [ProfileController::class, 'deletePicture'])->name('profile.picture.delete');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
