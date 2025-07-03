<?php

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
/*
Route::get('/', function () {
    return view('welcome');
});
*/

// ルートアクセス時にログイン画面へリダイレクト
Route::get('/', function () {
    return redirect('/login');
});
Auth::routes();
/*
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
*/
Route::get('/posts', [PostController::class, 'index'])->middleware('auth')->name('posts.index');

// 投稿作成フォーム表示
Route::get('/posts/create', [PostController::class, 'create'])->middleware('auth')->name('posts.create');

// 投稿データ保存
Route::post('/posts', [PostController::class, 'store'])->middleware('auth')->name('posts.store');

// 編集フォーム表示
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit')->middleware('auth');

// 投稿更新処理
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update')->middleware('auth');

//投稿削除機能
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
