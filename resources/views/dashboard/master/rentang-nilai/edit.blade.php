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
          <h3>Edit Bobot Nilai</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Applications</a></li>
            <li class="breadcrumb-item">Data Akademik</li>
            <li class="breadcrumb-item active">Edit Bobot Nilai</li>
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
                <form method="post" class="needs-validation" novalidate="" action="{{ route('rentang.update', [$data]) }}" enctype="multipart/form-data">
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
                      <label for="nama_rentang_nilai" class="form-label">Nilai Min</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" name="nama_rentang_nilai" value="{{ old('nama_rentang_nilai', $data->nama_rentang_nilai) }}" id="nama_rentang_nilai" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label for="rentang_nilai" class="form-label">Nilai Max</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="rentang_nilai" value="{{ old('rentang_nilai', $data->rentang_nilai) }}" id="rentang_nilai" required>
                      </div>
                    </div>
                  </div>
                  <div class="row g-2 mt-3">
                    <div class="col-md-6">
                      <label for="huruf_nilai" class="form-label">Nilai Huruf</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="huruf_nilai" value="{{ old('huruf_nilai', $data->huruf_nilai) }}" id="huruf_nilai" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                        <label for="bobot_nilai" class="form-label">Bobot Nilai</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="bobot_nilai" value="{{ old('bobot_nilai', $data->bobot_nilai) }}" id="bobot_nilai" required>
                      </div>
                    </div>
                  </div>
                  <div class="row g-2 mt-3">
                    
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