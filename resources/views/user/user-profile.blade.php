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
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <form method="POST" action="{{ route('user-profile') }}" class="needs-validation" novalidate="">
                            <div class="card-header" style="display: flex; justify-content: center; align-items: center;">
                                <h3>User Profile</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                <div class="form-group mb-2">
                                    <label for="name">Name</label>
                                    <input id="name" type="text" class="form-control" name="name" autofocus value="{{ Auth::user()->name }}">
                                    <div class="invalid-feedback">
                                        Please fill in your name
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
                                    <label for="email">Email</label>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}">
                                    <div class="invalid-feedback">
                                        Please fill in your email
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
@endsection
