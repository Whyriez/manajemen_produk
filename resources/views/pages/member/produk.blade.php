@extends('layouts.app')
@section('title', 'Tambah Transaksi')
@section('produk', 'active')

@section('content')
    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Dashboard</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
                                {{-- <li class="breadcrumb-item"><a href="{{ route('admin.transaksi.index') }}">Transaksi</a></li> --}}
                                <li class="breadcrumb-item active">Tambah Transaksi</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <!-- [ Main Content ] start -->
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif


                    <h5 class="mb-3">Form Tambah Transaksi</h5>

                    <form action="{{ route('addproduks.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="kode_trx" class="form-label">Kode Transaksi</label>
                            <input type="number" name="kode_trx" value="{{ $newKode }}" id="kode_trx"
                                class="form-control" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="id_produk" class="form-label">Produk</label>
                            <select name="id_produk" id="id_produk" class="form-control" required>
                                <option value="">-- Pilih Produk --</option>
                                @foreach ($produk as $item)
                                    <option value="{{ $item->id_produk }}">{{ $item->nama_produk }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jumlah_terjual" class="form-label">Jumlah Terjual</label>
                            <input type="number" name="jumlah_terjual" id="jumlah_terjual" class="form-control" required>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>

                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection
