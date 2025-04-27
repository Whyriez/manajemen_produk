@extends('layouts.app')
@section('title', 'Transaksi Saya')
@section('stok', 'active')

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Transaksi Saya</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Transaksi Saya</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <h5 class="mb-3">Daftar Transaksi</h5>

            <div class="card tbl-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Kode Transaksi</th>
                                    <th>Nama Produk</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah Terjual</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi as $t)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $t->kode_trx }}</td>
                                        <td>{{ $t->nama_produk }}</td>
                                        <td>{{ $t->tanggal }}</td>
                                        <td>{{ $t->jumlah_terjual }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Transaksi</th>
                                    <th>Nama Produk</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah Terjual</th>

                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        new DataTable('#example');
    </script>
@endsection
