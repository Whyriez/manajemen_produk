<?php

namespace App\Http\Controllers;

use App\Models\ProdukMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StokMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $idMember = Auth::id();

        $stok = ProdukMember::join('produk', 'produk.id', '=', 'produk_member.id_produk')
            ->select('produk_member.*', 'produk.nama as nama_produk')
            ->where('produk_member.id_member', $idMember)
            ->get();

        return view('pages.member.stok', compact('stok'));
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
