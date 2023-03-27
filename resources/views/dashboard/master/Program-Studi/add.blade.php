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
          <h3>Tambahkan Program Studi</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Applications</a></li>
            <li class="breadcrumb-item">Data Master</li>
            <li class="breadcrumb-item active">Tambahkan Program Studi</li>
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
                <form method="post" class="needs-validation" novalidate="" action="{{ route('program-studi.store') }}">
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
                      <label for="name" class="col-sm-2 col-form-label">Nama Program Studi</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name" required>
                      </div>
                  </div>
                  <div class="form-group row border-bottom pb-4">
                      <label for="kode_prodi" class="col-sm-2 col-form-label">Kode Program Studi</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" name="kode_prodi" value="{{ old('kode_prodi') }}" id="kode_prodi" required>
                      </div>
                  </div>
                  <div class="form-group row border-bottom pb-4">
                      <label for="jenjang" class="col-sm-2 col-form-label">Jenjang Program Studi</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" name="jenjang" value="{{ old('jenjang') }}" id="jenjang" required>
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