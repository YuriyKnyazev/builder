<?php

use App\Http\Controllers\Web\Admin as Admin;
use App\Http\Controllers\Web\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {
    Route::get('/', [Admin\AdminController::class, 'index'])->name('index');
    Route::put('sort', [Admin\AdminController::class, 'sort'])->name('sort');
    Route::put('status', [Admin\AdminController::class, 'changeStatus'])->name('status');

    Route::resource('pages', Admin\PageController::class);
    Route::get('pages/{page}/add-block', [Admin\BlockController::class, 'createPageBlock'])
        ->name('pages.addBlock');
    Route::post('pages/{page}/{template}/store', [Admin\BlockController::class, 'store'])
        ->name('pages.storeBlock');
    Route::delete('blocks', [Admin\BlockController::class, 'destroy'])->name('blocks.destroy');

    Route::resource('fieldTypes', Admin\FieldTypeController::class);
    Route::resource('templates', Admin\TemplateController::class);
    Route::resource('menus', Admin\MenuController::class);
    Route::get('menus/{menu}/add-block', [Admin\BlockController::class, 'createMenuBlock'])
        ->name('menus.addBlock');
    Route::post('menus/{menu}/{template}/store', [Admin\BlockController::class, 'storeMenu'])
        ->name('menus.storeBlock');
});

require __DIR__ . '/auth.php';

Route::get('{url?}', [FrontendController::class, 'index']);
