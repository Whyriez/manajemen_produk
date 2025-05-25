@extends('layouts.app')
@section('title', 'Distribusi Produk Member')
@section('penjualan', 'active')

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
                                <li class="breadcrumb-item active">Distribusi Produk Member</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <h5 class="mb-3">Data Distribusi Produk</h5>

            <div class="card tbl-card">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nama Member</th>
                                    <th>Nama Produk</th>
                                    <th>Jumlah Terdistribusi</th>
                                    <th>Tanggal Distribusi</th>
                                    <th>Admin yang Mendistrubusi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($distribusi as $item)
                                    <tr>
                                        <td>{{ $item->member->nama }}</td>
                                        <td>{{ $item->produk->nama }}</td>
                                        <td>{{ $item->jumlah }}</td>
                                        <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                                        <td>{{ $item->admin->nama }}</td>
                                    </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th>Nama Member</th>
                                    <th>Nama Produk</th>
                                    <th>Jumlah Terdistribusi</th>
                                    <th>Tanggal Distribusi</th>
                                    <th>Admin yang Mendistrubusi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <script>
        new DataTable('#example');
    </script>
@endsection
