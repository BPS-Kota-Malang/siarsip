@extends('layouts.master')

<section class="section">
    <div class="container mt-3">
        <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                <div class="login-brand">
                    <img src="{{ asset('assets/img/stisla-fill.svg') }}" width="100"
                        class="shadow-light rounded-circle">
                </div>
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <div class="card card-primary">
                    <div class="card-header" style="display: flex; justify-content: center; align-items: center;">
                        <h3>Register</h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-6 mb-2">
                                    <label for="name">Name</label>
                                    <input id="name" type="text" class="form-control" name="name" autofocus
                                        value="{{ old('name') }}">
                                    <div class="invalid-feedback">
                                        Please fill in your name
                                    </div>
                                </div>

                                <div class="form-group col-6 mb-2">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" class="form-control" name="email"
                                        value="{{ old('email') }}">
                                    <div class="invalid-feedback">
                                        Please fill in your email
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-6 mb-2">
                                    <label for="username">Username</label>
                                    <input id="username" type="text" class="form-control" name="username"
                                        value="{{ old('username') }}">
                                    <div class="invalid-feedback">
                                        Please fill in your username
                                    </div>
                                </div>

                                <div class="form-group col-6 mb-2">
                                    <label for="password" class="d-block">Password</label>
                                    <input id="password" type="password" class="form-control" name="password"
                                        value="{{ old('password') }}">
                                    <div class="invalid-feedback">
                                        Please fill in your password
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    Register
                                </button>
                            </div>
                            <small class="d-block text-center my-1">Already have an account?</small>
                            <div class="input-group mb-2">
                                <a class="btn btn-outline-primary btn-lg btn-block" href="/login">Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const email = document.querySelector('#email');
            const username = document.querySelector('#username');

            email.addEventListener('input', function() {
                // Mengambil bagian sebelum "@" dari alamat email
                const emailParts = email.value.split('@');
                const usernameValue = emailParts.length > 0 ? emailParts[0] : '';

                // Memasukkan nilai ke dalam field username
                username.value = usernameValue;
            });
        });
    </script>


</section>
