<?php

namespace App\Http\Controllers;

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
    
        foreach ($produkMember as $item) {
            // Cek apakah produk ada di database
            $produk = Produk::find($item['id_produk']);
    
            if (!$produk) {
                return redirect()->back()->with('error', 'Produk tidak ditemukan.');
            }

            if ($item['jumlah'] > $produk->stok) {
                return redirect()->back()->with('error', "Jumlah produk {$produk->nama} melebihi stok yang tersedia.");
            }
    
            $exists = ProdukMember::where('id_produk', $item['id_produk'])
                ->where('id_member', $item['id_member'])
                ->exists();
    
            if (!$exists) {
                ProdukMember::create([
                    'id_produk' => $item['id_produk'],
                    'id_member' => $item['id_member'],
                    'jumlah_terima' => $item['jumlah'],
                ]);
                $produk->stok -= $item['jumlah'];
                $produk->save();
            }
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
