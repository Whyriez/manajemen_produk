<?php

namespace App\Http\Controllers;

use App\Models\DistribusiProduk;
use Illuminate\Http\Request;

class DistribusiProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $distribusi = DistribusiProduk::with(['member', 'produk', 'admin'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.admin.distribusi-produk', compact('distribusi'));
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
