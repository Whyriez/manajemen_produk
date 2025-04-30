<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penjualan = Transaksi::with(['produk', 'member'])->get();

        return view('pages.admin.penjualan', compact('penjualan'));
    }

   
}
