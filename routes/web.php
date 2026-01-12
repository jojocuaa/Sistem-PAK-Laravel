<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LPAKController;
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
Route::get('/login', [UserController::class, 'LoginForm'])->name('login');
Route::get('/login_admin', [UserController::class, 'Login_Admin'])->name('Login_Admin');
Route::post('/login/admin', [UserController::class, 'loginAdmin'])->name('loginAdmin');
Route::post('/login/pegawai', [UserController::class, 'login'])->name('loginPegawai');
Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/tambahpegawai', [LPAKController::class, 'addLPAK'])->name('addnewlpak') ->middleware('admin');;
Route::post('/tambahpegawai', [LPAKController::class, 'storeLPAK'])->name('pegawai.store') ->middleware('admin');
Route::get('/viewPAK', [LPAKController::class, 'viewPAK'])->name('viewPAK') ->middleware('admin');
Route::get('/addpenilaian', [LPAKController::class, 'Penilaian'])->name('addpenilaian');
Route::post('/proses', [LPAKController::class, 'proses'])->name('proses');
Route::get('/search', [LPAKController::class, 'searchNama'])->name('searchNama');
Route::get('/riwayat', [LPAKController::class, 'riwayatPengajuan'])->name('riwayatPengajuan');
Route::get('/riwayat', [LPAKController::class, 'riwayatPengajuan'])->name('riwayatPengajuan');
// PREVIEW HARUS DI ATAS
Route::get('/pdf/pak/preview/{tahun}', [LPAKController::class, 'previewPdf'])
    ->name('pak.pdf.preview');
Route::get('/pdf/pak/preview/{nip}/{tahun}', [LPAKController::class, 'previewPdfAdmin'])
    ->name('pak.pdf.preview.admin');
// DOWNLOAD (pakai nip + tahun)
Route::get('/pdf/pak/{nip}/{tahun}', [LPAKController::class, 'cetakPdf'])
    ->name('pak.pdf');
Route::post('/pak/{id}/approve', [LPAKController::class, 'approve'])
    ->name('pak.approve')
    ->middleware('admin');

Route::post('/pak/{id}/reject', [LPAKController::class, 'reject'])
    ->name('pak.reject')
    ->middleware('admin');

