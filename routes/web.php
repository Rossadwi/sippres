<?php

use App\Http\Controllers\adminlinfolombacontroller;
use App\Http\Controllers\adminlsiswacontroller;
use App\Http\Controllers\adminluserscontroller;
use App\Http\Controllers\adminlverifkeaktifancontroller;
use App\Http\Controllers\adminlverifprestasicontroller;
use App\Http\Controllers\siswalajuankeaktifancontroller;
use App\Http\Controllers\siswalajuanprestasicontroller;
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

// Route::get('/', function () {
//     return view('app.admin.dashboard');
// });
Route::prefix('admin')->group(function () {
    Route::prefix('/users')->group(function () {
        Route::get('/index', [adminluserscontroller::class, 'getusers'])->name('getusers');
        Route::post('/insertuser', [adminluserscontroller::class, 'insertuser'])->name('insertusers');
        Route::put('/updateuser', [adminluserscontroller::class, 'updateuser'])->name('updateusers');
        Route::delete('/deleteuser', [adminluserscontroller::class, 'deleteuser'])->name('deleteusers');
    });
    Route::prefix('/siswa')->group(function () {
        Route::get('/index', [adminlsiswacontroller::class, 'getsiswa'])->name('getsiswa');
        Route::post('/insertsiswa', [adminlsiswacontroller::class, 'insertsiswa'])->name('insertsiswa');
        Route::put('/updateusiswa', [adminlsiswacontroller::class, 'updatesiswa'])->name('updatesiswa');
        Route::delete('/deletesiswa', [adminlsiswacontroller::class, 'deletesiswa'])->name('deletesiswa');
    });

    Route::prefix('/infolomba')->group(function () {
        Route::get('/index', [adminlinfolombacontroller::class, 'getinfolomba'])->name('getinfolomba');
        Route::post('/insertlomba', [adminlinfolombacontroller::class, 'insertlomba'])->name('insertinfolomba');
        Route::put('/updatelomba', [adminlinfolombacontroller::class, 'updatelomba'])->name('updateinfolomba');
        Route::delete('/deletelomba', [adminlinfolombacontroller::class, 'deletelomba'])->name('deletinfolomba');
    });

    Route::prefix('/verifikasi')->group(function () {
        Route::prefix('/prestasi')->group(function () {
            Route::get('/index', [adminlverifprestasicontroller::class, 'getverifprestasi'])->name('verifprestasi');
            Route::put('/updateverifprestasi', [adminlverifprestasicontroller::class, 'updateverifprestasi'])->name('updateverifprestasi');
        });
        Route::prefix('/keaktifan')->group(function () {
            Route::get('/index', [adminlverifkeaktifancontroller::class, 'getverifkeaktifan'])->name('verifkeaktifan');
            Route::put('/updateverifkeaktifan', [adminlverifkeaktifancontroller::class, 'updateverifkeaktifan'])->name('updateverifkeaktifan');
        });
    });
});

Route::prefix('siswa')->group(function () {
    Route::get('/dashboard', function () {
        return view('app.siswa.dashboard');
    })->name('dashboardsiswa');
    Route::get('/profile', function () {
        return view('app.siswa.profile');
    })->name('profilesiswa');
    // Route::prefix('/siswa')->group(function () {
    //     Route::get('/index', [adminlsiswacontroller::class, 'getsiswa'])->name('getsiswa');
    //     Route::post('/insertsiswa', [adminlsiswacontroller::class, 'insertsiswa'])->name('insertsiswa');
    //     Route::put('/updateusiswa', [adminlsiswacontroller::class, 'updatesiswa'])->name('updatesiswa');
    //     Route::delete('/deletesiswa', [adminlsiswacontroller::class, 'deletesiswa'])->name('deletesiswa');
    // });

    // Route::prefix('/infolomba')->group(function () {
    // Route::get('/index', [adminlinfolombacontroller::class, 'getinfolomba'])->name('getinfolombasiswa');
    // Route::post('/insertlomba', [adminlinfolombacontroller::class, 'insertlomba'])->name('insertinfolomba');
    // Route::put('/updatelomba', [adminlinfolombacontroller::class, 'updatelomba'])->name('updateinfolomba');
    // Route::delete('/deletelomba', [adminlinfolombacontroller::class, 'deletelomba'])->name('deletinfolomba');
    // });

    Route::prefix('/pengajuan')->group(function () {
        Route::prefix('/prestasi')->group(function () {
            Route::get('/index', [siswalajuanprestasicontroller::class, 'getajuanprestasi'])->name('ajuanprestasi');
            Route::post('/insertajuanprestasi', [siswalajuanprestasicontroller::class, 'insertajuanprestasi'])->name('insertajuanprestasi');
            Route::put('/updateajuanprestasi', [siswalajuanprestasicontroller::class, 'updateajuanprestasi'])->name('updateajuanprestasi');
        });
        Route::prefix('/keaktifan')->group(function () {
            Route::get('/index', [siswalajuankeaktifancontroller::class, 'getkeaktifan'])->name('ajuankeaktifan');
            Route::post('/insertkeaktifan', [siswalajuankeaktifancontroller::class, 'insertkeaktifan'])->name('insertkeaktifan');
            Route::put('/updatekeaktifan', [siswalajuankeaktifancontroller::class, 'updatekeaktifan'])->name('updatekeaktifan');
        });
        // Route::get('/prestasi', function () {
        //     return view('app.siswa.ajuanprestasi');
        // })->name('ajuanprestasi');
    });

    Route::get('/infolomba', function () {
        return view('app.siswa.infolomba');
    })->name('getinfolombasiswa');
    // Route::get('/pengajuan/keaktifan', function () {
    //     return view('app.siswa.ajuankeaktifan');
    // })->name('ajuankeaktifan');
});
