<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'body', 'thumbnail', 'user_id'];

    // Génération automatique du slug à partir du titre
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // S'assurer que le slug est unique
    public static function boot()
    {
        parent::boot();
        
        static::creating(function ($post) {
            $post->slug = $post->generateUniqueSlug($post->title);
        });
        
        static::updating(function ($post) {
            if ($post->isDirty('title')) {
                $post->slug = $post->generateUniqueSlug($post->title);
            }
        });
    }
    
    private function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;
        
        while (static::where('slug', $slug)->where('id', '!=', $this->id)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        
        return $slug;
    }

    public function excerpt($length = 150)
    {
        return $this->generateExcerpt($this->body, $length);
    }

    private function generateExcerpt($content, $length = 150)
    {
        if (strlen($content) <= $length) {
            return $content;
        }
        
        $excerpt = substr($content, 0, $length);
        
        return $excerpt . '...';
    }

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
