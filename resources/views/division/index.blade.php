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
                <a href="{{ route('division.create') }}" class="btn btn-primary">Tambah Tim Kerja</a>
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

                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($allDivision as $division)
                      <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $division->name }}</td>
                        <td>
                            <a href="{{ route('edit-kegiatan',$data->id) }}"><i class="fas fa-edit"></i></a> | <a href="{{ route('delete-kegiatan',$data->id) }}"><i class="fas fa-trash-alt" style="color: red"></i></a>
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
