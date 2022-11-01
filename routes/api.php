<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\SiswaController;
use App\Http\Controllers\API\PengajarController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\MataKuliahController;
use App\Http\Controllers\API\kelasController;


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
    Route::post('user/siswa/update',[SiswaController::class, 'update']);
    Route::post('user/pengajar/update',[PengajarController::class, 'update']);
    Route::resources([
        'Matakuliah' => MataKuliahController::class,
    ],['only' => ['index', 'show',]]);
    Route::resources([
        'Kelas' => KelasController::class,
    ],['only' => ['index', 'show',]]);
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

    Route::resources([
        'Matakuliah' => MataKuliahController::class,
    ],['only' => ['store', 'destroy']]);
    Route::post('Matakuliah/{id}',[MataKuliahController::class, 'update']);
    Route::resources([
        'Kelas' => KelasController::class,
    ],['only' => ['store', 'destroy']]);
    Route::post('Kelas/{id}',[KelasController::class, 'update']);
    Route::post('Kelas/{id}/addpengajar',[KelasController::class, 'addPengajar']);
    Route::post('Kelas/{id}/addsiswa',[KelasController::class, 'addSiswa']);
    

});
//Update route using post methods
//patch or put won't take request
//better solution maybe needed




