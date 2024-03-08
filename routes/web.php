<?php

use App\Http\Controllers\adminldashboardcontroller;
use App\Http\Controllers\adminlinfolombacontroller;
use App\Http\Controllers\adminlsiswacontroller;
use App\Http\Controllers\adminluserscontroller;
use App\Http\Controllers\adminlverifkeaktifancontroller;
use App\Http\Controllers\adminlverifprestasicontroller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\siswalajuankeaktifancontroller;
use App\Http\Controllers\siswalajuanprestasicontroller;
use App\Http\Controllers\siswaldashboardcontroller;
use App\Http\Controllers\siswalinfolombacontroller;
use App\Http\Controllers\siswalprofilecontroller;
use Illuminate\Support\Facades\Hash;
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
//     $pwd = Hash::make("0-opklm,");
//     echo $pwd;
// });

Route::group(['middleware' => ['auth', 'checkrole:1']], function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [adminldashboardcontroller::class,'getdashboard'])->name('dashboardadmin');
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
});



Route::group(['middleware' => ['auth', 'checkrole:0']], function () {
    Route::prefix('siswa')->group(function () {
        Route::get('/', [siswaldashboardcontroller::class,'getdashboard'])->name('dashboardsiswa');
        Route::get('/profile', [siswalprofilecontroller::class, 'getprofile'])->name('profilesiswa');
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
        });
        Route::get('/infolomba', [siswalinfolombacontroller::class, 'getinfolomba'])->name('getinfolombasiswa');
    });
});




//  jika user belum login
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/proseslogin', [AuthController::class, 'dologin'])->name('proseslogin');
});



Route::group(['middleware' => ['auth', 'checkrole:0,1']], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('proseslogout');
    Route::get('/redirect', [AuthController::class, 'cekrole']);
});


Route::get('/home', function () {
    $user = auth()->user();
    $typeuser = $user->role;
    if ($typeuser === 1) {
        return redirect('/admin');
    } else if ($typeuser === 0) {
        return redirect('/siswa');
    }
});
