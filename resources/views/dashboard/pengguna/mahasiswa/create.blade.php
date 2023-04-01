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
          <h3>Tambahkan Mahasiswa</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Applications</a></li>
            <li class="breadcrumb-item">Data Pengguna</li>
            <li class="breadcrumb-item active">Tambahkan Mahasiswa</li>
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
                <form method="post" class="needs-validation" novalidate="" action="{{ route('mahasiswa.admin.store') }}" enctype="multipart/form-data">
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
                        <label for="name" class="form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="nim" class="form-label">Nim</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nim" value="{{ old('nim') }}" id="nim" required>
                        </div>
                    </div>
                  </div>
                    <div class="row g-2 mt-4">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="email" value="{{ old('email') }}" id="email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="no_hp" class="form-label">No Handphone</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="no_hp" value="{{ old('no_hp') }}" id="no_hp" required>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2 mt-4">
                        <div class="col-md-6">
                            <label for="alamat" class="form-label">Alamat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="alamat" value="{{ old('alamat') }}" id="alamat" required>
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
                    <div class="row g-2 mt-4">
                        <div class="col-md-6">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="tempat_lahir" value="{{ old('tempat_lahir') }}" id="tempat_lahir" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                          <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                          <div class="col-sm-10">
                              <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" id="tanggal_lahir" required>
                          </div>
                      </div>
                    </div>
                    <div class="row g-2 mt-4">
                        <div class="col-md-6">
                            <label for="tahun_masuk" class="form-label">Tahun Masuk</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="tahun_masuk" value="{{ old('tahun_masuk') }}" id="tahun_masuk" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="tahun_lulus" value="{{ old('tahun_lulus') }}" id="tahun_lulus" required>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2 mt-4">
                        <div class="col-md-6">
                            <label for="nama_ayah" class="form-label">Nama Ayah</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_ayah" value="{{ old('nama_ayah') }}" id="nama_ayah" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="nama_ibu" class="form-label">Nama Ibu</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_ibu" value="{{ old('nama_ibu') }}" id="nama_ibu" required>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2 mt-4">
                        <div class="col-md-6">
                            <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}" id="pekerjaan_ayah" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') }}" id="pekerjaan_ibu" required>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2 mt-4">
                        <div class="col-md-6">
                            <label for="no_hp_ortu" class="form-label">No Handphone Orang Tua</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="no_hp_ortu" value="{{ old('no_hp_ortu') }}" id="no_hp_ortu" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="alamat_ortu" class="form-label">Alamat Orang Tua</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="alamat_ortu" value="{{ old('alamat_ortu') }}" id="alamat_ortu" required>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2 mt-4">
                        <div class="col-md-6">
                            <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="asal_sekolah" value="{{ old('asal_sekolah') }}" id="asal_sekolah" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                          <label for="tahun_academics_id" class="form-label">Tahun Academic</label>
                          <div class="col-sm-10">
                              <select class="form-control" name="tahun_academics_id" id="tahun_academics_id">
                                  @foreach($tahunakademic as $ta)
                                      @if($ta->status == 'aktif')
                                          <option {{ old("tahun_academics_id") == $ta->id ? 'selected' : null }} value="{{ $ta->id }}">{{ $ta->tahun_akademik }}</option>
                                      @endif
                                  @endforeach
                              </select>
                          </div>
                      </div>
                    </div>
                
                    <div class="row g-2 mt-4">
                        <div class="col-md-6">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                    <option {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : null }} value="laki-laki">Laki-Laki</option>
                                    <option {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : null }} value="perempuan">Perempuan</option>
                                </select>
                            </div>
                          </div>
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
                    </div>  
                    <div class="row g-2 mt-4">
                        <div class="col-md-6">
                            <label for="status" class="form-label">Status</label>
                            <div class="col-sm-10">
                              <select class="form-control" name="status" id="status">
                                  <option {{ old('status') == 'aktif' ? 'selected' : null }} value="aktif">Aktif</option>
                                  <option {{ old('status') == 'tidak aktif' ? 'selected' : null }} value="tidak aktif">Tidak Aktif</option>
                                  <option {{ old('status') == 'lulus' ? 'selected' : null }} value="lulus">Lulus</option>
                                  <option {{ old('status') == 'drop out' ? 'selected' : null }} value="drop out">Drop Out</option>
                                  <option {{ old('status') == 'alumni' ? 'selected' : null }} value="alumni">Alumni</option>
                              </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="foto" class="form-label">Photo</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="foto" value="{{ old('foto') }}" id="foto" required>
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