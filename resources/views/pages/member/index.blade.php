@extends('layouts.app')
@section('title', 'Member')
@section('dashboard', 'active')

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
                                <h5 class="m-b-10">Home</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <h5>Welcome, {{ $member->nama }}!</h5>

            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-lg">
                        <div class="card-body p-4 text-center">
                            <h6 class="mb-2 text-muted f-w-400">Total Penjualan Saya</h6>
                            <h3 class="mb-3 fw-bold">Rp.{{ number_format($totalSales, 2) }}</h3>
                            <div class="border-top pt-2">
                                <small class="text-muted">Updated: {{ \Carbon\Carbon::now()->format('M d, Y') }}</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-lg">
                        <div class="card-body p-4 text-center">
                            <h6 class="mb-2 text-muted f-w-400">Total Produk Saya</h6>
                            <h3 class="mb-3 fw-bold">{{ $totalProdukSaya }}</h3>
                            <div class="border-top pt-2">
                                <small class="text-muted">Updated: {{ \Carbon\Carbon::now()->format('M d, Y') }}</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-lg">
                        <div class="card-body p-4 text-center">
                            <h6 class="mb-2 text-muted f-w-400">Total Stok Produk Saya</h6>
                            <h3 class="mb-3 fw-bold">{{ $totalProdukDiterima }}</h3>
                            <div class="border-top pt-2">
                                <small class="text-muted">Updated: {{ \Carbon\Carbon::now()->format('M d, Y') }}</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-xl-8">
                    <h5 class="mb-3">Pesanan Terbaru</h5>
                    <div class="card tbl-card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-borderless mb-0">
                                    <thead>
                                        <tr>
                                            <th>No. Pelacakan</th>
                                            <th>Nama Produk</th>
                                            <th>Total Pesanan</th>
                                            <th>Status</th>
                                            <th class="text-end">Total Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($recentOrders as $order)
                                            <tr>
                                                <td><a href="#" class="text-muted">{{ $order->kode_trx }}</a></td>
                                                <td>{{ $order->produk->nama }}</td>
                                                <td>{{ $order->jumlah_terjual }}</td>
                                                <td>
                                                    <span class="d-flex align-items-center gap-2">
                                                        <i class="fas fa-circle text-success {{ $order->status_class }}"></i>
                                                        {{ $order->status_text }}
                                                    </span>
                                                </td>
                                                <td class="text-end">
                                                    Rp.{{ number_format($order->jumlah_terjual * $order->produk->harga, 2) }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">Tidak ada pesanan terbaru</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-12 col-xl-4">
                    <h5 class="mb-3">Riwayat Transaksi</h5>
                    <div class="card">
                        <div class="list-group list-group-flush">
                            @forelse ($recentTransactions as $transaction)
                                <a href="#" class="list-group-item list-group-item-action">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <div class="avtar avtar-s rounded-circle text-success bg-light-success">
                                                <i class="ti ti-gift f-18"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">Pesanan #{{ $transaction->kode_trx }}</h6>
                                            <p class="mb-0 text-muted">{{ $transaction->created_at->diffForHumans() }}</p>
                                        </div>
                                        <div class="flex-shrink-0 text-end">
                                            <h6 class="mb-1">+
                                                Rp.{{ number_format($transaction->jumlah_terjual * $transaction->produk->harga, 2) }}
                                            </h6>
                                            <p class="mb-0 text-muted">{{ $transaction->percentage_change }}%</p>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="list-group-item text-center">Tidak ada riwayat transaksi</div>
                            @endforelse
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection
