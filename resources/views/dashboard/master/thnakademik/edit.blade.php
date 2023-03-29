<div class="modal fade" id="editThnAkademik" id aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Tahun Akademik</h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="dataThnAkademik" class="needs-validation" novalidate="">
          <div>
            <input class="form-control" id="id" type="hidden" name="id">
            <div class="col-md-12">
              <label class="form-label">Nama Tahun</label>
              <input class="form-control" type="text" placeholder="Cth: 2016/2017" name="tahun_akademik" id="tahun_akademik" required>
            </div>
            <div class="col-md-12">
              <label class="form-label">Semester</label>
              <input class="form-control" type="text" placeholder="Cth: Ganjil"  name="semester" id="semester" required>
            </div>
            <div class="col-md-6">
              <div class="form-group m-t-15 m-checkbox-inline mb-0" id="status">
                <label class="form-label">Status</label>
                <label class="d-block">
                  <input class="form-check-input" id="status" type="radio" value="aktif" name="status">
                  Active
                </label>
                <label class="d-block">
                  <input class="form-check-input" id="status" type="radio" value="tidak aktif" name="status">
                  Non
                  Active
                </label>
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
