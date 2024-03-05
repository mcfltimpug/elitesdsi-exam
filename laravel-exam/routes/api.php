<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\UserController;


Route::post("/auth/register",[UserController::class,"createUser"]);
Route::post("/auth/login",[UserController::class,"loginUser"]);
Route::post('/auth/logout', [UserController::class, 'logoutUser'])->middleware('auth:sanctum');

Route::apiResource('/artist', ArtistController::class);
Route::apiResource('/album', AlbumController::class);

