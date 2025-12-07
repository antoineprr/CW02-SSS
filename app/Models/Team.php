<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'location', 'description'];

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'team_post');
    }
}
