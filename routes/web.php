<?php

use App\Http\Controllers\Web\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin', [AdminController::class, 'index'])->name('admin.index');

require __DIR__.'/auth.php';
