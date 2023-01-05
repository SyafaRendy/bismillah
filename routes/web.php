<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\LoginApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CetakController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\AbsenController;
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
    return view('login');
});

Route::get('/absensi', function () {
    return view('absensi');
});
Route::get('/hadir', function () {
    return view('absensihadir');
});
// Route::resource('/login',LoginController::class);
// Route::get('/halaman_login', function () {
//     return view('login');
// });
Route::get('profile', [ProfileController::class, 'profil']);

Route::resource('/bisa',LoginApiController::class);
//Route::get('/jurnal/cetak_pdf', 'CetakController@cetak_pdf');
Route::get('jurnal/cetak_pdf', [CetakController::class, 'cetak_pdf']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/absen_hadir', [AbsenController::class, 'createHadir']);
Route::get('/detail_absen/{nisn}', [AbsenController::class, 'detail']);
Route::get('/get_absen', [AbsenController::class, 'index']);
Route::post('/create_jurnal', [JurnalController::class, 'create']);
Route::patch('/update_jurnal/{id}', [JurnalController::class, 'update']);
Route::delete('/delete_jurnal/{id}', [JurnalController::class, 'delete']);
Route::get('/detail_jurnal/{id}', [JurnalController::class, 'detail']);
Route::get('/get_jurnal', [JurnalController::class, 'index']);
Route::post('/create_rating', [RatingController::class, 'create']);
Route::post('/image',[ImageController::class, 'imageStore']);
Route::get('/get_user',[AuthController::class, 'getUser']);
Route::get('/get_user',[AuthController::class, 'getUser']);