@extends('layouts.master')
@section('body')

@include('layouts.navbar')
@include('layouts.sidebar')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Tambah Kegiatan</h1>
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
              <form action="{{ route('save-activity') }}" class="needs-validation" novalidate="" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama </label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="name" name="name" required="">
                      <div class="invalid-feedback">
                        What's your name?
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Finance Code</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="finance_code" name="finance_code" required="">
                      <div class="invalid-feedback">
                        Oh no! Email is invalid.
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Divisi</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="division" name="division">
                      <div class="valid-feedback">
                        Good job!
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-right">
                  <button type="submit" class="btn btn-primary">Tambah Data</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  @endsection
