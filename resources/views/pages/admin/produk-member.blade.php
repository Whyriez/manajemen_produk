@extends('layouts.app')
@section('title', 'Produk')
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
                                <li class="breadcrumb-item"><a href="{{ route('produks.members.index') }}">Produk Member</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <form method="GET" action="">
                <div class="mb-3">
                    <label for="id_member" class="form-label">Pilih Member</label>
                    <select class="form-select" name="id_member" id="id_member" required onchange="this.form.submit()">
                        <option value="" disabled {{ request('id_member') ? '' : 'selected' }}>-- Pilih Member --
                        </option>
                        @foreach ($members as $member)
                            <option value="{{ $member->id }}" {{ request('id_member') == $member->id ? 'selected' : '' }}>
                                {{ $member->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>



            <h5 class="mb-3">Produk Member</h5>

            <div class="card tbl-card">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table id="pmember" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Gambar</th>
                                    <th>Tanggal</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produk as $item)
                                    <tr>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->harga }}</td>
                                        <td>{{ $item->stok }}</td>
                                        <td><img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}"
                                                width="50"></td>
                                        <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                        <td>{{ $item->harga }}</td>
                                        <td>
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop" data-id-produk="{{ $item->id }}">
                                                Tambah
                                            </button>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Gambar</th>
                                    <th>Tanggal</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            @if (session('produk_member'))

                <div class="card mt-4">
                    <form action="{{ route('produks.members.saveSession') }}" method="POST">
                        @csrf
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Produk Member Sementara</span>
                            <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                        </div>
                    </form>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Member</th>
                                    <th>Nama Produk</th>
                                    <th>Jumlah</th>
                                    <th>Aksi</th> <!-- Tambahkan kolom aksi -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (session('produk_member') as $index => $item)
                                    @php
                                        $memberName =
                                            optional($members->firstWhere('id', $item['id_member']))->nama ??
                                            'Tidak Diketahui';
                                        $produkName =
                                            optional($produk->firstWhere('id', $item['id_produk']))->nama ??
                                            'Tidak Diketahui';
                                    @endphp
                                    <tr>
                                        <td>{{ $memberName }}</td>
                                        <td>{{ $produkName }}</td>
                                        <td>{{ $item['jumlah'] }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary edit-session-btn"
                                                data-index="{{ $index }}" data-id_produk="{{ $item['id_produk'] }}"
                                                data-id_member="{{ $item['id_member'] }}"
                                                data-jumlah="{{ $item['jumlah'] }}" data-bs-toggle="modal"
                                                data-bs-target="#editSessionModal">
                                                Edit
                                            </button>
                                            <form action="{{ route('produks.members.deleteSession', $index) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus item ini dari session?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>

            @endif



        </div>
    </div>
    <!-- [ Main Content ] end -->

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Produk</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Form Input Produk -->
                <form action="{{ route('produks.members.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_produk" id="edit_id_produk">
                    <input type="hidden" name="id_member" id="hidden_id_member">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_stok" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Tambah Produk Member</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <div class="modal fade" id="editSessionModal" tabindex="-1" aria-labelledby="editSessionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('produks.members.updateSession') }}" method="POST" class="modal-content">
                @csrf
                <input type="hidden" name="index" id="edit_index">
                <input type="hidden" name="id_produk" id="edit_id_produk_session">
                <input type="hidden" name="id_member" id="edit_id_member_session">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSessionModalLabel">Edit Jumlah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <label for="edit_jumlah_session" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" name="jumlah" id="edit_jumlah_session" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>



    <script>
        new DataTable('#pmember');

        document.querySelectorAll('[data-bs-target="#staticBackdrop"]').forEach(button => {
            button.addEventListener('click', () => {
                document.getElementById('edit_id_produk').value = button.dataset.idProduk;

                const selectedMember = document.getElementById('id_member').value;
                document.getElementById('hidden_id_member').value = selectedMember;
            });
        });

        document.querySelectorAll('.edit-session-btn').forEach(button => {
            button.addEventListener('click', () => {
                document.getElementById('edit_index').value = button.dataset.index;
                document.getElementById('edit_id_produk_session').value = button.dataset.idProduk;
                document.getElementById('edit_id_member_session').value = button.dataset.idMember;
                document.getElementById('edit_jumlah_session').value = button.dataset.jumlah;
            });
        });
    </script>
@endsection
