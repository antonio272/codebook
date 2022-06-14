<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FollowsController;
use App\Http\Controllers\LikesController;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentarioController;
use App\Http\Controllers\CommentarioReplyController;

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

Auth::routes();

Route::get('/home', [PostController::class, 'index']);
Route::get('/search', [ProfileController::class, 'search']);


Route::get('/profile/edit', [ProfileController::class, "edit"])->name("profile.edit");

Route::put('/profile', [ProfileController::class, "update"])->name("profile.update");

Route::get('/profile/{profile}', [ProfileController::class, "show"])->name("profile.show");
Route::get('/profile/{profile}/following', [FollowsController::class, "following"])->name("profile.following");
Route::get('/profile/{profile}/followers', [FollowsController::class, "follower"])->name("profile.follower");

/*ao fazer login*/
Route::get('/home', [PostController::class, 'index'])->name('post.index');

Route::resource('/post', PostController::class);


Route::post('/follow/{user}', [FollowsController::class, "store"]);

Route::post('/like/{post}', [LikesController::class, "store"]);

Route::get('/post/{id}', [PostController::class, 'store'])->name('post.show');

Route::post('/post/{post}/commentarios', [CommentarioController::class, 'store']);
Route::post('/commentarios/{commentario}/commentario-reply', [CommentarioReplyController::class, 'store']);


Route::delete('/commentarios/{commentario}', [CommentarioController::class, 'destroy']);
Route::delete('/commentario-reply/{commentarioReply}', [CommentarioReplyController::class, 'destroy']);

Route::delete('/user/{user}', [UserController::class, 'destroy']);

Route::delete('/post/{post}', [PostController::class, 'destroy']);

Route::get('/post/{post}/commentarios/{commentario}/edit', [CommentarioController::class, "edit"])->name("commentario.edit");
Route::put('/post/{post}/commentarios/{commentario}', [CommentarioController::class, "update"])->name("commentario.update");

Route::get('/post/{post}/commentarios/{commentario}/commentario-reply/{commentarioReply}/edit', [CommentarioReplyController::class, "edit"])->name("commentario.editreply");
Route::put('/post/{post}/commentarios/{commentario}/commentario-reply/{commentarioReply}', [CommentarioReplyController::class, "update"]);
