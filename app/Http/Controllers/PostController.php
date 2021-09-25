<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{

    /**
     * @param Request $request
     * @return 
     */
    function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'type' => 'required|string|in:note,summary',
            'book' => 'required|array',
            'book.title' => 'required|string|max:255',
            'book.google_uuid' => 'required|string|max:255',
            'book.subtitle' => 'nullable|string|max:255',
            'book.publisher' => 'required|string|max:255',
            'book.published_date' => 'required|integer|max:' . date("Y"),
            'book.self_link' => 'required|string|max:2048',
            'book.thumbnail_link' => 'nullable|string|max:2048',
            'book.authors' => 'required|array',
            'book.authors.*' => 'required|string|distinct|max:255'
        ]);

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
        // // ['content' => $request->content, 'type' => $request->type, 'book_id' => $book->id, 'user_id' => auth()->user()->id]);
        // $post->user()->save(auth()->user());
        // $post->book()->save($book);
        $post->save();

        Session::flash('message', 'Post was successfully created.');

        return redirect()->route('home');
    }
}
