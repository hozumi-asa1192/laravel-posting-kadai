<?php

use Illuminate\Support\Facades\Route;
// ルーティングを設定するコントローラを宣言する
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[PostController::class,'index']);

/*
// 投稿一覧ページ
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// 投稿の作成ページ
Route::get('/posts/create',[PostController::class,'create'])->name('posts.create');

// 投稿の作成機能
Route::post('/posts',[PostController::class,'store'])->name('posts.store');

//　（/小文字/{単数形}）でモデルのインスタンスを受け取れる。そして、受け取ったインスタンスのidを自動的に取得し、{post}の部分に入れる
// このルートはidをゲットできる
Route::get('/posts/{post}',[PostController::class,'show'])->name('posts.show');

// 投稿更新ページ
Route::get('/posts/{post}/edit',[PostController::class, 'edit'])->name('posts.edit');

// 投稿更新機能
Route::patch('/posts/{post}',[PostController::class, 'update'])->name('posts.update');

// 投稿の削除機能
Route::delete('/potsts/{post}',[PostController::class, 'destroy'])->name('posts.destroy');
*/

Route::resource('posts',PostController::class);