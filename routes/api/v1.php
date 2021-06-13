<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\Api\V1\IncomeController;
use App\Http\Controllers\Api\V1\IncomeCategoryController;
use App\Http\Controllers\API\V1\ExpenseCategoryController;

Route::prefix('v1')->group(function () {

    Route::get('/', fn () => ['Hello' => 'There!']);

    // Auth Routes
    Route::post('/auth/login', [AuthController::class, 'login']);
    //Route::post('/auth/register', [AuthController::class, 'register']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::post('/auth/check', [AuthController::class, 'checkToken']);

        Route::get('user',[AuthController::class, 'user']);

        //ExpenseCategory Routes
        Route::get('expenseCategories', [ExpenseCategoryController::class, 'index']);
        Route::post('expenseCategory', [ExpenseCategoryController::class, 'store']);
        Route::get('/expenseCategories/{expenseCategory}', [ExpenseCategoryController::class, 'show']);
        Route::put('/expenseCategories/{expenseCategory}', [ExpenseCategoryController::class, 'update']);
        Route::delete('/expenseCategories/{expenseCategory}', [ExpenseCategoryController::class, 'destroy']);

        //Expense Routes
        Route::get('expenses',[\App\Http\Controllers\API\V1\ExpenseController::class,'index']);
        Route::post('expense',[\App\Http\Controllers\API\V1\ExpenseController::class,'store']);
        Route::get('/expenses/{expense}',[\App\Http\Controllers\API\V1\ExpenseController::class,'show']);
        Route::put('/expenses/{expense}',[\App\Http\Controllers\API\V1\ExpenseController::class,'update']);
        Route::delete('/expenses/{expense}',[\App\Http\Controllers\API\V1\ExpenseController::class,'destroy']);

        //IncomeCategory Routes
        Route::get('incomeCategories', [IncomeCategoryController::class, 'index']);
        Route::post('incomeCategory', [IncomeCategoryController::class, 'store']);
        Route::get('/incomeCategories/{incomeCategory}', [IncomeCategoryController::class, 'show']);
        Route::put('/incomeCategories/{incomeCategory}', [IncomeCategoryController::class, 'update']);
        Route::delete('/incomeCategories/{incomeCategory}', [IncomeCategoryController::class, 'destroy']);

        //Income Routes
        Route::get('incomes',[\App\Http\Controllers\API\V1\IncomeController::class,'index']);
        Route::post('incomes',[\App\Http\Controllers\API\V1\IncomeController::class,'store']);
        Route::get('/incomes/{income}',[\App\Http\Controllers\API\V1\IncomeController::class,'show']);
        Route::put('/incomes/{income}',[\App\Http\Controllers\API\V1\IncomeController::class,'update']);
        Route::delete('/incomes/{income}',[\App\Http\Controllers\API\V1\IncomeController::class,'destroy']);

        Route::get('reports/generate', [\App\Http\Controllers\API\V1\ReportController::class,'generateReport'])->name('reports.generate');
    });
});
