<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Author extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Get the related post models.
     */
    function posts()
    {
        return $this->belongsToMany(Post::class, 'book_author');
    }
}
