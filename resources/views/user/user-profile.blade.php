@extends('layouts.master')
@section('body')

@include('layouts.navbar')
@include('layouts.sidebar')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Profile</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">User Profile</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <form method="POST" action="{{ route('user-profile') }}" class="needs-validation" novalidate="">
                            <div class="card-header" style="display: flex; justify-content: center; align-items: center;">
                                <h3>Profile</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                <div class="form-group mb-2">
                                    <label for="name">Name</label>
                                    <input id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                                    <div class="invalid-feedback">
                                        Please fill in your name
                                    </div>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}">
                                    <div class="invalid-feedback">
                                        Please fill in your email
                                    </div>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="username">Username</label>
                                    <input id="username" type="text" class="form-control" name="username" value="{{ Auth::user()->username }}">
                                    <div class="invalid-feedback">
                                        Please fill in your username
                                    </div>
                                </div>

                                <div class="form-group mb-2">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        Save Changes
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <form method="POST" action="{{ route('update-password') }}" class="needs-validation" novalidate="">
                            <div class="card-header" style="display: flex; justify-content: center; align-items: center;">
                                <h3>Password</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                <div class="form-group mb-2">
                                    <label for="current_password">Current Password</label>
                                    <input id="current_password" type="text" class="form-control" name="current_password">
                                    <div class="invalid-feedback">
                                        Please fill in your current password
                                    </div>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="new_password">New Password</label>
                                    <input id="new_password" type="text" class="form-control" name="new_password">
                                    <div class="invalid-feedback">
                                        Please fill in your new password
                                    </div>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="confirm_password">Confirmation Password</label>
                                    <input id="confirm_password" type="text" class="form-control" name="confirm_password">
                                    <div class="invalid-feedback">
                                        Please fill in your confirmation password
                                    </div>
                                </div>

                                <div class="form-group mb-2">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        Save Changes
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
</div>
</footer>
</div>
</div>
<script>
    // Fungsi untuk mengisi otomatis field username
    function fillUsername() {
        var email = document.getElementById('email').value;
        var username = email.split('@')[0];
        document.getElementById('username').value = username;
    }

    // Event listener untuk memanggil fungsi saat nilai email berubah
    document.getElementById('email').addEventListener('change', fillUsername);
</script>
@endsection
