  <!-- Modal Edit-->
  <div class="modal fade center-modal" id="edit-employee" tabindex="-1" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Pegawai</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form action="{{ route('update-employee', $data->id) }}" class="needs-validation" novalidate=""
                      method="POST">
                      @csrf
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
                                  <input type="text" class="form-control" id="division_id" name="division_id"
                                      value="{{ $data->division->name }}">
                                  <div class="invalid-feedback">
                                      Tolong Isi Nama Divisi!
                                  </div>
                              </div>
                          </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">NIP </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="NIP" name="NIP"
                                    required="" value="{{ $data->NIP }}">
                                <div class="valid-feedback">
                                    Lengkap!
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="user_id" name="user_id"
                                    value="{{ $data->user->email }}">
                                <div class="invalid-feedback">
                                    Maaf, Email tidak valid.
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Pangkat </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="pangkat" name="pangkat"
                                    required="" value="{{ $data->pangkat }}">
                                <div class="invalid-feedback">
                                    Tolong isi Nama Pegawai!
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
