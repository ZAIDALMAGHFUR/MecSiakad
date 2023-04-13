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
          <h3>Edit Dosen Jabatan</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Applications</a></li>
            <li class="breadcrumb-item">Data Pengguna</li>
            <li class="breadcrumb-item active">Edit Dosen Jabatan</li>
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
                <form method="post" class="needs-validation" novalidate="" action="{{ route('dsnmatkul.update', [$data]) }}" enctype="multipart/form-data">
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
                  <?php $nama_dosen = \App\Models\Dosen::find($data->dosen_id)->nama_dosen ?>
                  <div class="row g-2 mt-4">
                    <div class="col-md-6">
                        <label for="dosen_id" class="form-label">Nama Dosen</label>
                        <div class="col-sm-10">
                          <select class="form-control" name="dosen_id" id="dosen_id">
                            <option value="{{ $data->dosen_id }}">{{ $nama_dosen }}</option>
                          </select>  
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="mata_kuliah_id" class="form-label">Mata Kuliah Dosen</label>
                        <div class="col-sm-10">
                          <select class="form-control" name="mata_kuliah_id" id="mata_kuliah_id">
                            @foreach ($mata_kuliahs as $item)
                              <option {{ old("mata_kuliah_id", $data->mata_kuliah_id) == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name_mata_kuliah }}</option>
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
                                  <option {{ old("program_studies_id", $data->program_studies_id) == $ps->id ? 'selected' : '' }} value="{{ $ps->id }}">{{ $ps->name }}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="tahun_academics_id" class="form-label">Tahun Academic</label>
                            <div class="col-sm-10">
                              <select class="form-control" name="tahun_academics_id" id="tahun_academics_id">
                                @foreach($tahun_academics as $ta)
                                  <option {{ old("tahun_academics_id", $data->tahun_academics_id) == $ta->id ? 'selected' : '' }} value="{{ $ta->id }}">{{ $ta->tahun_akademik }}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>
                    </div>

                  
                  <button type="submit" class="btn btn-primary mt-3">Ganti</button>
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