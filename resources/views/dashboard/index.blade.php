@extends('component.main')
@section('title', 'Home')

@section('content')
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

    <main class="px-3 text-center">
        <h2>Laporan Kinerja Pegawai</h2>
        <p class="lead fs-5">Tambahkan kegiatan anda hari ini melalui button di bawah!</p>
        <p class="lead">
            <button class="btn btn-lg btn-secondary fw-bold border-white bg-white" data-bs-toggle="modal"
                data-bs-target="#tambahKegiatan">Kegiatan</button>
        </p>
    </main>

    {{-- Modal Tambah Kegiatan --}}
    <x-form_modal>
        @slot('id', 'tambahKegiatan')
        @slot('title', 'Tambah Kegiatan Hari Ini')
        @slot('route', route('home.store'))

        @csrf
        <div class="row">
            <input type="hidden" name="id_user" id="id_user" value="{{ auth()->user()->id }}">
            <div class="mb-3">
                <label for="tanggal" class="form-label text-dark">Tanggal</label>
                <input type="text" class="form-control" name="tanggal" id="tanggal"
                    placeholder="{{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, j F Y') }}" readonly>
            </div>
            <div class="mb-3">
                <label for="kegiatan" class="form-label text-dark">Kegiatan</label>
                <input type="text" class="form-control @error('kegiatan') is-invalid @enderror" name="kegiatan"
                    id="kegiatan" autofocus required>
                @error('kegiatan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="hasil" class="form-label text-dark">Hasil</label>
                <input type="text" class="form-control @error('hasil') is-invalid @enderror" name="hasil"
                    id="hasil" autofocus required>
                @error('hasil')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    </x-form_modal>
    {{-- / Modal Tambah Kegiatan --}}
@endsection
