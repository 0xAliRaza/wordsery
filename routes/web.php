<?php

use App\Http\Controllers\HomeController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::match(['POST', 'GET'], '/home', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home');

Route::get('/submit', function () {
    return Inertia::render('Submit');
})->middleware(['auth', 'verified'])->name('submit');
Route::post('/post', [PostController::class, 'store'])->middleware(['auth', 'verified']);




require __DIR__ . '/auth.php';
