   <!-- Modal Add-->
   <div class="modal fade center-modal" id="add-activity" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kegiatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('save-activity') }}" class="needs-validation" novalidate="" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" required="">
                                <div class="invalid-feedback">
                                    Tolong isi Nama Kegiatan!
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Finance Code</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="finance_code" name="finance_code" required="">
                                <div class="invalid-feedback">
                                    Maaf, kode tidak valid.
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Divisi</label>
                            <div class="col-sm-10">
                                {{-- <input type="text" class="form-control" id="division" name="division"> --}}
                                <select class="form-control" name="division" id="division">
                                    @foreach ($datakegiatan as $data)
                                        <option value="{{ $data }}">{{ $data->division }}</option>
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
