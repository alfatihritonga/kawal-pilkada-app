<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DapilController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KabupatenKotaController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KelurahanDesaController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\SuaraController;
use App\Http\Controllers\TpsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/quickcount', function () {
    return view('quickcount');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/register/saksi', [AuthController::class, 'registerSaksi'])->name('registrasi.saksi');

Route::get('/onboard', [UserController::class, 'createProfile'])->name('profile.create');
Route::post('/profile/store', [UserController::class, 'storeProfile'])->name('profile.store');

Route::prefix('operator')->middleware(['role:operator'])->group(function () {
    Route::get('/', [OperatorController::class, 'home'])->name('operator.home');
    Route::get('/saksi', [OperatorController::class, 'saksi'])->name('operator.saksi');
    Route::get('/saksi/data', [OperatorController::class, 'dataSaksi'])->name('operator.saksi.data');
    Route::post('/saksi/store', [OperatorController::class, 'saksiStore'])->name('operator.saksi.store');
    
    Route::get('suara', [OperatorController::class, 'suara'])->name('operator.suara');
    Route::get('suara/data', [OperatorController::class, 'dataSuara'])->name('operator.suara.data');
    Route::post('suara/validasi', [OperatorController::class, 'validasiSuara'])->name('operator.suara.validasi');
    Route::get('suara/{suara}', [SuaraController::class, 'show'])->name('suara.show');
});


Route::prefix('saksi')->middleware(['role:saksi'])->group(function () {
    Route::get('/', [UserController::class, 'saksiHome'])->name('saksi.home');
    Route::get('/tps', [UserController::class, 'saksiTps'])->name('saksi.tps');
    Route::post('/tps', [UserController::class, 'saksiTpsCreate'])->name('saksi.tps.create');
    
    Route::get('suara/data', [SuaraController::class, 'suaraSaksiData'])->name('suara.saksi.data');
    Route::post('suara/store', [SuaraController::class, 'store'])->name('suara.store');
    Route::post('suara/store/c1', [SuaraController::class, 'uploadC1'])->name('suara.store.c1');
});



Route::prefix('admin')->middleware(['role:admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // route untuk kelola data kabupaten/kota
    Route::get('kabupaten-kota/data', [KabupatenKotaController::class, 'data'])->name('kabupaten-kota.data');
    Route::resource('kabupaten-kota', KabupatenKotaController::class);
    
    // route untuk kelola data kecamatan
    Route::get('kecamatan/data', [KecamatanController::class, 'data'])->name('kecamatan.data');
    Route::resource('kecamatan', KecamatanController::class);
    
    // route untuk kelola data kelurahan/desa
    Route::get('kelurahan-desa/data', [KelurahanDesaController::class, 'data'])->name('kelurahan-desa.data');
    Route::resource('kelurahan-desa', KelurahanDesaController::class);
    
    // route untuk kelola data tps
    Route::get('tps/data', [TpsController::class, 'data'])->name('tps.data');
    Route::resource('tps', TpsController::class);
    
    // route untuk kelola data suara
    Route::get('suara/data', [SuaraController::class, 'data'])->name('suara.data');
    Route::get('suara', [SuaraController::class, 'index'])->name('suara.index');
    Route::get('suara/{suara}', [SuaraController::class, 'show'])->name('suara.show');
});

// route untuk mengambil data
Route::get('/api/kabupaten-kota', [DapilController::class, 'getKabupatenKota']);
Route::get('/api/kecamatan', [DapilController::class, 'getKecamatan']);
Route::get('/api/kecamatan/{kabupatenKotaID}', [DapilController::class, 'getKecamatanByKabupatenKotaID']);
Route::get('/api/kelurahan-desa', [DapilController::class, 'getKelurahanDesa']);
Route::get('/api/kelurahan-desa/{kecamatanID}', [DapilController::class, 'getKelurahanDesaByKecamatanID']);
Route::get('/api/tps', [DapilController::class, 'getTPS']);
Route::get('/api/tps/{kelurahanDesaID}', [DapilController::class, 'getTpsByKelurahanDesaID']);

Route::get('/api/total-dapil', [DashboardController::class, 'dataTotalDapil']);
Route::get('/api/total-suara', [DashboardController::class, 'dataTotalSuaraPaslon']);
Route::get('/api/persentase-paslon', [DashboardController::class, 'dataPersentaseSuaraPaslon']);
Route::get('/api/persentase-per-kecamatan', [DashboardController::class, 'dataPersentasePerKecamatan']);