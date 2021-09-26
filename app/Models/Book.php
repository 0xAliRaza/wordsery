<?php

namespace App\Models;

use App\Models\Author;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;
    public $fillable = ['title', 'google_uuid', 'subtitle', 'publisher', 'published_date', 'self_link', 'thumbnail_link'];

    /**
     * Get the related author models.
     */
    function authors()
    {
        return $this->belongsToMany(Author::class, 'book_author');
    }


    /**
     * Get the related post models.
     */
    function posts()
    {
        return $this->hasMany(Post::class);
    }
}
