<?php

namespace App\Http\Controllers;

use App\Models\ProdukMember;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $member = Auth::user();

        $totalOrders = Transaksi::where('id_member', $userId)->sum('jumlah_terjual');
        $totalSales = Transaksi::where('id_member', $userId)
            ->with('produk')
            ->get()
            ->sum(function ($transaksi) {
                return $transaksi->jumlah_terjual * $transaksi->produk->harga;
            });

        $recentOrders = Transaksi::where('id_member', $userId)
            ->with('produk', 'member')
            ->latest()
            ->take(5)
            ->get();

        $recentTransactions = Transaksi::where('id_member', $userId)
            ->latest()
            ->take(5)
            ->get();

        $totalProdukDiterima = ProdukMember::where('id_member', $userId)->sum('jumlah_terima');

        $totalProdukSaya = ProdukMember::where('id_member', $userId)->count();

        return view('pages.member.index', compact(
            'totalOrders',
            'totalSales',
            'recentOrders',
            'recentTransactions',
            'member',
            'totalProdukDiterima',
            'totalProdukSaya',
        ));
    }
}
