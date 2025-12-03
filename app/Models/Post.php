<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'body', 'thumbnail', 'user_id'];

    public function getArticleInfos()
    {
        if ($this->author) {
            $authorName = $this->author->firstname . ' ' . $this->author->name;
            $authorLink = '<a href="TODO" class="text-blue-600 hover:text-blue-800 underline">' . $authorName . '</a>';
            $createdAt = $this->created_at ? $this->created_at->format('F j, Y') : 'Unknown Date';
            return "By {$authorLink} on {$createdAt}";
        }
        
        $createdAt = $this->created_at ? $this->created_at->format('F j, Y') : 'Unknown Date';
        return "By Unknown Author on {$createdAt}";
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
