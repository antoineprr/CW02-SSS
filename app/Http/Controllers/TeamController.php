<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function getAllTeams() {
        return view('teams', ['teams' => Team::all()->sortBy('name')]);
    }

    public function getTeamByName(Team $team) {
        return view('team', ['team' => $team->load('players')]);
    }

    public function getTeamArticles(Team $team) {
        return view('category', [
            'type' => 'team',
            'categoryLabel' => $team,
            'posts' => $team->posts()->with(['categories', 'author', 'players', 'teams'])->latest()->get()
        ]);
    }
}
