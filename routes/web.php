<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home',[\App\Http\Controllers\SiteController::class, 'home'])->name('home')->middleware('auth');

Route::middleware(['auth', 'admin'])->prefix('/admin')->name('admin.')->group(function(){
    Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index']);

    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);

    Route::resource('expenseCategories', \App\Http\Controllers\Admin\ExpenseCategoryController::class);

    Route::resource('expenses', \App\Http\Controllers\Admin\ExpenseController::class);

    Route::resource('incomeCategories', \App\Http\Controllers\Admin\IncomeCategoryController::class);

    Route::resource('incomes', \App\Http\Controllers\Admin\IncomeController::class);


    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('reports/generate', [ReportController::class, 'generateReport'])->name('reports.generate');

    Route::get('password', [\App\Http\Controllers\Admin\AdminController::class, 'password']);

});
