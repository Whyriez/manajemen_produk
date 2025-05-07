<?php

use App\Http\Controllers\AddProdukMemberController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DistribusiProdukController;
use App\Http\Controllers\MemberAdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukAdminController;
use App\Http\Controllers\ProdukMemberController;
use App\Http\Controllers\StokMemberController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\TransaksiMemberController;
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
//     return view('pages.auth.login.index');
// });

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'post'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {

    //Route Admin
    Route::group(['middleware' => ['role_auth:admin']], function () {
        Route::prefix('admin')->group(function () {
            Route::get('/dashboard', [AdminController::class, 'index'])->name('admin');



            //Produk
            Route::resource('produk', ProdukAdminController::class)->names('produks');

            Route::resource('produk-member', ProdukMemberController::class)->names('produks.members');
            Route::post('/produk-member/save-session', [ProdukMemberController::class, 'saveSession'])->name('produks.members.saveSession');
            Route::post('/produk-members/update-session', [ProdukMemberController::class, 'updateSession'])->name('produks.members.updateSession');
            Route::delete('/produk-members/delete-session/{index}', [ProdukMemberController::class, 'deleteSession'])->name('produks.members.deleteSession');

            //Distribusi Produk
            Route::resource('distribusi-produk', DistribusiProdukController::class)->names('distribusi-produks');

            //Penjualan
            Route::resource('penjualan', PenjualanController::class)->names('penjualans');
        });
    });

    //Route Supervisor
    Route::group(['middleware' => ['role_auth:superadmin']], function () {
        Route::prefix('superadmin')->group(function () {
            Route::get('/dashboard', [SuperAdminController::class, 'index'])->name('superadmin');

            //Member
            Route::resource('member', MemberAdminController::class)->names('superadmin.member');
            //Distribusi Produk
            Route::resource('distribusi-produk', DistribusiProdukController::class)->names('distribusi-produks');

            //Penjualan
            Route::resource('penjualan', PenjualanController::class)->names('superadminpenjualans');
        });
    });

    //Route Member
    Route::group(['middleware' => ['role_auth:member']], function () {
        Route::prefix('member')->group(function () {
            Route::get('/dashboard', [MemberController::class, 'index'])->name('member');

            //Member
            Route::resource('stok', StokMemberController::class)->names('stoks');
            //Produk
            Route::resource('produk', AddProdukMemberController::class)->names('addproduks');

            //Penjualan
            Route::resource('transaksi', TransaksiMemberController::class)->names('transaksis');
        });
    });
});
