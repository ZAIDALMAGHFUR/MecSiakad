<div class="modal fade" id="addJurusan" aria-labelledby="addJurusanLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addJurusanLabel">Add Jabatan Dosen</h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="needs-validation" id="saveJurusan">
          @csrf
          <div>
            <div class="row g-2">
              <div class="col-md-6">
                <label class="form-label">Nama Jabatan</label>
                <input class="form-control" type="text" name="nama_jabatan" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Kode Jabatan</label>
                <input class="form-control" type="text" name="kode_jabatan" required>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-primary" id="save" type="submit">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
