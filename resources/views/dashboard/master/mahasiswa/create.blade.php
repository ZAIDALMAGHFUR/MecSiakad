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
            <li class="breadcrumb-item">Data Master</li>
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
                <form method="post" class="needs-validation" novalidate="" action="">
                  @csrf 
                  @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
                  @endif
                  <div class="form-group row border-bottom pb-4">
                      <label for="name" class="col-sm-2 col-form-label">Nama</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name" required>
                      </div>
                  </div>
                  <div class="form-group row border-bottom pb-4">
                      <label for="nim" class="col-sm-2 col-form-label">Nim</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" name="nim" value="{{ old('nim') }}" id="nim" required>
                      </div>
                  </div>
                  <div class="form-group row border-bottom pb-4">
                      <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" name="alamat" value="{{ old('alamat') }}" id="alamat" required>
                      </div>
                  </div>
                  <div class="form-group row border-bottom pb-4">
                      <label for="program_studies_id" class="col-sm-2 col-form-label">Program Studi</label>
                      <div class="col-sm-10">
                        <select class="form-control" name="program_studies_id" id="program_studies_id">
                            @foreach($program_studies as $ps)
                                <option {{ old("program_study") == $ps->id ? 'selected' : null }} value="{{ $ps->id }}">{{ $ps->name }}</option>
                            @endforeach
                        </select>
                    </div>
                  </div>
                  <div class="form-group row border-bottom pb-4">
                      <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" name="tempat_lahir" value="{{ old('tempat_lahir') }}" id="tempat_lahir" required>
                      </div>
                  </div>
                  <div class="form-group row border-bottom pb-4">
                      <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                      <div class="col-sm-10">
                          <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" id="tanggal_lahir" required>
                      </div>
                  </div>
                  <div class="form-group row border-bottom pb-4">
                    <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                            <option {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : null }} value="laki-laki">Laki-Laki</option>
                            <option {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : null }} value="perempuan">Perempuan</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group row border-bottom pb-4">
                      <label for="agama" class="col-sm-2 col-form-label">Agama</label>
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
                  <div class="form-group row border-bottom pb-4">
                      <label for="status" class="col-sm-2 col-form-label">Status</label>
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
                  <div class="form-group row border-bottom pb-4">
                      <label for="foto" class="col-sm-2 col-form-label">Photo</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" name="foto" value="{{ old('foto') }}" id="foto" required>
                      </div>
                  </div>

                  
                  <button type="submit" class="btn btn-primary">Save</button>
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