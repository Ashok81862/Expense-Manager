<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\AuthController;


Route::prefix('v1')->group(function () {

    Route::get('/', fn () => ['Hello' => 'There!']);

    // Auth Routes
    Route::post('/auth/login', [AuthController::class, 'login']);
    //Route::post('/auth/register', [AuthController::class, 'register']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::post('/auth/check', [AuthController::class, 'checkToken']);

        Route::get('user',[AuthController::class, 'user']);

    });
});
