@extends('component.main')
@section('title', 'Laporan')

@section('content')
    <div class=" pt-5 mb-5">

        <div class="row ">
            <div class="col">
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kegiatans as $kegiatan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kegiatan->kegiatans->tanggal }}</td>
                                        <td>{{ $kegiatan->kegiatan }}</td>
                                        <td>{{ $kegiatan->hasil }}</td>
                                    </tr>
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

@endsection
