<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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
    return view('welcome');
});


Auth::routes();

Route::group(['middleware'=>'auth'], function () {
    Route::resource('post', PostController::class);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::group(['prefix'=>'/comment'], function () {
        Route::post('/', [CommentController::class,'store'])->name('comment.store');
        Route::delete('/{id}', [CommentController::class,'destroy'])->name('comment.destroy');
        Route::put('/{id}', [CommentController::class,'update'])->name('comment.update');
    });
});


