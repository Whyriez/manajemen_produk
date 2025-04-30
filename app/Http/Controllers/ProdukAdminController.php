<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::all();
        return view('pages.admin.produk', compact('produk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Menyimpan gambar jika ada
        if ($request->hasFile('gambar')) {
            $gambarPath = Storage::disk('public')->put('produk_images', $request->file('gambar'));
        }

        // Menyimpan data produk ke database
        Produk::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar' => $gambarPath ?? '',
        ]);

        return redirect()->route('produks.index')->with('success', 'Produk berhasil ditambahkan!');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Mencari produk berdasarkan ID
        $produk = Produk::findOrFail($id);

        // Menyimpan gambar baru jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($produk->gambar && file_exists(storage_path('app/public/' . $produk->gambar))) {
                unlink(storage_path('app/public/' . $produk->gambar));
            }

            // Simpan gambar baru
            $gambarPath = $request->file('gambar')->store('produk_images', 'public');
        } else {
            $gambarPath = $produk->gambar; // Jika gambar tidak diubah, pakai gambar lama
        }

        // Memperbarui data produk
        $produk->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar' => $gambarPath ?? $produk->gambar,
        ]);

        return redirect()->route('produks.index')->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produk = Produk::findOrFail($id); // Mencari produk berdasarkan ID

        // Hapus gambar jika ada
        if ($produk->gambar && file_exists(storage_path('app/public/' . $produk->gambar))) {
            unlink(storage_path('app/public/' . $produk->gambar));
        }

        // Hapus produk
        $produk->delete();

        return redirect()->route('produks.index')->with('success', 'Produk berhasil dihapus!');
    }
}
