<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberAdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProdukAdminController;
use App\Http\Controllers\ProdukMemberController;
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
Route::post('/post', [AuthController::class, 'post'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {

    //Route Admin
    Route::group(['middleware' => ['role_auth:admin']], function () {
        Route::prefix('admin')->group(function () {
            Route::get('/dashboard', [AdminController::class, 'index'])->name('admin');

            //Member
            Route::resource('member', MemberAdminController::class)->names('admin.member');

            //Produk
            Route::resource('produk', ProdukAdminController::class)->names('produks');

            Route::resource('produk-member', ProdukMemberController::class)->names('produks.members');
            Route::post('/produk-member/save-session', [ProdukMemberController::class, 'saveSession'])->name('produks.members.saveSession');
            Route::post('/produk-members/update-session', [ProdukMemberController::class, 'updateSession'])->name('produks.members.updateSession');
            Route::delete('/produk-members/delete-session/{index}', [ProdukMemberController::class, 'deleteSession'])->name('produks.members.deleteSession');



            //Penjualan
            Route::prefix('penjualan')->group(function () {
                Route::get('/', [AdminController::class, 'showPenjualan'])->name('admin.penjualan');
            });
        });
    });

    //Route Member
    Route::group(['middleware' => ['role_auth:member']], function () {
        Route::prefix('member')->group(function () {
            Route::get('/dashboard', [MemberController::class, 'index'])->name('member');

            //Member
            Route::prefix('stok')->group(function () {
                Route::get('/', [MemberController::class, 'showStokMember'])->name('member.stok');
            });

            //Produk
            Route::prefix('produk')->group(function () {
                Route::get('/', [MemberController::class, 'showProduk'])->name('member.produk');
            });

            //Penjualan
            Route::prefix('transaksi')->group(function () {
                Route::get('/', [MemberController::class, 'showTransaksi'])->name('member.transaksi');
            });
        });
    });
});
