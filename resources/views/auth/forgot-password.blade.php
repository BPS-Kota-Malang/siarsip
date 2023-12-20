@extends('layouts.master')
<section class="section">
    <div class="container mt-3">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="login-brand">
                    <img src="{{ asset('assets/img/stisla-fill.svg') }}" width="100"
                        class="shadow-light rounded-circle">
                </div>

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <div class="card card-primary">
                    <div class="card-header" style="display: flex; justify-content: center; align-items: center;">
                        <h3>Forgot Password</h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group mb-2">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" name="email"
                                    value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-2">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    Send Password Reset Link
                                </button>
                            </div>
                            <div class="input-group mb-2">
                                <a class="btn btn-outline-primary btn-lg btn-block" href="/login">Back to Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
