<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Post;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function getAllPlayers() 
    {
        return view('players', ['players' => Player::with(['team', 'position', 'country'])->get()->sortBy('name')]);
    }

    public function getPlayerByName($firstname, $name)
    {
        $player = Player::where('firstname', $firstname)
                                    ->where('name', $name)
                                    ->firstOrFail()
                                    ->load('team', 'position', 'country');
        return view('player', ['player' => $player]);
    }

    public function getPlayerArticles($firstname, $name) {
        $player = Player::where('firstname', $firstname)
                                    ->where('name', $name)
                                    ->firstOrFail();
        return view('category', [
            'type' => 'player',
            'categoryLabel' => $player,
            'posts' => $player->posts()->with(['categories', 'author', 'players', 'teams'])->latest()->get()
        ]);
    }
}
