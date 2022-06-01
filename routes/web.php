<?php

use App\Models\gig;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GigController;
use App\Http\Controllers\UserController;

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

// All Gigs
Route::get('/', [GigController::class, 'index']);

// Create Gig
Route::get('/gigs/create', [GigController::class, 'create'])->middleware('auth');

// Store Gig
Route::post('/gigs', [GigController::class, 'store'])->middleware('auth');

// Edit Gig
Route::get('/gigs/{gig}/edit', [GigController::class, 'edit'])->middleware('auth');

// Update Gig
Route::put('/gigs/{gig}', [GigController::class, 'update'])->middleware('auth');

// Delete Gig
Route::delete('/gigs/{gig}', [GigController::class, 'delete'])->middleware('auth');

// Manage Gig
Route::get('/gigs/manage', [GigController::class, 'manage'])->middleware('auth');

// Single Gig
Route::get('/gigs/{gig}', [GigController::class, 'show']);

// Register User
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Store User
Route::post('/users', [UserController::class, 'store']);

// Logout User
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Login User
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Signin User
Route::post('/users/signin', [UserController::class, 'signin']);