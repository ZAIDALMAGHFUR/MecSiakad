<div class="modal fade" id="editjadwalpmb" id aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Tahun Akademik</h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="datajadwalpmb" class="needs-validation" novalidate="">
          <div>
            <input class="form-control" id="id" type="hidden" name="id">
            <div class="row g-2">
              <div class="col-md-6">
                <label class="form-label">Nama Kegiatan</label>
                <input class="form-control" type="text" name="nama_kegiatan" id="nama_kegiatan" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Jenis Kegiatan</label>
                <input class="form-control" type="text" name="jenis_kegiatan" id="jenis_kegiatan" required>
              </div>
            </div>
            <div class="row g-2 mt-3 mb-3">
              <div class="col-md-6">
                <label class="form-label">Tanggal Mulai</label>
                <input class="form-control" type="date" name="tgl_mulai" id="tgl_mulai" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Tanggal Selesai</label>
                <input class="form-control" type="date" name="tgl_akhir" id="tgl_akhir" required>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-primary" id="update" type="submit">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
