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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-file">Add Archive</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Tim Kerja</th>
                                        <th>Kegiatan</th>
                                        <th>Tahapan</th>
                                        <th>Pilar Zone Integritas</th>
                                        {{-- <th>Download</th> --}}
                                        <th>Nama File</th>
                                        <th>User</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($files as $data)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ optional($data->activity)->division->name }}</td>
                                            <td>{{ optional($data->activity)->name }}</td>
                                            <td>{{ optional($data->phase)->name }}</td>
                                            <td>{{ optional($data->zone)->name }}</td>
                                            <td>{{ $data->file_name}}</td>
                                            {{-- <td>{{ optional($data->user)->username }}</td> --}}
                                            <td>{{ optional($data->user)->name }}</td>
                                            <td>

                                                {{-- <a href="{{ route('previewFile'), $data->id }}" target="_blank" class="btn btn-info">
                                                    <i class="fa fa-eye"></i><span class="visually-hidden">Preview</span>
                                                </a> --}}
                                                <a href="{{ route('previewFile', $data->id) }}" target="_blank" class="btn btn-info"><i class="fa fa-eye" aria-hidden="true">
                                                    </i><span class="visually-hidden">Download</span>
                                                </a>
                                                <a href="javascript:void(0)" class="btn btn-info copy-link" data-link="{{ $data->preview_link }}">
                                                    <i class="fa fa-file"></i><span class="visually-hidden">Copy</span>
                                                </a>
                                                <a href="{{ route('downloadFile', $data->id) }}" class="btn btn-success"><i class="fa fa-download" aria-hidden="true">
                                                    </i><span class="visually-hidden">Download</span>
                                                </a>
                                            {{-- <br> --}}
                                                <a href="#" class="btn btn-info edit-button" data-bs-toggle="modal" data-bs-target="#edit-file" data-id="{{ $data->id }}" data-activity="{{ $data->activity_id }}" data-preview-link="{{ $data->preview_link }}" data-download-link="{{ $data->download_link }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('delete-file', $data->id) }}">
                                                    <i class="btn btn-info fas fa-trash-alt" style="color: red"></i>
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
    <!-- Modal Add -->
    <div class="modal fade center-modal" id="add-file" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kegiatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('file.store') }}" class="needs-validation" novalidate="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Activity</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="activity_id" name="activity_id">
                                        @foreach ($activities as $activity)
                                            <option value="{{ $activity->id }}">{{ $activity->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Kegiatan belum diisi</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tahapan</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="phase_id" name="phase_id">
                                        @foreach ($phases as $phase)
                                            <option value="{{ $phase->id }}">{{ $phase->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Kegiatan belum diisi</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Pilar Zona Integritas</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="zone_id" name="zone_id">
                                        @foreach ($zones as $zone)
                                            <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Kegiatan belum diisi</div>
                                </div>
                            </div>

                            <!-- Input untuk file -->
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Upload File</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="file_content" name="file_content[]" multiple>
                                    <div class="valid-feedback">File berhasil diunggah</div>
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

    @if($files->isEmpty())
    datakosong
    @else
    <!-- Modal Edit -->
    <div class="modal fade center-modal" id="edit-file" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($files->isEmpty())
                        <p>data kosong</p>
                    @else
                        <form action="{{ route('file.update', $data->id) }}" class="needs-validation" novalidate="" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Activity</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="activity" name="activity_id">
                                            @foreach ($activities as $activity)
                                                {{-- <option value="{{ $activity-> id }}" {{ $data->activity_id == $id ? 'selected' : '' }}>{{ $activity->name }}</option> --}}
                                                <option value="{{ $activity->id }}">{{ $activity->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">kegiatan belum diisi</div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tahapan</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="phase_id" name="phase_id">
                                            @foreach ($phases as $phase)
                                                <option value="{{ $phase->id }}">{{ $phase->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Kegiatan belum diisi</div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Pilar Zona Integritas</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="zone_id" name="zone_id">
                                            @foreach ($zones as $zone)
                                                <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Kegiatan belum diisi</div>
                                    </div>
                                </div>
                            </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">File Content</label>
                            <div class="col-sm-10">
                                @if ($data->file_content)
                                    <p>File Sebelumnya: {{ $data->file_content }}</p>
                                @endif
                                <input type="file" class="form-control" id="file_content" name="file_content">
                                <div class="valid-feedback">File berhasil ditambah</div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
</section>
</div>



@endsection
