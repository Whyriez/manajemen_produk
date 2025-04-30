@extends('layouts.app')
@section('title', 'Stok Saya')
@section('stok', 'active')

@section('content')
<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Stok Saya</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Stok Saya</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <h5 class="mb-3">Daftar Stok Produk</h5>

        <div class="card tbl-card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama Produk</th>
                                <th>Jumlah Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stok as $s)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $s->nama_produk }}</td>
                                    <td>{{ $s->jumlah_terima }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Nama Produk</th>
                                <th>Jumlah Stok</th>
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
