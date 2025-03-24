<?php

use Illuminate\Support\Facades\Route;
use Modules\PkgWidget\Controllers\WidgetController;

// Route pour afficher le formulaire
Route::get('/test', function () {
    return view('PkgWidget::test');
})->name('test.form');

// Route pour traiter le formulaire
Route::post('/widget/test', [WidgetController::class, 'test'])->name('widget.test');




Route::get('/widgets', [WidgetController::class, 'index'])->name('widgets.index');
Route::post('/widgets', [WidgetController::class, 'store'])->name('widgets.store');
Route::get('/widgets/{id}/edit', [WidgetController::class, 'edit'])->name('widgets.edit');
Route::put('/widgets/{id}', [WidgetController::class, 'update'])->name('widgets.update');
Route::delete('/widgets/{id}', [WidgetController::class, 'destroy'])->name('widgets.destroy');

