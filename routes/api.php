<?php

use App\Http\Controllers\API\Auth\AuthenticatedSessionController;
use App\Http\Controllers\API\Auth\RegisteredUserController;
use App\Http\Controllers\API\ManagerController;
use App\Http\Controllers\API\NoteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware(['guest'])
    ->name('register');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware(['api','guest'])
    ->name('login');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');
Route::post('/create-employee',[ManagerController::class,'createEmployee'])
    ->middleware(['is_manager','auth','api'])
    ->name('user.create');

Route::post('/note-create', [NoteController::class,'store'])
    ->middleware(['api','auth'])
    ->name('create.note');
Route::get('/show-notes',[NoteController::class,'show'])
    ->middleware(['auth','api'])
    ->name('show.notes');
