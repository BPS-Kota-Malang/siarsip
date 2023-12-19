@extends('layouts.master')

    <section class="section">
      <div class="container mt-3">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="{{ asset('assets/img/stisla-fill.svg') }}" width="100" class="shadow-light rounded-circle">
            </div>
            @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="card card-primary">
              <div class="card-header" style="display: flex; justify-content: center; align-items: center;"><h3>Login</h3></div>

              <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group mb-2">
                        <label for="username">Username</label>
                        <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}">
                    {{-- @if($errors->has('username'))
                        <div class="alert alert-danger">{{ $errors->first('username') }}</div>
                    @endif --}}
                        <div class="invalid-feedback">
                            Please fill in your username
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <div class="d-block">
                            <label for="password" class="control-label">Password</label>
                          <div class="float-right">
                            <a href="{{ route('password.request') }}" class="text-small">
                              Forgot Password?
                          </a>
                          </div>
                    </div>
                        <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}">
                    {{-- @if($errors->has('password'))
                        <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                    @endif --}}
                        <div class="invalid-feedback">
                            Please fill in your password
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" name="remember" class="custom-control-input" id="remember">
                          <label class="custom-control-label" for="remember">Remember me</label>
                        </div>
                    </div> --}}
                  <div class="form-group mb-2">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                <small class="d-block text-center my-1">Don't have an account?</small>
                <div class="input-group mb-2">
                    <a class="btn btn-outline-primary btn-lg btn-block" href="/register">Register</a>
                </div>
                </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
