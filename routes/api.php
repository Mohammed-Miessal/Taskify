<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TaskController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([], function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('refresh', [AuthController::class, 'refresh'])->name('refresh');
});


Route::prefix('task')->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('task.read');
    Route::get('/index', [TaskController::class, 'index'])->name('task.read');
    Route::get('/create', [TaskController::class, 'create'])->name('task.create');
    Route::post('/store', [TaskController::class, 'store'])->name('task.store');
    Route::get('/show/{id}', [TaskController::class, 'show'])->name('task.show');
    Route::get('/edit/{task}', [TaskController::class, 'edit'])->name('task.edit');
    Route::put('/update/{task}', [TaskController::class, 'update'])->name('task.update');
    Route::delete('/destroy/{task}', [TaskController::class, 'destroy'])->name('task.destroy');
    Route::get('/showbyuser', [TaskController::class, 'showTaskByUser'])->name('task.showbyuser');
});
