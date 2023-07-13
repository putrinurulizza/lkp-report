@extends('component.main')
@section('title', 'Riwayat Kegiatan')

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
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahKegiatan"><i
                        class="fa-regular fa-plus me-2 me-2"></i>Tambah</button>
                <button class="btn btn-secondary text-light" data-bs-toggle="modal" data-bs-target="#management"><i
                        class="fa-regular fa-plus me-2 me-2" aria-label="Close"></i>Management </button>
                <div class="card mt-3">
                    <div class="card-body">
                        {{-- tables --}}
                        <table id="myTable"
                            class="table table-dark responsive nowrap table-bordered table-striped align-middle"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>TANGGAL</th>
                                    <th>RINCIAN KEGIATAN</th>
                                    <th>HASIL</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kegiatans as $kegiatan)
                                    @if ($kegiatan->id_user == auth()->user()->id)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $kegiatan->tanggal }}</td>
                                            <td>
                                                @foreach ($kegiatan->detailkegiatans as $detail)
                                                    {!! $loop->iteration .'. '. $detail->kegiatan . '<br>' !!}
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($kegiatan->detailkegiatans as $detail)
                                                    {!!  $detail->hasil . '<br>' !!}
                                                @endforeach
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#modalHapus{{ $loop->iteration }}">
                                                    <i class="fa-regular fa-trash-can fa-lg"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Hapus Data Kegiatan -->
                                        <x-form_modal>
                                            @slot('id', "modalHapus$loop->iteration")
                                            @slot('title', 'Hapus Data Kegiatan')
                                            @slot('route', route('kegiatan.destroy', $kegiatan->id))
                                            @slot('method') @method('delete') @endslot
                                            @slot('btnPrimaryClass', 'btn-outline-danger')
                                            @slot('btnSecondaryClass', 'btn-secondary')
                                            @slot('btnPrimaryTitle', 'Hapus')

                                            <p class="fs-6">Apakah anda yakin akan menghapus data kegiatan
                                                <b>{{ $kegiatan->kegiatan }}</b>?
                                            </p>
                                        </x-form_modal>
                                        {{-- / Hapus Data Kegiatan --}}
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        {{-- end tables --}}

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Tambah Kegiatan --}}
    <x-form_modal>
        @slot('id', 'tambahKegiatan')
        @slot('title', 'Tambah Kegiatan Hari Ini')
        @slot('overflow', 'overflow-auto')
        @slot('route', route('kegiatan.store'))

        @csrf
        <div class="row">
            <input type="hidden" name="id_user" id="id_user" value="{{ auth()->user()->id }}">
            <div class="mb-3">
                <label for="tanggal" class="form-label text-dark">Tanggal</label>
                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal"
                    id="tanggal" required>
                @error('tanggal')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
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
