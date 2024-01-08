@extends('layouts.master')
@section('body')
    @include('layouts.navbar')
    @include('layouts.sidebar')

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Pegawai</h1>
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
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#add-employee" style="margin-right: 10px;"><i class="fas fa-plus"></i>
                                Tambah Pegawai</button>
                            <a href="/export-employee"><button type="button" class="btn btn-primary"
                                    style="margin-right: 10px;"><i class="fas fa-file-export"></i> Export
                                    Pegawai</button></a>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#import-employee"><i class="fas fa-file-import"></i> Import Pegawai</button>
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
                                            <th>Divisi</th>
                                            <th>NIP</th>
                                            <th>User</th>
                                            <th>Pangkat</th>
                                            <th>Role</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allEmployees as $data)
                                            <tr>
                                                {{-- <input type="hidden" class="delete_id" value="{{ $data->id }}"> --}}
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $data->nama }}</td>
                                                <td>{{ $data->division->name}}</td>
                                                <td>{{ $data->NIP }}</td>
                                                <td>{{ $data->user->username }}</td>
                                                <td>{{ $data->pangkat }}</td>
                                                <td>{{ $data->user->role }}</td>
                                                <td>
                                                    {{-- <form action="{{ route('delete-employee',$data->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete') --}}
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#edit-employee-{{ $data->id }}"><i class="fas fa-edit"></i></a> |
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#delete-employee-{{ $data->id }}"><i class="fas fa-trash-alt" style="color: red"></i></a>
                                                    {{-- </form> --}}
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

    <!-- Modal Add-->
    <div class="modal fade center-modal" id="add-employee" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('save-employee') }}" class="needs-validation" novalidate="" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama" name="nama">
                                    <div class="invalid-feedback">
                                        Tolong isi Nama Pegawai!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Divisi</label>
                                <div class="col-sm-10">
                                    {{-- <input type="text" class="form-control" id="division_name" name="division_name"> --}}
                                    {{-- <select class="form-control" name="division_id" id="division_id">
                                        @foreach ($datapegawai as $data)
                                            <option value="{{ $data }}">{{ $data->division->Name }}</option>
                                        @endforeach
                                    </select> --}}
                                    <select class="form-control" name="division_id" id="division_id">
                                        <option value="" disabled selected>Pilih Divisi</option>
                                        @foreach ($divisions as $division)
                                            <option value="{{ $division->name }}">{{ $division->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Tolong Isi Nama Divisi!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">NIP</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="NIP" name="NIP">
                                    <div class="invalid-feedback">
                                        Tolong Isi NIP!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="email" name="email">
                                    {{-- <input type="hidden" name="user_id" value="{{ $newUserId }}"> --}}
                                    {{-- <select class="form-control" name="user_id" id="user_id">
                                        @foreach ($datapegawai as $data)
                                            <option value="{{ $data }}">{{ $data->user->email }}</option>
                                        @endforeach
                                    </select> --}}
                                    {{-- <select class="form-control" name="user_id" id="user_id">
                                        <option value="" disabled selected>Pilih Email</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->email }}</option>
                                        @endforeach
                                    </select> --}}
                                    <div class="invalid-feedback">
                                        Tolong isi Email dengan Benar (Gunakan domain bps.go.id)!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="username" name="username" readonly>
                                    <div class="invalid-feedback">
                                        Tolong isi Username!
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="username" name="username">
                                    <div class="invalid-feedback">
                                        Tolong Isi Username!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="password" name="password">
                                    <div class="invalid-feedback">
                                        Tolong Isi Password!
                                    </div>
                                </div>
                            </div> --}}
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Pangkat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="pangkat" name="pangkat">
                                    <div class="valid-feedback">
                                        Lengkap!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-10">
                                    <select name="role" id="role" required>
                                        @foreach(\App\Models\User::getPossibleEnumValues('role') as $role)
                                            <option value="{{ $role }}">{{ $role }}</option>
                                        @endforeach
                                    </select>
                                    <div class="valid-feedback">
                                        Lengkap!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- @include('delete.add-employee') --}}

    <!-- Modal Edit-->
    @foreach ($allEmployees as $data)
    <div class="modal fade center-modal" id="edit-employee-{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($allEmployees->isEmpty())
                        <form action="#" class="needs-validation" novalidate="" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            required="" value="">
                                        <div class="invalid-feedback">
                                            Tolong isi Nama Pegawai!
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Divisi</label>
                                    <div class="col-sm-10">
                                        {{-- <input type="text" class="form-control" id="division_name" name="division_name" value=""> --}}
                                        <select class="form-control" name="division_id" id="division_id">
                                            <option value="" disabled selected>Pilih Divisi</option>
                                            @foreach ($divisions as $division)
                                                <option value="{{ $division->id }}">{{ $division->Name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Tolong Isi Nama Divisi!
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">NIP</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="NIP" name="NIP"
                                            value="">
                                        <div class="invalid-feedback">
                                            Tolong Isi NIP!
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">User ID</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="user_id" name="user_id">
                                        {{-- <select class="form-control" name="user_id" id="user_id">
                                            <option value="" disabled selected>Pilih Email</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->email }}</option>
                                            @endforeach
                                        </select> --}}
                                        <div class="invalid-feedback">
                                            Maaf, User ID tidak valid.
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Pangkat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="pangkat" name="pangkat"
                                            value="">
                                        <div class="valid-feedback">
                                            Lengkap!
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-10">
                                    <select name="phase" id="kategori" required>
                                        @foreach(\App\Models\User::getPossibleEnumValues('role') as $role)
                                            <option value="{{ $role }}">{{ $role }}</option>
                                        @endforeach
                                    </select>
                                    <div class="valid-feedback">
                                        Lengkap!
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    @else
                        <form action="{{ route('update-employee', ['id' => $data->id]) }}" class="needs-validation" novalidate=""
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nama </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            required="" value="{{ $data->nama }}">
                                        <div class="invalid-feedback">
                                            Tolong isi Nama Pegawai!
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Divisi</label>
                                    <div class="col-sm-10">
                                        {{-- <select class="form-control" name="division_id" id="division_id">
                                            <option value="{{ $data->division_id }}" selected>{{ $data->division->Name }}</option>
                                            @foreach ($divisions as $division)
                                                <option value="{{ $division->id }}">{{ $division->Name }}</option>
                                            @endforeach
                                        </select> --}}
                                        {{-- <input type="text" class="form-control" id="division_id" name="division_id"
                                            value="{{ $data->division->Name}}"> --}}
                                            <select class="form-control" name="division_id" id="division_id">
                                                <option value="" disabled {{ $data->division_id ? '' : 'selected' }}>Pilih Divisi</option>
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}" {{ $data->division_id == $division->id ? 'selected' : '' }}>
                                                        {{ $division->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        <div class="invalid-feedback">
                                            Tolong Isi Nama Divisi!
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">NIP</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="NIP" name="NIP"
                                            value="{{ $data->NIP }}">
                                        <div class="invalid-feedback">
                                            Tolong Isi NIP!
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">User</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="user_id" name="user_id"
                                            value="{{ $data->user->username}}" readonly>
                                            {{-- <select class="form-control" name="user_id" id="user_id">
                                                <option value="" disabled selected>Pilih Email</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->email }}</option>
                                                @endforeach
                                            </select> --}}
                                        <div class="invalid-feedback">
                                            Maaf, User ID tidak valid.
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Pangkat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="pangkat" name="pangkat"
                                            value="{{ $data->pangkat }}">
                                        <div class="valid-feedback">
                                            Lengkap!
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Role</label>
                                    <div class="col-sm-10">
                                        <select name="role" id="role" required>
                                                @foreach(\App\Models\User::getPossibleEnumValues('role') as $role)
                                                    <option value="{{ $data->role }}">{{ $role }}</option>
                                                @endforeach
                                            </select>
                                        <div class="valid-feedback">
                                            Lengkap!
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="delete-employee-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Konfirmasi Hapus Data Pegawai
                    </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data pegawai {{ $data->nama }}?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="{{ route('delete-employee', ['id' => $data->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    {{-- @include('employee.edit-employee') --}}

    <!-- Modal Import-->
    <div class="modal fade center-modal" id="import-employee" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('import-employee') }}" class="needs-validation" novalidate=""
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <input type="file" class="form-control" id="file" name="file"
                                        required="">
                                    <div class="invalid-feedback">
                                        Tolong upload sebuah file!
                                    </div>
                                    <label class="col-sm-12 col-form-label">- Format file yang di Upload dalam bentuk
                                        (.xlxs) </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('download-custom-employee-template') }}" class="btn btn-info mb-2">Unduh Template</a>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </section>
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
