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
    function store(Request $request) {
        $request->validate(['data' => 'required|string']);

        $post = new Post();
        $post->data = $request->data;
        $post->save();
        return redirect()->back();
    }
}
