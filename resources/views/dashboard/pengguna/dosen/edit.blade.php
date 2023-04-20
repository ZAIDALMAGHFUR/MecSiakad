@extends('layouts.app')
@section('content')

@pushOnce('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">
@endPushOnce


<div class="page-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-6">
          <h3>Edit Dosen</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Applications</a></li>
            <li class="breadcrumb-item">Data Pengguna</li>
            <li class="breadcrumb-item active">Edit Dosen</li>
          </ol>
        </div>
        <div class="col-sm-6">
          <!-- Bookmark Start-->
          <div class="bookmark">
            <ul>
              <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top"
                  title="" data-original-title="Tables"><i data-feather="inbox"></i></a></li>
              <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top"
                  title="" data-original-title="Chat"><i data-feather="message-square"></i></a></li>
              <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top"
                  title="" data-original-title="Icons"><i data-feather="command"></i></a></li>
              <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top"
                  title="" data-original-title="Learning"><i data-feather="layers"></i></a></li>
              <li><a href="javascript:void(0)"><i class="bookmark-search" data-feather="star"></i></a>
                <form class="form-inline search-form">
                  <div class="form-group form-control-search">
                    <input type="text" placeholder="Search..">
                  </div>
                </form>
              </li>
            </ul>
          </div>
          <!-- Bookmark Ends-->
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <div class="col-lg-12">
              <div class="card p-3">
                <form method="post" class="needs-validation" novalidate="" action="{{ route('dosen-admin/update', [$data]) }}" enctype="multipart/form-data">
                  @csrf 
                    @method('POST')
                  @if ($errors->any())
                  <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
                  @endif
                  <div class="row g-2 mt-4">
                    <div class="col-md-6">
                        <label for="nama_dosen" class="form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama_dosen" value="{{ old('nama_dosen', $data->nama_dosen) }}" id="nama_dosen" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                      <label for="kode_dosen" class="form-label">Kode Dosen</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" name="kode_dosen" value="{{ old('kode_dosen', $data->kode_dosen ) }}" id="kode_dosen" required>
                      </div>
                  </div>
                  </div>
                    <div class="row g-2 mt-4">
                      <div class="col-md-6">
                        <label for="nidn" class="form-label">NIDN</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nidn" value="{{ old('nidn', $data->nidn) }}" id="nidn" required>
                        </div>
                    </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="email" value="{{ old('email', $data->email) }}" id="email" required>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2 mt-4">
                      <div class="col-md-6">
                        <label for="no_hp" class="form-label">No Handphone</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="no_hp" value="{{ old('no_hp', $data->no_hp) }}" id="no_hp" required>
                        </div>
                    </div>
                        <div class="col-md-6">
                            <label for="alamat" class="form-label">Alamat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="alamat" value="{{ old('alamat', $data->alamat) }}" id="alamat" required>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2 mt-4">
                      <div class="col-md-6">
                        <label for="status" class="form-label">Status</label>
                        <div class="col-sm-10">
                          <select class="form-control" name="status" id="status">
                              <option {{ old('status') == 'aktif' ? 'selected' : null }} value="aktif">Aktif</option>
                              <option {{ old('status') == 'tidak aktif' ? 'selected' : null }} value="tidak aktif">Tidak Aktif</option>
                              <option {{ old('status') == 'pensiun' ? 'selected' : null }} value="pensiun">Pensiun</option>
                              <option {{ old('status') == 'keluar' ? 'selected' : null }} value="keluar">Keluar</option>
                          </select>
                        </div>
                    </div>
                        <div class="col-md-6">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="tempat_lahir" value="{{ old('tempat_lahir', $data->tempat_lahir) }}" id="tempat_lahir" required>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2 mt-4">
                      <div class="col-md-6">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir', $data->tanggal_lahir) }}" id="tanggal_lahir" required>
                        </div>
                    </div>
                        <div class="col-md-6">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                    <option {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : null }} value="laki-laki">Laki-Laki</option>
                                    <option {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : null }} value="perempuan">Perempuan</option>
                                </select>
                            </div>
                          </div>
                    </div>  
                    <div class="row g-2 mt-4">
                      <div class="col-md-6">
                        <label for="agama" class="form-label">Agama</label>
                        <div class="col-sm-10">
                          <select class="form-control" name="agama" id="agama">
                              <option {{ old('agama') == 'islam' ? 'selected' : null }} value="islam">Islam</option>
                              <option {{ old('agama') == 'kristen' ? 'selected' : null }} value="kristen">Kristen</option>
                              <option {{ old('agama') == 'katolik' ? 'selected' : null }} value="katolik">Katolik</option>
                              <option {{ old('agama') == 'hindu' ? 'selected' : null }} value="hindu">Hindu</option>
                              <option {{ old('agama') == 'budha' ? 'selected' : null }} value="budha">Budha</option>
                              <option {{ old('agama') == 'konghucu' ? 'selected' : null }} value="konghucu">Konghucu</option>
                          </select>
                        </div>
                    </div>
                        <div class="col-md-6">
                            <label for="program_studies_id" class="form-label">Program Studi</label>
                            <div class="col-sm-10">
                              <select class="form-control" name="program_studies_id" id="program_studies_id">
                                  @foreach($program_studies as $ps)
                                      <option {{ old("program_study") == $ps->id ? 'selected' : null }} value="{{ $ps->id }}">{{ $ps->name }}</option>
                                  @endforeach
                              </select>
                          </div>
                        </div>
                    </div>

                    <div class="row g-2 mt-3">
                      <div class="col-md-6">
                        <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="pendidikan_terakhir" value="{{ old('pendidikan_terakhir', $data->pendidikan_terakhir) }}" id="pendidikan_terakhir" required>
                        </div>
                    </div>
                        <div class="col-md-6">
                            <label for="photo" class="form-label">Photo</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="photo" value="{{ old('photo', $data->photo) }}" id="photo" required>
                            </div>
                        </div>
                    </div>

                  
                  <button type="submit" class="btn btn-primary mt-4">Save</button>
              </form>
              </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection