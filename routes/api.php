<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\TodoItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware(['jwt.auth'])->group(function () {
    Route::get('/user', function () {
        return response()->json(auth()->user());
    });
    Route::post('/checklists', [ChecklistController::class, 'store']);
    Route::resource('/checklists.todo-items', TodoItemController::class)->only(['index', 'store']);
    Route::resource('/todo-items', TodoItemController::class)->only(['show']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
