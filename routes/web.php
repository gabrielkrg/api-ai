<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\PromptController;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    $user = auth()->user();

    return Inertia::render('Dashboard', [
        'user' => $user
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('hello', function () {
    return response()->json([
        'message' => 'Hello, world!',
    ]);
})->name('hello');


Route::group(['middleware' => 'auth'], function () {
    Route::get('tokens', [TokenController::class, 'index'])->name('tokens.index');
    Route::post('tokens', [TokenController::class, 'store'])->name('tokens.store');
    Route::delete('tokens/{id}', [TokenController::class, 'destroy'])->name('tokens.destroy');

    Route::get('prompts', [PromptController::class, 'index'])->name('prompts.index');
    Route::post('prompts', [PromptController::class, 'store'])->name('prompts.store');
    Route::put('prompts/{prompt}', [PromptController::class, 'update'])->name('prompts.update');
    Route::delete('prompts/{prompt}', [PromptController::class, 'destroy'])->name('prompts.destroy');
});



require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
// require __DIR__ . '/api.php';
