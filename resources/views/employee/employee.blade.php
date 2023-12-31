@extends('layouts.master')
@section('body')
    @include('layouts.navbar')
    @include('layouts.sidebar')

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Pegawai</h1>
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
                                data-bs-target="#add-employee" style="margin-right: 10px;"><i class="fas fa-plus"></i>
                                Tambah Pegawai</button>
                            <a href="/export-employee"><button type="button" class="btn btn-primary"
                                    style="margin-right: 10px;"><i class="fas fa-file-export"></i> Export
                                    Pegawai</button></a>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#import-employee"><i class="fas fa-file-import"></i> Import Pegawai</button>
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
                                            <th>Divisi</th>
                                            <th>NIP</th>
                                            <th>User</th>
                                            <th>Pangkat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datapegawai as $data)
                                            <tr>
                                                {{-- <input type="hidden" class="delete_id" value="{{ $data->id }}"> --}}
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $data->nama }}</td>
                                                <td>{{ $data->division->Name}}</td>
                                                <td>{{ $data->NIP }}</td>
                                                <td>{{ $data->user->email}}</td>
                                                <td>{{ $data->pangkat }}</td>
                                                <td>
                                                    {{-- <form action="{{ route('delete-employee',$data->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete') --}}
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#edit-employee"><i class="fas fa-edit"></i></a> |
                                                    <a href="#"><i class="fas fa-trash-alt"
                                                            style="color: red"></i></a>
                                                    {{-- </form> --}}
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
    <div class="modal fade center-modal" id="add-employee" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('save-employee') }}" class="needs-validation" novalidate="" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama" name="nama">
                                    <div class="invalid-feedback">
                                        Tolong isi Nama Pegawai!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Divisi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="division_id" name="division_id">
                                    {{-- <select class="form-control" name="division_id" id="division_id">
                                        @foreach ($datapegawai as $data)
                                            <option value="{{ $data }}">{{ $data->division->Name }}</option>
                                        @endforeach
                                    </select> --}}
                                    <div class="invalid-feedback">
                                        Tolong Isi Nama Divisi!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">NIP</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="NIP" name="NIP">
                                    <div class="invalid-feedback">
                                        Tolong Isi NIP!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">User</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="user_id" name="user_id">
                                    {{-- <select class="form-control" name="user_id" id="user_id">
                                        @foreach ($datapegawai as $data)
                                            <option value="{{ $data }}">{{ $data->user->email }}</option>
                                        @endforeach
                                    </select> --}}
                                    <div class="invalid-feedback">
                                        Tolong Isi User!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Pangkat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="pangkat" name="pangkat">
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
    {{-- @include('delete.add-employee') --}}

    <!-- Modal Edit-->
    {{-- @foreach ($datapegawai as $data) --}}
    <div class="modal fade center-modal" id="edit-employee" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($datapegawai->isEmpty())
                        <form action="#" class="needs-validation" novalidate="" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            required="" value="">
                                        <div class="invalid-feedback">
                                            Tolong isi Nama Pegawai!
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Divisi</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="division_id" name="division_id" value="">
                                        <div class="invalid-feedback">
                                            Tolong Isi Nama Divisi!
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">NIP</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="NIP" name="NIP"
                                            value="">
                                        <div class="invalid-feedback">
                                            Tolong Isi NIP!
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">User</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="user_id" name="user_id" value="">
                                        <div class="invalid-feedback">
                                            Maaf, User tidak valid.
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Pangkat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="pangkat" name="pangkat"
                                            value="">
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
                    @else
                        <form action="{{ route('update-employee', $data->id) }}" class="needs-validation" novalidate=""
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nama </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            required="" value="{{ $data->nama }}">
                                        <div class="invalid-feedback">
                                            Tolong isi Nama Pegawai!
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Divisi</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="division_id" name="division_id"
                                            value="{{ $data->division}}">
                                        <div class="invalid-feedback">
                                            Tolong Isi Nama Divisi!
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">NIP</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="NIP" name="NIP"
                                            value="{{ $data->NIP }}">
                                        <div class="invalid-feedback">
                                            Tolong Isi NIP!
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">User</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="user_id" name="user_id"
                                            value="{{ $data->user}}">
                                        <div class="invalid-feedback">
                                            Maaf,User tidak valid.
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Pangkat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="pangkat" name="pangkat"
                                            value="{{ $data->pangkat }}">
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
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{-- @endforeach --}}
    {{-- @include('employee.edit-employee') --}}

    <!-- Modal Import-->
    <div class="modal fade center-modal" id="import-employee" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('import-employee') }}" class="needs-validation" novalidate=""
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <input type="file" class="form-control" id="file" name="file"
                                        required="">
                                    <div class="invalid-feedback">
                                        Tolong upload sebuah file!
                                    </div>
                                    <label class="col-sm-12 col-form-label">- Format file yang di Upload dalam bentuk
                                        (.xlxs) </label>
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
