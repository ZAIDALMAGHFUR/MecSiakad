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
          <h3>Edit Foto PMB</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Applications</a></li>
            <li class="breadcrumb-item">Data Pengguna</li>
            <li class="breadcrumb-item active">Edit Foto PMB</li>
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
                <form method="post" class="needs-validation" novalidate="" action="{{ route('foto.update', [$fotos]) }}" enctype="multipart/form-data">
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
                      <label for="foto_kampus" class="form-label">Foto Brosur 1</label>
                      <div class="col-sm-10">
                        <input type="file" class="form-control" name="foto_kampus" value="{{ old('foto_kampus') }}" id="foto_kampus" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label for="foto_kampus2" class="form-label">Foto Brosur 2</label>
                      <div class="col-sm-10">
                        <input type="file" class="form-control" name="foto_kampus2" value="{{ old('foto_kampus2') }}" id="foto_kampus2" required>
                      </div>
                    </div>
                  </div>
                  <div class="row g-2">
                    <div class="col-md-6">
                      <label for="foto_kampus3" class="form-label">Foto Brosur 3</label>
                      <div class="col-sm-10">
                        <input type="file" class="form-control" name="foto_kampus3" value="{{ old('foto_kampus3') }}" id="foto_kampus3" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label for="foto_kampus4" class="form-label">Foto Kampus 4</label>
                      <div class="col-sm-10">
                        <input type="file" class="form-control" name="foto_kampus4" value="{{ old('foto_kampus4') }}" id="foto_kampus4" required>
                      </div>
                    </div>
                </div>
                <div class="row g-2">
                  <div class="col-md-6">
                    <label for="foto_kampus5" class="form-label">Foto Kampus 5</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" name="foto_kampus5" value="{{ old('foto_kampus5') }}" id="foto_kampus5" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="foto_kampus6" class="form-label">Foto Kampus 6</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" name="foto_kampus6" value="{{ old('foto_kampus6') }}" id="foto_kampus6" required>
                    </div>
                  </div>
              </div>
              <div class="row g-2">
                <div class="col-md-6">
                  <label for="foto_kampus7" class="form-label">Foto Kampus 7</label>
                  <div class="col-sm-10">
                    <input type="file" class="form-control" name="foto_kampus7" value="{{ old('foto_kampus7') }}" id="foto_kampus7" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="foto_kampus8" class="form-label">Foto Kampus 8</label>
                  <div class="col-sm-10">
                    <input type="file" class="form-control" name="foto_kampus8" value="{{ old('foto_kampus8') }}" id="foto_kampus8" required>
                  </div>
                </div>
            </div>
            <div class="row g-2">
              <div class="col-md-6">
                <label for="foto_kampus9" class="form-label">Foto Kampus 9</label>
                <div class="col-sm-10">
                  <input type="file" class="form-control" name="foto_kampus9" value="{{ old('foto_kampus9') }}" id="foto_kampus9" required>
                </div>
              </div>
              <div class="col-md-6">
                <label for="foto_kampus10" class="form-label">Foto Kampus 10</label>
                <div class="col-sm-10">
                  <input type="file" class="form-control" name="foto_kampus10" value="{{ old('foto_kampus10') }}" id="foto_kampus10" required>
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