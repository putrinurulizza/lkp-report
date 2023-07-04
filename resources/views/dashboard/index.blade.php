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
        @slot('overflow', 'overflow-auto')
        @slot('route', route('home.store'))

        @csrf
        <div class="row">
            <input type="hidden" name="id_user" id="id_user" value="{{ auth()->user()->id }}">
            <div class="mb-3">
                <label for="tanggal" class="form-label text-dark">Tanggal</label>
                <input type="text" class="form-control" name="tanggal" id="tanggal"
                    placeholder="{{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, j F Y') }}" readonly>
            </div>
            <div id="input-container" class="mb-3">
                <div class="input text-dark">
                    <label for="kegiatan" class="form-label">Kegiatan</label>
                    <input type="text" class="form-control kegiatan" name="kegiatan[]" id="kegiatan" autofocus required>
                </div>
                <div class="input text-dark mt-3">
                    <label for="hasil" class="form-label">Hasil</label>
                    <input type="text" class="form-control hasil" name="hasil[]" id="hasil">
                </div>
                <button type="button" class="btn btn-success mt-3 add-input">Tambah Kegiatan dan Hasil</button>
            </div>
        </div>
    </x-form_modal>
    {{-- / Modal Tambah Kegiatan --}}
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Tambah input
            $('.add-input').click(function() {
                var inputContainer = $(this).closest('#input-container');
                var newInputContainer = inputContainer.clone();

                // Reset nilai input pada input baru
                newInputContainer.find('.kegiatan').val('');
                newInputContainer.find('.hasil').val('');

                // Tambah input baru setelah input sebelumnya
                inputContainer.after(newInputContainer);

                // Ganti event handler tombol menjadi fungsi hapus input
                newInputContainer.find('.add-input').removeClass('btn-success add-input').addClass(
                    'btn-danger remove-input').text('Hapus');
                newInputContainer.find('.remove-input').click(function() {
                    newInputContainer.remove();
                });
            });

            // Hapus input
            $(document).on('click', '.remove-input', function() {
                var inputContainer = $(this).closest('#input-container');
                inputContainer.remove();
            });
        });
    </script>
@endsection
