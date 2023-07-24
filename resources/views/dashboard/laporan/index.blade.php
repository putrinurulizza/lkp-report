@extends('component.main')
@section('title', 'Laporan Bulanan')

@section('content')
    <div class=" pt-5 mb-5">

        <div class="row ">
            <div class="col">
                <form action="{{ route('laporan.export') }}" method="GET">
                    <button class="btn btn-success text-light" type="submit">
                        <i class="fa-solid fa-download me-2 " aria-label="Close"></i>
                        Excel
                    </button>
                </form>

                <div class="card mt-3">
                    <div class="card-body">
                        {{-- tables --}}
                        <table id="myTable"
                            class="table table-dark responsive nowrap table-bordered table-striped align-middle"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>HARI/TANGGAL</th>
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
                                                    {!! $loop->iteration . '. ' . $detail->kegiatan . '<br>' !!}
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($kegiatan->detailkegiatans as $detail)
                                                    {!! $detail->hasil . '<br>' !!}
                                                @endforeach
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#modalHapus{{ $loop->iteration }}">
                                                    <i class="fa-regular fa-trash-can fa-lg"></i>
                                                </button>
                                            </td>
                                        </tr>
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
