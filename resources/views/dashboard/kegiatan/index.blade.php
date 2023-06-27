@extends('component.main')
@section('title', 'Riwayat Kegiatan')

@section('content')
    <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Kegiatan</th>
                <th>Hasil</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>ASDFGH</td>
                <td>sdfgh</td>
                <td>
                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editmodal">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapusmodal">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            </tr>

        </tbody>
    </table>
@endsection
