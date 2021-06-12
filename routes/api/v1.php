<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\AuthController;
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

        Route::get('expenseCategories', [ExpenseCategoryController::class, 'index']);
        Route::post('expenseCategory', [ExpenseCategoryController::class, 'store']);
        Route::get('/expenseCategories/{expenseCategory}', [ExpenseCategoryController::class, 'show']);
        Route::put('/expenseCategories/{expenseCategory}', [ExpenseCategoryController::class, 'update']);
        Route::delete('/expenseCategories/{expenseCategory}', [ExpenseCategoryController::class, 'destroy']);

        Route::get('expenses',[\App\Http\Controllers\API\V1\ExpenseController::class,'index']);
        Route::post('expense',[\App\Http\Controllers\API\V1\ExpenseController::class,'store']);
        Route::get('/expenses/{expense}',[\App\Http\Controllers\API\V1\ExpenseController::class,'show']);
        Route::put('/expenses/{expense}',[\App\Http\Controllers\API\V1\ExpenseController::class,'update']);
        Route::delete('/expenses/{expense}',[\App\Http\Controllers\API\V1\ExpenseController::class,'destroy']);


    });
});
