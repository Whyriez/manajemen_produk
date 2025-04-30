<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\ProdukMember;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddProdukMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $idMember = Auth::id();

        $produk = ProdukMember::join('produk', 'produk.id', '=', 'produk_member.id_produk')
            ->select('produk_member.*', 'produk.nama as nama_produk')
            ->where('produk_member.id_member', $idMember)
            ->get();

        $latest = Transaksi::latest()->first();
        $newKode = $latest ? $latest->kode_trx + 1 : 10001;

        return view('pages.member.produk', compact('produk', 'newKode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi awal
        $validated = $request->validate([
            'id_produk' => 'required|exists:produk,id',
            'jumlah_terjual' => 'required|numeric|min:1',
        ]);

        // Ambil ID Member dari sesi autentikasi
        $idMember = Auth::id();

        // Ambil produk yang sesuai dengan member
        $produkMember = ProdukMember::where('id_produk', $validated['id_produk'])
            ->where('id_member', $idMember)
            ->first();

        if (!$produkMember) {
            return redirect()->back()->withErrors('Produk tidak ditemukan di stok Anda.');
        }

        if ($validated['jumlah_terjual'] > $produkMember->jumlah_terima) {
            return redirect()->back()->withErrors('Jumlah terjual melebihi stok yang tersedia.');
        }

        // Ambil kode transaksi terbaru, jika ada
        $latest = Transaksi::latest()->first();
        $newKode = $latest ? $latest->kode_trx + 1 : 10001;

        // Simpan transaksi baru
        try {
            $transaksi = Transaksi::create([
                'kode_trx' => $newKode,
                'id_produk' => $validated['id_produk'],
                'id_member' =>  $idMember,
                'tanggal' => Carbon::now(),
                'jumlah_terjual' => $validated['jumlah_terjual'],
            ]);

            // Setelah transaksi berhasil, kurangi stok produk
            $produkMember->decrement('jumlah_terima', $validated['jumlah_terjual']);

            // Kembalikan respon setelah sukses
            return redirect()->back()->with('success', 'Transaksi berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Jika ada kesalahan saat menyimpan transaksi atau update stok
            return redirect()->back()->withErrors('Terjadi kesalahan, transaksi gagal. Error: ' . $e->getMessage());
        }
        
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
