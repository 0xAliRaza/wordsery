<?php

namespace App\Models;

use App\Models\User;
use App\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'type'];
    /**
     * Get the user that owns the post.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    
    /**
     * Get the post book model.
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
