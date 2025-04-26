<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('pages.admin.index');
    }


    public function showProduk(){
        return view('pages.admin.produk');
    }

    public function showPenjualan(){
        return view('pages.admin.penjualan');
    }
}
