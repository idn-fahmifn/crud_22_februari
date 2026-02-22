<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // ROOM
    Route::get('/rooms', [RoomController::class, 'index'])->name('room.index');
    Route::post('/rooms', [RoomController::class, 'store'])->name('room.store');
    Route::get('/room/{param}', [RoomController::class, 'show'])->name('room.show');
    Route::put('/room/{param}', [RoomController::class, 'update'])->name('room.update');
    Route::delete('/room/{param}', [RoomController::class, 'delete'])->name('room.delete');

    Route::get('/items', [ItemController::class, 'index'])->name('item.index');
    Route::post('/items', [ItemController::class, 'store'])->name('item.store');
    Route::get('/item/{param}', [ItemController::class, 'show'])->name('item.show');
    Route::put('/item/{param}', [ItemController::class, 'update'])->name('item.update');
    Route::delete('/item/{param}', [ItemController::class, 'delete'])->name('item.delete');

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
