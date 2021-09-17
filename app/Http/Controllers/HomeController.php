<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    function index()
    {
        return Inertia::render('Home', ['posts' => Inertia::lazy(fn () => Post::with(['user'])->orderBy('id', 'desc')->cursorPaginate(15))]);
    }
}
