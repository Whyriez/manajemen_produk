<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalOrders = Transaksi::sum('jumlah_terjual');
        $totalSales = Transaksi::with('produk')
            ->get()
            ->sum(function ($transaksi) {
                return $transaksi->jumlah_terjual * $transaksi->produk->harga;
            });
    
        // Mengambil total produk (jumlah produk yang ada)
        $totalProduk = Produk::count();  // Menghitung jumlah produk
        
        // Mengambil total stok yang tersedia (jumlah stok semua produk)
        $totalStokTersedia = Produk::sum('stok');  // Menjumlahkan stok dari semua produk
        
        $recentOrders = Transaksi::with('produk', 'member')->latest()->take(5)->get();
        $recentTransactions = Transaksi::latest()->take(5)->get();

        $admin = Auth::user();
    
        return view('pages.admin.index', compact(
            'totalUsers', 'totalOrders', 'totalSales', 'totalProduk', 'totalStokTersedia', 'recentOrders', 'recentTransactions', 'admin'
        ));
    }
    
    
}
