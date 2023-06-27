@extends('component.main')
@section('title', 'Riwayat Kegiatan')

@section('content')
<div class=" pt-5 mb-5">
    <div class="row ">
        <div class="col">
            <a class="btn btn-primary" href="#">
                <i class="fa-regular fa-plus me-2"></i>
                Tambah
            </a>
            <div class="card mt-3">
                <div class="card-body" >

                    {{-- tables --}}
                    <table id="myTable" class="table table-dark responsive nowrap table-bordered table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Asal Sekolah</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                                <tr>
                                    <td>1</td>
                                    <td>2020</td>
                                    <td>tajul</td>
                                    <td>poltek</td>
                                    <td>guru</td>
                                    <td>
                                        <button class="btn btn-sm btn-dark" data-bs-toggle="modal"
                                            data-bs-target="#modalResetPassword">
                                            <i class="fa-regular fa-unlock-keyhole"></i>
                                        </button>
                                        <a href="" class="btn btn-sm btn-warning">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalHapus">
                                            <i class="fa-regular fa-trash-can fa-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>2020</td>
                                    <td>tajul</td>
                                    <td>poltek</td>
                                    <td>guru</td>
                                    <td>
                                        <button class="btn btn-sm btn-dark" data-bs-toggle="modal"
                                            data-bs-target="#modalResetPassword">
                                            <i class="fa-regular fa-unlock-keyhole"></i>
                                        </button>
                                        <a href="" class="btn btn-sm btn-warning">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalHapus">
                                            <i class="fa-regular fa-trash-can fa-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>2020</td>
                                    <td>tajul</td>
                                    <td>poltek</td>
                                    <td>guru</td>
                                    <td>
                                        <button class="btn btn-sm btn-dark" data-bs-toggle="modal"
                                            data-bs-target="#modalResetPassword">
                                            <i class="fa-regular fa-unlock-keyhole"></i>
                                        </button>
                                        <a href="" class="btn btn-sm btn-warning">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalHapus">
                                            <i class="fa-regular fa-trash-can fa-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>2020</td>
                                    <td>tajul</td>
                                    <td>poltek</td>
                                    <td>guru</td>
                                    <td>
                                        <button class="btn btn-sm btn-dark" data-bs-toggle="modal"
                                            data-bs-target="#modalResetPassword">
                                            <i class="fa-regular fa-unlock-keyhole"></i>
                                        </button>
                                        <a href="" class="btn btn-sm btn-warning">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalHapus">
                                            <i class="fa-regular fa-trash-can fa-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>2020</td>
                                    <td>tajul</td>
                                    <td>poltek</td>
                                    <td>guru</td>
                                    <td>
                                        <button class="btn btn-sm btn-dark" data-bs-toggle="modal"
                                            data-bs-target="#modalResetPassword">
                                            <i class="fa-regular fa-unlock-keyhole"></i>
                                        </button>
                                        <a href="" class="btn btn-sm btn-warning">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalHapus">
                                            <i class="fa-regular fa-trash-can fa-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>2020</td>
                                    <td>tajul</td>
                                    <td>poltek</td>
                                    <td>guru</td>
                                    <td>
                                        <button class="btn btn-sm btn-dark" data-bs-toggle="modal"
                                            data-bs-target="#modalResetPassword">
                                            <i class="fa-regular fa-unlock-keyhole"></i>
                                        </button>
                                        <a href="" class="btn btn-sm btn-warning">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalHapus">
                                            <i class="fa-regular fa-trash-can fa-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>2020</td>
                                    <td>tajul</td>
                                    <td>poltek</td>
                                    <td>guru</td>
                                    <td>
                                        <button class="btn btn-sm btn-dark" data-bs-toggle="modal"
                                            data-bs-target="#modalResetPassword">
                                            <i class="fa-regular fa-unlock-keyhole"></i>
                                        </button>
                                        <a href="" class="btn btn-sm btn-warning">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalHapus">
                                            <i class="fa-regular fa-trash-can fa-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>2020</td>
                                    <td>tajul</td>
                                    <td>poltek</td>
                                    <td>guru</td>
                                    <td>
                                        <button class="btn btn-sm btn-dark" data-bs-toggle="modal"
                                            data-bs-target="#modalResetPassword">
                                            <i class="fa-regular fa-unlock-keyhole"></i>
                                        </button>
                                        <a href="" class="btn btn-sm btn-warning">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalHapus">
                                            <i class="fa-regular fa-trash-can fa-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>2020</td>
                                    <td>tajul</td>
                                    <td>poltek</td>
                                    <td>guru</td>
                                    <td>
                                        <button class="btn btn-sm btn-dark" data-bs-toggle="modal"
                                            data-bs-target="#modalResetPassword">
                                            <i class="fa-regular fa-unlock-keyhole"></i>
                                        </button>
                                        <a href="" class="btn btn-sm btn-warning">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalHapus">
                                            <i class="fa-regular fa-trash-can fa-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>2020</td>
                                    <td>tajul</td>
                                    <td>poltek</td>
                                    <td>guru</td>
                                    <td>
                                        <button class="btn btn-sm btn-dark" data-bs-toggle="modal"
                                            data-bs-target="#modalResetPassword">
                                            <i class="fa-regular fa-unlock-keyhole"></i>
                                        </button>
                                        <a href="" class="btn btn-sm btn-warning">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalHapus">
                                            <i class="fa-regular fa-trash-can fa-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>2020</td>
                                    <td>tajul</td>
                                    <td>poltek</td>
                                    <td>guru</td>
                                    <td>
                                        <button class="btn btn-sm btn-dark" data-bs-toggle="modal"
                                            data-bs-target="#modalResetPassword">
                                            <i class="fa-regular fa-unlock-keyhole"></i>
                                        </button>
                                        <a href="" class="btn btn-sm btn-warning">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalHapus">
                                            <i class="fa-regular fa-trash-can fa-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>2020</td>
                                    <td>tajul</td>
                                    <td>poltek</td>
                                    <td>guru</td>
                                    <td>
                                        <button class="btn btn-sm btn-dark" data-bs-toggle="modal"
                                            data-bs-target="#modalResetPassword">
                                            <i class="fa-regular fa-unlock-keyhole"></i>
                                        </button>
                                        <a href="" class="btn btn-sm btn-warning">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalHapus">
                                            <i class="fa-regular fa-trash-can fa-lg"></i>
                                        </button>
                                    </td>
                                </tr>

                                {{-- Modal Hapus User --}}
                                <div class="modal fade" id="modalHapus" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="" method="post">
                                                @method('delete')
                                                @csrf
                                                <div class="modal-body">
                                                    <p class="fs-6">Apakah anda yakin akan menghapus user
                                                        <b></b>?
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-outline-danger">Hapus</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- / Modal Hapus User --}}

                        </tbody>
                    </table>
                    {{-- end tables --}}

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
