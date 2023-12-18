@extends('layouts.master')
@section('body')

@include('layouts.navbar')
@include('layouts.sidebar')


<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Upload File</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">Forms</a></div>
          <div class="breadcrumb-item">Form Validation</div>
        </div>
      </div>

      <div class="section-body">

        <div class="row">
          <div class="col-12">
            <div class="card">
              <form action="{{ route('save-file') }}" class="needs-validation" novalidate="" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Activity</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="activity" name="activity">
                            @foreach ($kegiatans as $id => $name)
                                <option value="{{ $name }}">{{ $name }}</option>
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
                  {{-- <div class="form-group row">
                    <label class="col-sm-2 col-form-label">ID User</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="id_user" name="id_user">
                      <div class="valid-feedback">
                        Good job!
                      </div>
                    </div>
                  </div> --}}
                </div>
                <div class="card-footer text-right">
                  <button type="submit" class="btn btn-primary">add file</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  @endsection
