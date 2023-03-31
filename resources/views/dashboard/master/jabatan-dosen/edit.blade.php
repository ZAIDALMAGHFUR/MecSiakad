<div class="modal fade" id="editJurusan" aria-labelledby="editJurusanLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editJurusanLabel">Edit Jurusan</h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="dataJurusan" class="needs-validation" novalidate="" method="POST">
          @csrf
          <div>
            <input class="form-control" id="id" type="hidden" name="id">
            <div class="row g-2">
              <div class="col-md-6">
                <label class="form-label">Nama Jabatan</label>
                <input class="form-control" id="nama_jabatan" type="text" name="nama_jabatan" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Kode Jabatan</label>
                <input class="form-control" id="kode_jabatan" type="text" name="kode_jabatan" required>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-primary" id="update" type="submit">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
