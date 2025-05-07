<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\password;

class MemberAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $member = User::where('role', 'member')->get();
        return view('pages.superadmin.member', compact('member'));
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
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|min:6',
        ], [
            'password.min' => 'Password minimal 6 karakter',
            'username.unique' => 'Username sudah digunakan',
        ]);

        // Simpan member ke database
        User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password), // Hash password sebelum disimpan
            'role' => 'member', // Atur role menjadi member
        ]);

        return redirect()->back()->with('success', 'Member berhasil ditambahkan!');
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
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'edit_konfirmasi_password' => 'string|min:6',
        ], [
            'username.unique' => 'Username sudah digunakan',
            'edit_konfirmasi_password.min' => 'Password minimal 6 karakter',
        ]);

        $user = User::findOrFail($id);
        $user->nama = $request->nama;
        $user->username = $request->username;

        // Cek apakah password diisi
        if (!empty($request->edit_konfirmasi_password)) {
            $user->password = Hash::make($request->edit_konfirmasi_password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Member berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produk = User::findOrFail($id);
        $produk->delete();
        return redirect()->back()->with('success', 'Member berhasil dihapus.');
    }
}
