<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

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

Route::get('/', [BlogController::class, 'index']);
Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create');
    Route::put('/blogs/change-status/{id}', [BlogController::class, 'changeBlogStatus']);
    Route::resource('blogs', BlogController::class)->except('index', 'show', 'create');
    Route::get('/admin', [BlogController::class, 'getAllBlogs'])->name('admin.panel');
});

require __DIR__.'/auth.php';
