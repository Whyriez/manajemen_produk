<?php

namespace App\Http\Controllers;

use App\Models\DistribusiProduk;
use App\Models\Member;
use App\Models\Produk;
use App\Models\ProdukMember;
use App\Models\User;
use Illuminate\Http\Request;

class ProdukMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::all();
        $members = User::where('role', 'member')->get();
        return view('pages.admin.produk-member', compact('produk', 'members'));
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
        $request->validate([
            'id_member' => 'required',
            'id_produk' => 'required',
            'jumlah' => 'required|numeric'
        ]);

        $item = [
            'id_member' => $request->id_member,
            'id_produk' => $request->id_produk,
            'jumlah' => $request->jumlah
        ];

        $sessionProduk = session()->get('produk_member', []);
        $sessionProduk[] = $item;
        session(['produk_member' => $sessionProduk]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke session!');
    }

    public function saveSession(Request $request)
    {
        $produkMember = session('produk_member', []);
        $adminId = auth()->id(); // Ambil ID admin yang sedang login

        foreach ($produkMember as $item) {
            $produk = Produk::find($item['id_produk']);

            if (!$produk) {
                return redirect()->back()->with('error', 'Produk tidak ditemukan.');
            }

            $produkMemberEntry = ProdukMember::where('id_produk', $item['id_produk'])
                ->where('id_member', $item['id_member'])
                ->first();

            $stokAvailable = $produk->stok;
            if ($produkMemberEntry) {
                $stokAvailable += $produkMemberEntry->jumlah_terima;
            }

            if ($item['jumlah'] > $stokAvailable) {
                return redirect()->back()->with('error', "Jumlah produk {$produk->nama} melebihi stok yang tersedia.");
            }

            if ($produkMemberEntry) {
                $produkMemberEntry->jumlah_terima += $item['jumlah'];
                $produkMemberEntry->save();

                $produk->stok -= $item['jumlah'];
                $produk->save();
            } else {
                ProdukMember::create([
                    'id_produk' => $item['id_produk'],
                    'id_member' => $item['id_member'],
                    'jumlah_terima' => $item['jumlah'],
                ]);

                $produk->stok -= $item['jumlah'];
                $produk->save();
            }

            // Catat distribusi
            DistribusiProduk::create([
                'id_member' => $item['id_member'],
                'id_produk' => $item['id_produk'],
                'id_admin' => $adminId,
                'jumlah' => $item['jumlah'],
            ]);
        }

        session()->forget('produk_member');

        return redirect()->back()->with('success', 'Data produk member berhasil disimpan ke database.');
    }



    public function updateSession(Request $request)
    {
        $index = $request->input('index');
        $produkMember = session('produk_member', []);

        if (isset($produkMember[$index])) {
            $produkMember[$index]['jumlah'] = $request->input('jumlah');
            session(['produk_member' => $produkMember]);
        }

        return redirect()->back()->with('success', 'Data berhasil diperbarui di session.');
    }

    // Delete session
    public function deleteSession($index)
    {
        $produkMember = session('produk_member', []);
        if (isset($produkMember[$index])) {
            unset($produkMember[$index]);
            session(['produk_member' => array_values($produkMember)]);
        }

        return redirect()->back()->with('success', 'Data berhasil dihapus dari session.');
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
