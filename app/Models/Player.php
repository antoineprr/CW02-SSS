<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;
    protected $fillable = ['team_id','position_id', 'country_id','name', 'firstname', 'age', 'description'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
    
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
