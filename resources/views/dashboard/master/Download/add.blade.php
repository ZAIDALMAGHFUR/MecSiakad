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
          <h3>Tambahkan File Download</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Applications</a></li>
            <li class="breadcrumb-item">Data Master</li>
            <li class="breadcrumb-item active">Tambahkan File Download</li>
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
                <form method="post" class="needs-validation" novalidate="" action="{{ route('save.download') }}" enctype="multipart/form-data">
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
                  <div class="row g-2">
                    <div class="col-md-6">
                      <label for="name" class="form-label">Nama</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name" required>
                      </div>
                  </div>
                  <div class="col-md-6">
                    <label for="file_path" class="form-label">file</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" name="file_path" value="{{ old('file_path') }}" id="file_path" required>
                    </div>
                </div>
                <div class="col-md-6">
                  <label for="to" class="form-label">File to</label>
                  <div class="col-sm-10">
                      <select name="to" class="form-control" id="to" required>
                            <option value="">-- Pilih --</option>
                            <option value="mahasiswa">Mahasiswa</option>
                            <option value="umum">Umum</option>
                        </select>
                  </div>
                </div>
              </div>

                  </div>

                  <button type="submit" class="btn btn-primary mt-3">Save</button>
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
