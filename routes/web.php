<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\CommentController;

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


Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('auth.redirect');

Route::get('/auth/callback', function () {
    $githubUser = Socialite::driver('github')->user();

    $user = User::updateOrCreate([
        'email' => $githubUser->email,
    ], [
        'name' => $githubUser->nickname,
        'password'=>Hash::make('12345678'),
        'email' => $githubUser->email,
        'github_token' => $githubUser->token,
        'github_refresh_token' => $githubUser->refreshToken,
    ]);

    Auth::login($user);

    return to_route('post.index');
    // $user->token
});


Route::get('/auth/redirect/google', function () {
    return Socialite::driver('google')->redirect();
})->name('auth.redirect.google');

Route::get('/auth/callback/google', function () {
    $googleUser = Socialite::driver('google')->user();

    // dd($googleUser);
    $user = User::updateOrCreate([
        'email' => $googleUser->email,
    ], [
        'name' => $googleUser->name,
        // 'password'=>Hash::make('12345678'),
        'email' => $googleUser->email,
        'google_token' => $googleUser->token,
        'google_refresh_token' => $googleUser->refreshToken,
    ]);

    Auth::login($user);

    return to_route('post.index');
    // $user->token
});
