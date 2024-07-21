<?php

use App\Http\Controllers\Web\Admin as Admin;
use App\Http\Controllers\Web\Frontend\FrontendController;
use App\Http\Controllers\Web\LocaleController;
use Illuminate\Support\Facades\Route;

Route::get('locale', [LocaleController::class, 'setLocale'])->name('locale');
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {
    Route::get('/', [Admin\AdminController::class, 'index'])->name('index');
    Route::put('sort', [Admin\AdminController::class, 'sort'])->name('sort');
    Route::put('status', [Admin\AdminController::class, 'changeStatus'])->name('status');

    Route::resource('pages', Admin\PageController::class);
    Route::get('pages/{page}/add-block', [Admin\BlockController::class, 'createPageBlock'])
        ->name('pages.addBlock');
    Route::post('pages/{page}/{template}/store', [Admin\BlockController::class, 'store'])
        ->name('pages.storeBlock');

    Route::post('blocks/bulkStore', [Admin\BlockController::class, 'bulkStore'])
        ->name('blocks.bulkStore');

    Route::delete('blocks', [Admin\BlockController::class, 'destroy'])->name('blocks.destroy');

    Route::resource('fieldTypes', Admin\FieldTypeController::class);
    Route::resource('templates', Admin\TemplateController::class);
    Route::resource('languages', Admin\LanguageController::class);
    Route::get('history', [Admin\EventController::class, 'index'])->name('history.index');
    Route::delete('history/deleteByDay', [Admin\EventController::class, 'deleteByDay'])
        ->name('events.deleteByDay');

    Route::resource('menus', Admin\MenuController::class);
    Route::get('menus/{menu}/add-block', [Admin\BlockController::class, 'createMenuBlock'])
        ->name('menus.addBlock');
    Route::post('menus/{menu}/{template}/store', [Admin\BlockController::class, 'storeMenu'])
        ->name('menus.storeBlock');
});

require __DIR__ . '/auth.php';

Route::get('{url?}', [FrontendController::class, 'index'])->middleware('locale');
