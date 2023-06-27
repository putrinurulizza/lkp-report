@extends('component.main')
@section('title', 'Home')

@section('content')
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
            <div class="mb-3">
                <label for="tanggal" class="form-label text-dark">Tanggal</label>
                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal"
                    id="tanggal" disabled>
                @error('tanggal')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
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
    {{-- / Modal Tambah Kategori --}}
@endsection
