@extends('layouts.app')
@section('content')

@pushOnce('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">
<!-- Summernote css -->
<link rel="stylesheet" href="{{ asset('/assets/css/summernote.css') }}">
@endPushOnce


<div class="page-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-sm-6">
          <h3>Tambahkan Jurnal</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Applications</a></li>
            <li class="breadcrumb-item">Data Pengguna</li>
            <li class="breadcrumb-item active">Tambahkan Jurnal</li>
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
                <form method="post" class="needs-validation" novalidate="" action="{{ route('jurnal.save') }}"
                  enctype="multipart/form-data">
                  @csrf
                  @method('POST')
                  @if ($errors->any())
                  <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                      <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    <ul>
                      @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                  @endif
                  <div class="row" style="row-gap: 20px;">
                    <div class="col-md-6">
                      <label for="title" class="form-label">Judul Jurnal</label>
                      <input type="text" class="form-control" name="title" value="{{ old('title') }}" id="title"
                        required>
                    </div>
                    <div class="col-md-6">
                      <label for="category" class="form-label">Category Jurnal</label>
                      <input type="text" class="form-control" name="category" value="{{ old('category') }}"
                        id="category" required>
                    </div>
                    <div class="col-md-6">
                      <label for="tags" class="form-label">Tags Jurnal</label>
                      <input type="text" class="form-control" name="tags" value="{{ old('tags') }}" id="tags" required>
                      <small class="text-muted">Pisahkan dengan tanda <div class="fw-bold d-inline-block text-dark">
                          ","
                        </div> jika ingin lebih
                        dari satu
                        tags.</small>
                    </div>
                    <div class="col-md-6">
                      <label for="description" class="form-label">Description Jurnal</label>
                      <textarea class="form-control" name="description" id="description" required
                        rows="4">{{ old('description') }}</textarea>
                    </div>
                    <div class="col-md-6">
                      <label for="thumbnail" class="form-label">Thumbnail</label>
                      <input type="file" class="form-control" name="thumbnail" id="thumbnail" required>
                      <small class="text-muted">Wajib berbentuk file gambar seperti .jpg, .jpeg, .png, .gif atau
                        sejenisnya dan maksimal ukuran file 5MB.</small>
                    </div>

                    <div class="col-md-6">
                      <label for="tanggal_publish" class="form-label">tanggal_publish</label>
                      <input type="date" class="form-control" name="tanggal_publish" id="tanggal_publish" required>
                    </div>
                  </div>
                  <div class="row g-2 mt-3">
                    <div class="col">
                      <label for="body" class="form-label">Konten Jurnal</label>
                      <textarea class="form-control" name="body" id="summernote" required>{{ old('body') }}</textarea>
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

@push('js')
<!--Summer-note js-->
<script src="{{ '/assets/js/editor/summernote/summernote.js' }}"></script>
<script src="{{ '/assets/js/editor/summernote/summernote.custom.js' }}"></script>
<script>
  $(document).ready(function() {
    $('#summernote').summernote();
});
</script>
@endpush