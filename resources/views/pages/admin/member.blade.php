@extends('layouts.app')
@section('title', 'Member')
@section('member', 'active')

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
                                <li class="breadcrumb-item"><a href="{{ route('admin.member.index') }}">Member</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <h5 class="mb-3">Daftar Member</h5>

            <div class="card tbl-card">
                <div class="card-body">
                    {{-- alert success --}}
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    {{-- end alert success --}}

                    {{-- alert error --}}
                    {{-- Menampilkan pesan error --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    {{-- end alert error --}}

                    <div class="mb-3 text-end">
                        <button class="btn btn-primary" type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">+ Tambah</button>
                    </div>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($member as $m)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $m->nama }}</td>
                                        <td>{{ $m->username }}</td>
                                        <td>{{ $m->role }}</td>
                                        <td>
                                            <!-- Edit Button -->
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#editModal" data-id="{{ $m->id }}"
                                                data-nama="{{ $m->nama }}" data-username="{{ $m->username }}">
                                                <i class="ti ti-pencil"></i>
                                            </button>

                                            <!-- Delete Button (using form to submit) -->
                                            <form action="{{ route('admin.member.destroy', $m->id) }}" method="POST"
                                                class="d-inline-block"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus member ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->

    {{-- Modal Tambah --}}
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Member</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- Form Tambah Member --}}
                    <form id="formTambahMember" action="{{ route('admin.member.store') }}" method="POST" novalidate>
                        @csrf
                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Member</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username Member</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="konfirmasi_password" class="form-label">Konfrimasi Password</label>
                                <input type="password" class="form-control" id="konfirmasi_password"
                                    name="konfirmasi_password" required>
                                <p class="text-danger fs-6 invalid-feedback">password tidak cocok</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Tambah Member</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                    {{-- End Form Tambah Member --}}
                </div>
            </div>
        </div>
    </div>
    {{-- end Modal Tambah --}}

    {{-- Modal Edit --}}
    <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edit Member</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Form Edit Member -->
                <form action="{{ route('admin.member.update', ':id') }}" method="POST" id="formEditMember" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_nama" class="form-label">Nama Member</label>
                            <input type="text" class="form-control" id="edit_nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="edit_username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="edit_password" name="edit_password">
                        </div>
                        <div class="mb-3">
                            <label for="edit_konfirmasi_password" class="form-label">Konfrimasi Password</label>
                            <input type="password" class="form-control" id="edit_konfirmasi_password"
                                name="edit_konfirmasi_password">
                            <p class="text-danger fs-6 invalid-feedback">password tidak cocok</p>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update Member</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Modal Edit --}}

    <script>
        new DataTable('#example');


        // Validasi Konfirmasi Password
        document.addEventListener('DOMContentLoaded', function() {
            handlePasswordValidation('formTambahMember', 'password', 'konfirmasi_password');
            handlePasswordValidation('formEditMember', 'edit_password', 'edit_konfirmasi_password');
        });

        function handlePasswordValidation(formId, passwordId, confirmId) {
            const form = document.getElementById(formId);
            const password = document.getElementById(passwordId);
            const confirmPassword = document.getElementById(confirmId);

            if (form && password && confirmPassword) {
                function validatePasswordMatch() {
                    if (password.value === "" && confirmPassword.value === "") {
                        confirmPassword.setCustomValidity("");
                        confirmPassword.classList.remove('is-invalid', 'is-valid');
                        return;
                    }

                    if (password.value !== confirmPassword.value) {
                        confirmPassword.setCustomValidity("Password tidak cocok");
                        confirmPassword.classList.add('is-invalid');
                        confirmPassword.classList.remove('is-valid');
                    } else {
                        confirmPassword.setCustomValidity("");
                        confirmPassword.classList.remove('is-invalid');
                        confirmPassword.classList.add('is-valid');
                    }
                }

                password.addEventListener('input', validatePasswordMatch);
                confirmPassword.addEventListener('input', validatePasswordMatch);

                form.addEventListener('submit', function(event) {
                    validatePasswordMatch();
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                });
            }
        }
        // end Validasi Konfirmasi Password

        // Edit variabel modal
        var editModal = document.getElementById('editModal');
        editModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget; // Button that triggered the modal
            var id = button.getAttribute('data-id');
            var nama = button.getAttribute('data-nama');
            var username = button.getAttribute('data-username');

            var form = document.getElementById('formEditMember');
            form.action = form.action.replace(':id', id);
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_username').value = username;
        });
        // End edit variabel modal
    </script>
@endsection
