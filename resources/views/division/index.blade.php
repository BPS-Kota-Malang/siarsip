@extends('layouts.master')
@section('body')

@include('layouts.navbar')
@include('layouts.sidebar')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Kegiatan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Modules</a></div>
                <div class="breadcrumb-item">DataTables</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addDivision">Tambah Kegiatan</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            #
                                        </th>
                                        <th>Nama</th>
                                        <th>Code</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allDivision as $data)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $data->Name }}</td>
                                        <td>{{ $data->Code }}</td>
                                        <td>

                                            <a href="#" data-bs-toggle="modal" data-bs-target="#editDivision"><i class="fas fa-edit"></i></a> |
                                            <a href="{{ route('delete-activity',$data->id) }}"><i
                                                    class="fas fa-trash-alt" style="color: red"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal Add-->
    <div class="modal fade center-modal" id="addDivision" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kegiatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('save-activity') }}" class="needs-validation" novalidate="" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name" required="">
                                    <div class="invalid-feedback">
                                        Tolong isi Nama Kegiatan!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Finance Code</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="finance_code" name="finance_code" required="">
                                    <div class="invalid-feedback">
                                        Maaf, kode tidak valid.
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Divisi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="division" name="division">
                                    <div class="valid-feedback">
                                        Lengkap!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit-->
    <div class="modal fade center-modal" id="edit-activity" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Kegiatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('division.store') }}" class="needs-validation" novalidate="" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name" required="">
                                    <div class="invalid-feedback">
                                        Tolong isi Nama Kegiatan!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Finance Code</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="finance_code" name="finance_code" required="">
                                    <div class="invalid-feedback">
                                        Maaf, kode tidak valid.
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Divisi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="division" name="division">
                                    <div class="valid-feedback">
                                        Lengkap!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </section>
</div>
@endsection

