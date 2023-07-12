@extends('component.main')
@section('title', 'User')

@section('content')
    <div class=" pt-5 mb-5">
        <div class="row">
            <div class="col-sm-6 col-md">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session()->has('failed'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('failed') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
        </div>

        <div class="row ">
            <div class="col">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahUser"><i
                        class="fa-regular fa-plus me-2 me-2"></i>Tambah</button>
                <div class="card mt-3">
                    <div class="card-body">

                        {{-- tables --}}
                        <table id="myTable"
                            class="table table-dark responsive nowrap table-bordered table-striped align-middle"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Bidang</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->nama }}</td>
                                        <td>{{ $user->jabatan }}</td>
                                        <td>{{ $user->bidang }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>
                                            @php
                                                if ($user->is_admin) {
                                                    $is_admin = 'Admin';
                                                } else {
                                                    $is_admin = 'User';
                                                }
                                            @endphp
                                            {{ $is_admin }}
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-secondary" data-bs-toggle="modal"
                                                data-bs-target="#modalResetPassword{{ $loop->iteration }}">
                                                <i class="fa-regular fa-unlock-keyhole"></i>
                                            </button>
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#modalEdit{{ $loop->iteration }}">
                                                <i class="fa-regular fa-pen-to-square fa-lg"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#modalHapus{{ $loop->iteration }}">
                                                <i class="fa-regular fa-trash-can fa-lg"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Edit Data User -->
                                    <x-form_modal>
                                        @slot('id', "modalEdit$loop->iteration")
                                        @slot('title', 'Edit Data user')
                                        @slot('route', route('user.update', $user->id))
                                        @slot('method') @method('put') @endslot
                                        @slot('btnprimaryTitle', 'Perbarui')

                                        @csrf
                                        <div class="row">
                                            <div class="mb-3">
                                                <label for="nama" class="form-label text-dark">Nama</label>
                                                <input type="text"
                                                    class="form-control @error('nama') is-invalid @enderror" name="nama"
                                                    id="nama" value="{{ old('nama', $user->nama) }}" autofocus
                                                    required>
                                                @error('nama')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="jabatan" class="form-label text-dark">Jabatan</label>
                                                <input type="text"
                                                    class="form-control @error('jabatan') is-invalid @enderror"
                                                    name="jabatan" id="jabatan"
                                                    value="{{ old('jabatan', $user->jabatan) }}" autofocus required>
                                                @error('jabatan')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="bidang" class="form-label text-dark">Bidang</label>
                                                <input type="text"
                                                    class="form-control @error('bidang') is-invalid @enderror"
                                                    name="bidang" id="bidang"
                                                    value="{{ old('bidang', $user->bidang) }}" autofocus required>
                                                @error('bidang')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="username" class="form-label text-dark">Username</label>
                                                <input type="text"
                                                    class="form-control @error('username') is-invalid @enderror"
                                                    name="username" id="username"
                                                    value="{{ old('username', $user->username) }}" autofocus required>
                                                @error('username')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="is_admin" class="form-label">Role</label>
                                                <select class="form-select text-dark" id="is_admin" name="is_admin">
                                                    @foreach ([1 => 'Admin', 0 => 'User'] as $bool => $role)
                                                        <option value="{{ $bool }}"
                                                            {{ old('is_admin', $user->is_admin) == $bool ? 'selected' : '' }}>
                                                            {{ $role }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </x-form_modal>
                                    {{-- / Edit Data User --}}

                                    <!-- Hapus Data User -->
                                    <x-form_modal>
                                        @slot('id', "modalHapus$loop->iteration")
                                        @slot('title', 'Hapus Data User')
                                        @slot('route', route('user.destroy', $user->id))
                                        @slot('method') @method('delete') @endslot
                                        @slot('btnPrimaryClass', 'btn-outline-danger')
                                        @slot('btnSecondaryClass', 'btn-secondary')
                                        @slot('btnPrimaryTitle', 'Hapus')

                                        <p class="fs-6">Apakah anda yakin akan menghapus data user
                                            <b>{{ $user->nama }}</b>?
                                        </p>
                                    </x-form_modal>
                                    {{-- / Hapus Data User --}}

                                    {{-- Modal Reset Password Admin --}}
                                    <x-form_modal>
                                        @slot('id', "modalResetPassword$loop->iteration")
                                        @slot('title', 'Ganti Password')
                                        @slot('route', route('user.resetPasswordAdmin', $user->id))
                                        @slot('method') @method('put') @endslot

                                        @csrf
                                        <div class="row">
                                            <div class="mb-3">
                                                <label for="password" class="form-label text-dark">Password Baru</label>
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    id="password" name="password" autofocus required>
                                                @error('password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </x-form_modal>
                                    {{-- / Modal Reset Password Admin --}}
                                @endforeach
                            </tbody>
                        </table>
                        {{-- end tables --}}

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Tambah User --}}
    <x-form_modal>
        @slot('id', 'tambahUser')
        @slot('title', 'Tambah User')
        @slot('overflow', 'overflow-auto')
        @slot('route', route('user.store'))

        @csrf
        <div class="row">
            <div class="mb-3">
                <label for="nama" class="form-label text-dark">Nama</label>
                <input type="name" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"
                    autofocus required>
                @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="jabatan" class="form-label text-dark">Jabatan</label>
                <input type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan"
                    name="jabatan" autofocus required>
                @error('jabatan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="bidang" class="form-label text-dark">Bidang</label>
                <input type="text" class="form-control @error('bidang') is-invalid @enderror" id="bidang"
                    name="bidang" autofocus required>
                @error('bidang')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="username" class="form-label text-dark">Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                    name="username" autofocus required>
                @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label text-dark">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" autofocus required>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="is_admin" class="form-label text-dark">Role</label>
                <select class="form-select" id="is_admin" name="is_admin">
                    <option value="1" selected>Admin</option>
                    <option value="0">User</option>
                </select>
            </div>
        </div>
    </x-form_modal>
    {{-- / Modal Tambah User --}}
@endsection
