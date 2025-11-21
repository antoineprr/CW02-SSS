<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'body'];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function players()
    {
        return $this->belongsToMany(Player::class);
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
