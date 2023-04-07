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
          <h3>Update Peryaratan PMB</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Applications</a></li>
            <li class="breadcrumb-item">Data Pengguna</li>
            <li class="breadcrumb-item active">Update Peryaratan PMB</li>
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
                <form method="POST" class="needs-validation" novalidate="" action="{{ route('persyaratan.update',[$persyaratan]) }}" enctype="multipart/form-data">
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
                  <div class="row g-2">
                    <div class="col-md-6">
                      <label for="jalur_prestasi" class="form-label">Jalur Prestasi</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" name="jalur_prestasi" id="jalur_prestasi" required>{{ old('jalur_prestasi', $persyaratan->jalur_prestasi) }}</textarea>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label for="jalur_beasiswa" class="form-label">Jalur Beasiswa</label>
                      <div class="col-sm-10">
                          <textarea type="text" class="form-control" name="jalur_beasiswa" id="jalur_beasiswa" required>{{ old('jalur_beasiswa', $persyaratan->jalur_beasiswa) }}</textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row g-2">
                    <div class="col-md-6">
                      <label for="jalur_pindahan" class="form-label">Jalur Pindahan</label>
                      <div class="col-sm-10">
                          <textarea type="text" class="form-control" name="jalur_pindahan" id="jalur_pindahan" required>{{ old('jalur_pindahan', $persyaratan->jalur_pindahan) }}</textarea>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label for="jalur_reguler" class="form-label">Jalur Reguler</label>
                      <div class="col-sm-10">
                          <textarea type="text" class="form-control" name="jalur_reguler"  id="jalur_reguler" required>{{ old('jalur_reguler', $persyaratan->jalur_reguler) }}</textarea>
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