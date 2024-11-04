<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'Logout']);
    Route::get('/item/list', [ItemController::class, 'index']);

    Route::get('/items-group', [ItemController::class, 'itemGroup']);
    Route::get('/items-account', [ItemController::class, 'itemAccount']);
    Route::get('/items-unit', [ItemController::class, 'itemUnit']);

    Route::post('/item/add', [ItemController::class, 'store']);
    Route::get('/item/{id}', [ItemController::class, 'show']);
    Route::put('/item/{id}/edit', [ItemController::class, 'edit']);
    Route::delete('/item/{id}/delete', [ItemController::class, 'destroy']);

    Route::get('/account', [TransactionController::class, 'account']);

    Route::get('/transaction/list', [TransactionController::class, 'index']);
    Route::post('/transaction/add', [TransactionController::class, 'store']);
    Route::get('/transaction/{id}', [TransactionController::class, 'show']);
    Route::put('/transaction/{id}/edit', [TransactionController::class, 'edit']);
    Route::delete('/transaction/{id}/delete', [TransactionController::class, 'destroy']);

    Route::get('/transaction/detail/list/{id}', [TransactionController::class, 'indexDetail']);
    Route::post('/transaction/detail/add', [TransactionController::class, 'storeDetail']);
    Route::get('/transaction/detail/{id}', [TransactionController::class, 'showDetail']);
    Route::put('/transaction/detail/{id}/edit', [TransactionController::class, 'editDetail']);
    Route::delete('/transaction/detail/{id}/delete', [TransactionController::class, 'destroyDetail']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::post('/login', [AuthController::class, 'Login']);
