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
                <a href="{{ route('add-file') }}" class="btn btn-primary">Tambah File</a>
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
                        <td>{{ $data->activity}}</td>
                        <td>{{ $data->preview_link }}</td>
                        <td>{{ $data->download_link }}</td>
                        <td>
                            <a href="{{ route('edit-file',$data->id) }}"><i class="fas fa-edit"></i></a> | <a href="{{ route('delete-file',$data->id) }}"><i class="fas fa-trash-alt" style="color: red"></i></a>
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
    </section>
  </div>
  @endsection
