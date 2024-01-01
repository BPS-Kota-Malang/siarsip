@extends('layouts.master')
@section('body')

@include('layouts.navbar')
@include('layouts.sidebar')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Data File Upload</h1>
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
                        data-bs-target="#add-file">Tambah Kegiatan</button>
                </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped" id="table-1">
                    <thead>
                      <tr>
                        <th class="text-center">
                          No
                        </th>
                        <th>Kegiatan</th>
                        <th>Preview Link</th>
                        <th>Download Link</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataUpload as $data)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ optional($data->activity)->name }}</td>
                            <td>{{ $data->preview_link }}</td>
                            <td>{{ $data->download_link }}</td>
                            <td>
                                <a href="#" class="edit-button" data-bs-toggle="modal" data-bs-target="#edit-file" data-id="{{ $data->id }}" data-activity="{{ $data->activity_id }}" data-preview-link="{{ $data->preview_link }}" data-download-link="{{ $data->download_link }}">
                                    <i class="fas fa-edit"></i>
                                </a>


                                <a href="{{ route('delete-file', $data->id) }}">
                                    <i class="fas fa-trash-alt" style="color: red"></i>
                                </a>
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
  <div class="modal fade center-modal" id="add-file" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kegiatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('save-file') }}" class="needs-validation" novalidate="" method="POST">
                  @csrf
                  <div class="card-body">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Activity</label>
                      <div class="col-sm-10">
                          <select class="form-control" id="activity_id" name="activity_id">
                              @foreach ($kegiatans as $id => $name)
                                  <option value="{{ $id }}">{{ $name }}</option>
                              @endforeach
                          </select>
                        <div class="invalid-feedback">
                              kegiatan belum diisi
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Preview Link</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="preview_link" name="preview_link" required="">
                        <div class="invalid-feedback">
                          //
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Download Link</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="download_link" name="download_link">
                        <div class="valid-feedback">
                          Good job!
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">add file</button>
                  </div>
                </form>
              </div>
        </div>
    </div>
</div>

<!-- Modal Edit-->
@foreach ($dataUpload as $data)
<div class="modal fade center-modal" id="edit-file" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($dataUpload->isEmpty())
                    <p>data kosong</p>
                    @else
                <form action="{{ route('update-file',$data->id) }}" class="needs-validation" novalidate="" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="card-body">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Activity</label>
                      <div class="col-sm-10">
                          <select class="form-control" id="activity" name="activity_id" value="{$data->activity->name}">
                              @foreach ($kegiatans as $id => $name)
                                  <option value="{{ $id }}">{{ $name }}</option>
                              @endforeach
                          </select>
                        <div class="invalid-feedback">
                              kegiatan belum diisi
                        </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Preview Linkk</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="preview_link" name="preview_link" required="" value="{{ $data->preview_link }}">
                        <div class="invalid-feedback">
                          Oh no! Link is invalid
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Download Link</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="download_link" name="download_link" value="{{ $data->download_link }}">
                        <div class="valid-feedback">
                          File berhasil ditambah
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                  </div>
                </form>
                @endif
              </div>
              @endforeach
    </section>
  </div>
  @endsection
