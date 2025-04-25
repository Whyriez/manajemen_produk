<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        return view('pages.member.index');
    }

    public function showStokMember(){
        return view('pages.member.stok');
    }

    public function showProduk(){
        return view('pages.member.produk');
    }

    public function showTransaksi(){
        return view('pages.member.transaksi');
    }
}
