<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SalesController;
use App\Http\Controllers\Api\StokController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function () {
    /** show stock report */
    Route::get('stock', [StokController::class, 'stokKendaraan']);
    /** show sales report per item / kendaraan */
    Route::get('sales-per-item', [SalesController::class, 'salesPerItem']);
    /** show sales report */
    Route::get('sales', [SalesController::class, 'sales']);
});
