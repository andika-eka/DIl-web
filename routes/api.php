<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\SiswaController;
use App\Http\Controllers\API\PengajarController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\MataKuliahController;
use App\Http\Controllers\API\KelasController;
use App\Http\Controllers\API\SubCpmkController;
use App\Http\Controllers\API\IndikatorController;
use App\Http\Controllers\API\MateriController;
use App\Http\Controllers\API\SoalpilihangandaController;
use App\Http\Controllers\API\PilihanjawabanController;


use App\Http\Controllers\API\LearningController;




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
    Route::patch('applykelas/{id_kelas}', [SiswaController::class, 'applyKelas']);
    Route::delete('leavekelas/{id_kelas}', [SiswaController::class, 'leaveKelas']);
    
    Route::post('Kelas/{id_kelas}/applySettings', [KelasController::class, 'applySettings']);
    Route::patch('Kelas/{id_kelas}/setDefaultSettings', [KelasController::class, 'setDefaultSettings']);

    
    Route::post('Matakuliah/{mkid}/subcpmk', [SubCpmkController::class, 'store']);
    Route::get('subcpmk/{id}', [SubCpmkController::class, 'show']);
    Route::post('subcpmk/{id}', [SubCpmkController::class, 'update']);
    Route::post('subcpmk/{id}/file', [SubCpmkController::class, 'updateFile']);
    Route::delete('subcpmk/{id}', [SubCpmkController::class, 'destroy']);


    Route::post('subcpmk/{mkid}/indikator', [IndikatorController::class, 'store']);
    Route::get('indikator/{id}', [IndikatorController::class, 'show']);
    Route::post('indikator/{id}', [IndikatorController::class, 'update']);
    Route::delete('indikator/{id}', [IndikatorController::class, 'destroy']);

    Route::post('indikator/{inid}/materi', [MateriController::class, 'store']);
    Route::get('materi/{id}', [MateriController::class, 'show']);
    Route::post('materi/{id}', [MateriController::class, 'update']);
    Route::delete('materi/{id}', [MateriController::class, 'destroy']);

    Route::post('indikator/{inid}/soal', [SoalpilihangandaController::class, 'store']);
    Route::get('soal/{id}', [SoalpilihangandaController::class, 'show']);
    Route::post('soal/{id}', [SoalpilihangandaController::class, 'update']);
    Route::patch('soal/{id}/removepic', [SoalpilihangandaController::class, 'removePic']);
    Route::delete('soal/{id}', [SoalpilihangandaController::class, 'destroy']);
    
    Route::post('soal/{soal_id}/jawaban', [PilihanjawabanController::class, 'store']);
    Route::get('jawaban/{id}', [PilihanjawabanController::class, 'show']);
    Route::post('jawaban/{id}', [PilihanjawabanController::class, 'update']);
    Route::patch('jawaban/{id}/removepic', [PilihanjawabanController::class, 'removePic']);
    Route::delete('jawaban/{id}', [PilihanjawabanController::class, 'destroy']);

    
    Route::get("getKelas",[KelasController::class, 'getKelas']);
    Route::get("currentUnit/{id_kelas}", [LearningController::class, 'currentUnit']);
    Route::get("allUnit/{id_kelas}", [LearningController::class, 'allUnit']);
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
    Route::delete('Kelas/removesiswa/{id}/{id_siswa}', [KelasController::class, 'removeSiswa']);
    Route::delete('Kelas/removepengajar/{id}/{id_pengajar}', [KelasController::class, 'removePengajar']);
    
});
//Update route using post methods
//patch or put won't take request
//better solution maybe needed




