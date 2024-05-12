<?php

use App\Http\Controllers\Web\Admin as Admin;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'admin');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {
    Route::get('/', [Admin\AdminController::class, 'index'])->name('index');
    Route::put('sort', [Admin\AdminController::class, 'sort'])->name('sort');
    Route::put('status', [Admin\AdminController::class, 'changeStatus'])->name('status');

    Route::resource('pages', Admin\PageController::class);
});

require __DIR__ . '/auth.php';

