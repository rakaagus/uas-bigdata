<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookShelfController;
Use App\Http\Controllers\Peminjaman\PeminjamanController;

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


Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');
    Route::post('/update-password', [AuthController::class, 'updatePassword'])->middleware('auth');
    Route::post('/generate-otp-code', [AuthController::class, 'generatorOTP']);
    Route::post('/verifikasi-email', [AuthController::class, 'verifikasi']);
    Route::get('/get-profile', [AuthController::class, 'profile'])->middleware('auth');
    Route::post('/update-profile', [AuthController::class, 'updateProfile'])->middleware('auth');
});


Route::post('/role', [AuthController::class, 'addRole']);
Route::get('/role/{id}', [AuthController::class, 'getRole']);
Route::get('/role', [AuthController::class, 'getAllRole']);

Route::apiResource('book', BookController::class);
Route::apiResource('bookshelf', BookShelfController::class);

Route::get('/getallbookshelf', [BookShelfController::class, 'getAllBookshelf']);
Route::get('/getallbooks', [BookController::class, "getAllBookPagination"]);

Route::get('/peminjaman', [PeminjamanController::class, 'index'])->middleware('auth');
Route::post('/peminjaman', [PeminjamanController::class, 'addPinjamanBuku'])->middleware('auth');
Route::post('/approve-peminjaman/{id}', [PeminjamanController::class, 'approvePeminjaman'])->middleware('auth');
Route::get('/load-pinjaman', [PeminjamanController::class, 'loadTempoPengambilan']);
Route::post('/berhasil-pinjam/{id}', [PeminjamanController::class, 'berhasilPinjam'])->middleware('auth');
