<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

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
            'book' => 'required|string',
            'type' => 'required|string|in:note,summary',
        ]);
        $post = new Post($request->only('content', 'book', 'type'));
        $post->user_id = auth()->user()->id;
        $post->save();
        return Inertia::render('Home');
    }
}
