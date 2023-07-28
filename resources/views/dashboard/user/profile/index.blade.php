@extends('component.main')
@section('title', 'Profile')

@section('content')
    <div class="row justify-content-center mt-3 mb-1">
        <div class="col">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('failed'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('failed') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>
    <div class="row justify-content-center mb-5">
        <div class="col col-md-6">
            <div class="card bg-dark text-white border-0">
                <div class="card-body">
                    <div class="text-center">
                        <img src="{{ asset('images/favicon/avatar.jpg') }}" alt="" width="45%" height="45%"
                            class="rounded-circle mb-3 ">
                    </div>
                    <form action="{{ route('profile.update', ['profile' => auth()->user()->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama"
                                value="{{ auth()->user()->nama }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="bidang" class="form-label">Bidang</label>
                            <input type="text" class="form-control @error('bidang') is-invalid @enderror" name="bidang"
                                id="bidang" value="{{ auth()->user()->bidang }}" required>
                            @error('bidang')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" class="form-control @error('jabatan') is-invalid @enderror" name="jabatan"
                                id="jabatan" value="{{ auth()->user()->jabatan }}" required>
                            @error('jabatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                name="username" id="username" value="{{ auth()->user()->username }}" required>
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row text-end">
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Perbarui</button>
                            </div>
                        </div>
                    </form>
                    <div class="row text-end">
                        <div class="col">
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#resetPasswordUser">Reset
                                Password</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

{{-- Modal Reset Password User --}}
<x-form_modal>
    @slot('id', 'resetPasswordUser')
    @slot('title', 'Ganti Password')
    @slot('overflow', 'overflow-auto')
    @slot('route', route('profile.resetPasswordUser', ['profile' => auth()->user()->id]))

    @csrf
    <div class="row">
        <input type="hidden" name="id" value="{{ auth()->user()->id }}">
        <div class="mb-3">
            <label for="password" class="form-label text-dark">Password Lama</label>
            <div id="pwd" class="input-group">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" autofocus required>
                <span class="input-group-text cursor-pointer">
                    <i class="fa-regular fa-eye-slash" id="togglePassword"></i>
                </span>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="passbaru" class="form-label text-dark">Password Baru</label>
            <div id="pwd2" class="input-group">
                <input type="password" class="form-control @error('passbaru') is-invalid @enderror" id="passbaru"
                    name="passbaru" autofocus required>
                <span class="input-group-text cursor-pointer">
                    <i class="fa-regular fa-eye-slash" id="togglePassword"></i>
                </span>
                @error('passbaru')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="konfpass" class="form-label text-dark">Konfirmasi Password Baru</label>
            <div id="pwd3" class="input-group">
                <input type="password" class="form-control @error('konfpass') is-invalid @enderror" id="konfpass"
                    name="konfpass" autofocus required>
                <span class="input-group-text cursor-pointer">
                    <i class="fa-regular fa-eye-slash" id="togglePassword"></i>
                </span>
                @error('konfpass')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    </div>
</x-form_modal>
{{-- / Modal Reset Password User --}}
<script src="{{ asset('js/show-hide-password.js') }}"></script>
