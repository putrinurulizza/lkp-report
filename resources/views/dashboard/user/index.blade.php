@extends('component.main')
@section('title', 'User')

@section('content')
    <div class=" pt-5 mb-5">
        <div class="row ">
            <div class="col">
                <a class="btn btn-primary" href="#">
                    <i class="fa-regular fa-plus me-2"></i>
                    Tambah
                </a>
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

                                <tr>
                                    <td>1</td>
                                    <td>Putri Nurul Izza</td>
                                    <td>Magang</td>
                                    <td>TIK</td>
                                    <td>putri</td>
                                    <td>Admin</td>
                                    <td>
                                        <button class="btn btn-sm btn-secondary" data-bs-toggle="modal"
                                            data-bs-target="#modalResetPassword">
                                            <i class="fa-regular fa-unlock-keyhole"></i>
                                        </button>
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#modalEdit">
                                            <i class="fa-regular fa-pen-to-square fa-lg"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalHapus">
                                            <i class="fa-regular fa-trash-can fa-lg"></i>
                                        </button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        {{-- end tables --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
