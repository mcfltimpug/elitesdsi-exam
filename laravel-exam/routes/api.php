<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;


//Login
Route::post("/auth/register",[UserController::class,"createUser"]);
Route::post("/auth/login",[UserController::class,"loginUser"]);
Route::post('/auth/logout', [UserController::class, 'logoutUser'])->middleware('auth:sanctum');

//Artist and Album
Route::apiResource('/artist', ArtistController::class);
Route::apiResource('/album', AlbumController::class);

//Dashboard
Route::get('/dashboard/total-sold-per-artist', [DashboardController::class, 'totalAlbumsSoldPerArtist']);
Route::get('/dashboard/combined-album-sales-per-artist', [DashboardController::class, 'combinedAlbumSalesPerArtist']);
Route::get('/dashboard/top-one-artist', [DashboardController::class, 'topSellingArtist']);
Route::get('/dashboard/by-artist/{artist}', [DashboardController::class, 'listAlbumsByArtist']);