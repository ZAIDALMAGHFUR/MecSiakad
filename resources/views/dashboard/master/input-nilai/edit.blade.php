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
          <h3>Edit Nilai</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Applications</a></li>
            <li class="breadcrumb-item">Data Akademik</li>
            <li class="breadcrumb-item active">Edit Nilai</li>
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
                <div class="form-group">
                  <label for="mata_kuliah_id">Mata Kuliah</label>
                  <select name="mata_kuliah_id" id="mata_kuliah_id" class="form-control">
                      <option value="">- Pilih Mata Kuliah -</option>
                      @foreach ($mataKuliah as $mk)
                          <option value="{{ $mk->id }}" {{ $selectedMataKuliah == $mk->id ? 'selected' : '' }}>{{ $mk->name_mata_kuliah }}</option>
                      @endforeach
                  </select>
              </div>
              
              <div class="form-group">
                  <label for="tahun_akademik_id">Tahun Akademik</label>
                  <select name="tahun_akademik_id" id="tahun_akademik_id" class="form-control">
                      <option value="">- Pilih Tahun Akademik -</option>
                      @foreach ($tahunAcademik as $ta)
                          <option value="{{ $ta->id }}" {{ $selectedTahunAcademik == $ta->id ? 'selected' : '' }}>{{ $ta->tahun_akademik }}</option>
                      @endforeach
                  </select>
              </div>
              
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection