<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $idMember = Auth::id(); // Ambil ID member yang sedang login
        $transaksi = Transaksi::join('produk', 'produk.id', '=', 'transaksi.id_produk')
            ->select('transaksi.kode_trx', 'transaksi.tanggal', 'transaksi.jumlah_terjual', 'produk.nama as nama_produk')
            ->where('transaksi.id_member', $idMember)
            ->get();

        return view('pages.member.transaksi', compact('transaksi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
