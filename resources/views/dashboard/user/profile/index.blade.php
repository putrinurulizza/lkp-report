@extends('component.main')
@section('title', 'Profile')

@section('content')
    <div class="row justify-content-center mt-5 mb-1">
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
    <div class="row justify-content-center mt-1 mb-5 ">
        <div class="col col-md-6">
            <div class="card bg-dark text-white">
                <div class="card-body">
                    <img src="https://github.com/mdo.png" alt="" width="50%" class="rounded-circle me-2">
                    <form action="" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama" value=""
                                autofocus required>
                        </div>
                        <div class="mb-3">
                            <label for="bidang" class="form-label">Bidang</label>
                            <input type="text" class="form-control @error('bidang') is-invalid @enderror" name="bidang"
                                id="bidang" value="" required>
                            @error('bidang')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" class="form-control @error('jabatan') is-invalid @enderror" name="jabatan"
                                id="jabatan" value="" required>
                            @error('jabatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- <div class="mb-3">
                            <label for="role" class="form-label">Status</label>
                            @php
                                if (auth()->user()->role == 0) {
                                    $role = 'Mahasiswa';
                                } elseif (auth()->user()->role == 1) {
                                    $role = 'Guru';
                                } elseif (auth()->user()->role == 2) {
                                    $role = 'Operator';
                                }
                            @endphp
                            <input type="text" class="form-control" name="role" id="role"
                                value="{{ $role }}" required disabled>
                        </div> --}}

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/show-hide-password.js') }}"></script>
@endsection
