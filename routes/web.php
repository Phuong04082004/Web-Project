<?php

use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Idea;
use App\Http\Controllers\Comment;
use App\Http\Controllers\Like;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FollowController;

Route::get('/', [Idea::class, 'index']);

Route::get('/hashtag/{tag}', [Idea::class, 'hashtag'])->name('hashtag.show');

Route::post('/idea', action: [Idea::class,'createIdea'])->middleware('auth');

Route::delete("/idea/{id}", [Idea::class, "delete"])->middleware('auth');

Route::get("/idea/{id}", [Idea::class, "show"])->name('ideas.show');

Route::get("/idea/{id}/edit", [Idea::class,"edit"]);

Route::put("/idea/{id}", [Idea::class, "update"])->middleware('auth');

Route::post("/idea/{id}/comment", [Comment::class,"createComment"])->middleware("auth");

Route::get("/register", [Auth::class, "register"]);

Route::post("/register", [Auth::class, "createUser"]);

Route::get("/login", [Auth::class, "login"])->name('login');

Route::post("/login", [Auth::class, "authenticate"]);

Route::post('/logout', [Auth::class, 'logout'])->name('logout');

Route::get('/profile', [ProfileController::class, 'edit'])->middleware('auth')->name('profile.edit');

Route::post("/idea/{id}/like", [Like::class, "like"])->middleware('auth');

Route::get('/users/{user}', [ProfileController::class, 'show'])->name('profile.show');

Route::post('/profile', [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');

Route::post('/users/{user}/toggle-follow', [FollowController::class, 'toggleFollow'])->middleware('auth');
