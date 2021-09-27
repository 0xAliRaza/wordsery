<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Post;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{

    /**
     * @param StorePostRequest $request
     * @return 
     */
    function store(StorePostRequest $request)
    {

        $book = Book::firstOrCreate(['google_uuid' => $request->book['google_uuid']], [
            'title' => $request->book['title'],
            'google_uuid' => $request->book['google_uuid'],
            'subtitle' => $request->book['subtitle'],
            'publisher' => $request->book['publisher'],
            'published_date' => $request->book['published_date'],
            'self_link' => $request->book['self_link'],
            'thumbnail_link' => $request->book['thumbnail_link'],
        ]);

        $author_ids = [];

        foreach ($request->book['authors'] as $author) {
            $author = Author::firstOrCreate(['name' => $author]);
            $author_ids[] = $author->id;
        }

        $book->authors()->sync($author_ids);


        $post = new Post();
        $post->content = $request->content;
        $post->type = $request->type;
        $post->user_id = auth()->user()->id;
        $post->book_id = $book->id;
        $post->save();

        Session::flash('message', 'Post was successfully created.');

        return redirect()->route('home');
    }
}
