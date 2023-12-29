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
                            data-bs-target="#add-activity" style="margin-right: 10px;"><i class="fas fa-plus"></i> Tambah Kegiatan</button>
                        <a href="/export-activity"><button type="button" class="btn btn-primary" style="margin-right: 10px;"><i class="fas fa-file-export"></i> Export Kegiatan</button></a>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#import-activity"><i class="fas fa-file-import"></i> Import Kegiatan</button>
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
                                        <th>Finance Code</th>
                                        <th>Divisi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach ($datakegiatan as $data)
                                        <tr>
                                            {{-- <input type="hidden" class="delete_id" value="{{ $data->id }}"> --}}
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->finance_code }}</td>
                                            <td>{{ $data->division }}</td>
                                            <td>
                                                {{-- <form action="{{ route('delete-activity',$data->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete') --}}
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#edit-activity"><i class="fas fa-edit"></i></a> |
                                                <a href="#"><i class="fas fa-trash-alt" style="color: red"></i></a>
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
    <div class="modal fade center-modal" id="add-activity" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <input type="text" class="form-control" id="name" name="name" >
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
                                    {{-- <select class="form-control" name="division" id="division">
                                        @foreach ($datakegiatan as $data)
                                            <option value="{{ $data }}">{{ $data->division }}</option>
                                        @endforeach
                                    </select> --}}
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
    {{-- @include('activity.add-activity') --}}

    <!-- Modal Edit-->
    {{-- @foreach ($datakegiatan as $data) --}}
    <div class="modal fade center-modal" id="edit-activity" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Kegiatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($datakegiatan->isEmpty())
                    <form action="#" class="needs-validation" novalidate="" method="POST">
                        @csrf
                        <div class="card-body">
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama </label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="name" name="name" required="" value="">
                              <div class="invalid-feedback">
                                Tolong isi Nama Kegiatan!
                              </div>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Finance Code</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="finance_code" name="finance_code" value="">
                              <div class="invalid-feedback">
                                Maaf, Kode tidak valid.
                              </div>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Divisi</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="division" name="division" value="">
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
                    <form action="{{ route('update-activity',$data->id) }}" class="needs-validation" novalidate="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama </label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="name" name="name" required="" value="{{ $data->name }}">
                              <div class="invalid-feedback">
                                Tolong isi Nama Kegiatan!
                              </div>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Finance Code</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="finance_code" name="finance_code" value="{{ $data->finance_code }}">
                              <div class="invalid-feedback">
                                Maaf, Kode tidak valid.
                              </div>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Divisi</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="division" name="division" value="{{ $data->division }}">
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
    {{-- @include('activity.edit-activity') --}}

    <!-- Modal Import-->
    <div class="modal fade center-modal" id="import-activity" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Kegiatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('import-activity') }}" class="needs-validation" novalidate="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <input type="file" class="form-control" id="file" name="file" required="">
                                    <div class="invalid-feedback">
                                        Tolong upload sebuah file!
                                    </div>
                                    <label class="col-sm-12 col-form-label">- Format file yang di Upload dalam bentuk (.xlxs) </label>
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
