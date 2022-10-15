<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::post('login',[AuthController::class,'login']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::group(['middleware' => ['admin:api']], function () {
    Route::post('register',[AuthController::class,'register']);
    Route::get('user', [UserController::class, 'index']);
    Route::get('user/admin', [UserController::class, 'indexAdmin']);
    Route::get('user/pengajar', [UserController::class, 'indexPengajar']);
    Route::get('user/siswa', [UserController::class, 'indexSiswa']);
    Route::get('user/{id}', [UserController::class, 'show']);
    Route::post('user/{id}/newPassword', [UserController::class, 'newPassword']);
    Route::delete('user/{id}', [UserController::class, 'destroy']);
});




