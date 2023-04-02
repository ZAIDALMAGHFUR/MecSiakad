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
          <h3>Tambahkan Dosen Jabatan</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Applications</a></li>
            <li class="breadcrumb-item">Data Pengguna</li>
            <li class="breadcrumb-item active">Tambahkan Dosen Jabatan</li>
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
                <form method="post" class="needs-validation" novalidate="" action="{{ route('dsnjabatan.save') }}" enctype="multipart/form-data">
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
                        <label for="dosen_id" class="form-label">Nama Dosen</label>
                        <div class="col-sm-10">
                          <select class="form-control" name="dosen_id" id="dosen_id">
                            @foreach ($dosen as $item)
                              <option value="{{ $item->id }}">{{ $item->nama_dosen }}</option>
                            @endforeach
                          </select>  
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="jabatan_id" class="form-label">Jabatan Dosen</label>
                        <div class="col-sm-10">
                          <select class="form-control" name="jabatan_id" id="jabatan_id">
                            @foreach ($jabatan as $item)
                              <option value="{{ $item->id }}">{{ $item->nama_jabatan }}</option>
                            @endforeach
                          </select>
                        </div>
                    </div>
                  </div>
                    <div class="row g-2 mt-4">
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
                        <div class="col-md-6">
                            <label for="tahun_academics_id" class="form-label">Tahun Academic</label>
                            <div class="col-sm-10">
                              <select class="form-control" name="tahun_academics_id" id="tahun_academics_id">
                                @foreach($tahun_academics as $ta)
                                  @if($ta->status == 'aktif')
                                    <option {{ old("tahun_academic") == $ta->id ? 'selected' : null }} value="{{ $ta->id }}">{{ $ta->tahun_akademik }}</option>
                                  @endif
                                @endforeach
                              </select>
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