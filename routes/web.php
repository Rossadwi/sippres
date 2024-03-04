<?php

use App\Http\Controllers\adminlinfolombacontroller;
use App\Http\Controllers\adminlsiswacontroller;
use App\Http\Controllers\adminluserscontroller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('app.admin.dashboard');
});
Route::prefix('admin')->group(function () {
    Route::prefix('/users')->group(function () {
        Route::get('/index',[adminluserscontroller::class,'getusers'])->name('getusers');
        Route::post('/insertuser', [adminluserscontroller::class, 'insertuser'])->name('insertusers');
        Route::put('/updateuser', [adminluserscontroller::class, 'updateuser'])->name('updateusers');
        Route::delete('/deleteuser', [adminluserscontroller::class, 'deleteuser'])->name('deleteusers');
    });
    Route::prefix('/siswa')->group(function () {
        Route::get('/index',[adminlsiswacontroller::class,'getsiswa'])->name('getsiswa');
        Route::post('/insertsiswa', [adminlsiswacontroller::class, 'insertsiswa'])->name('insertsiswa');
        Route::put('/updateusiswa', [adminlsiswacontroller::class, 'updatesiswa'])->name('updatesiswa');
        Route::delete('/deletesiswa', [adminlsiswacontroller::class, 'deletesiswa'])->name('deletesiswa');
    });

    Route::prefix('/infolomba')->group(function () {
        Route::get('/index',[adminlinfolombacontroller::class,'getinfolomba'])->name('getinfolomba');
        Route::post('/insertlomba', [adminlinfolombacontroller::class, 'insertlomba'])->name('insertinfolomba');
        Route::put('/updatelomba', [adminlinfolombacontroller::class, 'updatelomba'])->name('updateinfolomba');
        Route::delete('/deletelomba', [adminlinfolombacontroller::class, 'deletelomba'])->name('deletinfolomba');
    });

    Route::get('/verifikasi/prestasi', function () {
        return view('app.admin.verifprestasi');
    })->name('verifprestasi');
    Route::get('/verifikasi/keaktifan', function () {
        return view('app.admin.verifkeaktifan');
    })->name('verifkeaktifan');
});
