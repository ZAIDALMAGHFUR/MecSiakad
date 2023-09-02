@extends('layouts.landing')

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endpush
@pushOnce('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endPushOnce

@section('content')


<!--home section start-->
<section class="section-py-space mt-0 pt-0" style="min-height: 100vh;">
    <div class="w-100 my-5"
        style="padding-top: 100px !important; background-image: url({{ asset('images/1.jpg') }}); background-position: center; background-size: cover; background-attachment: fixed;">
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <h2 class="fw-bold h1">Berkas Other</h2>
                    <hr style="width: 30px; height: 3px;" class="mx-auto mt-3 mb-5 d-block">
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5 container">
        <h3 class="fw-bold mt-5">DAFTAR BERKAS</h3>
        <div class="mt-5">
            <div class="page-body">
                <div class="container-fluid">
                  <div class="page-header">
                    <div class="row">
                      <div class="col-sm-6">
                        <h3>Berkas</h3>
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="index.html">Applications</a></li>
                          <li class="breadcrumb-item">Data Master</li>
                          <li class="breadcrumb-item active">Berkas</li>
                        </ol>
                      </div>
                      <div class="col-sm-6">
                        <!-- Bookmark Start-->
                        <!-- Bookmark Ends-->
                      </div>
                    </div>
                  </div>
                </div>
                <div class="container-fluid">
                  <div class="col-sm-12">
                    <div class="card">
                      <div class="card-header">

                      </div>
                      <div class="card-body">
                        <div class="table-responsive">
                            <table class="display table table-bordered" id="basic-1">
                                <thead>
                                  <tr style="text-align: center">
                                    <th style="width: 55px">No</th>
                                    <th>Judul</th>
                                    <th>File</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                @foreach ($Downloads as $d)
                                    <tr style="text-align: center">
                                      <td>{{ $loop->iteration }}</td>
                                      <td>{{ $d->name }}</td>
                                      <td>{{ $d->file_name }}</td>
                                      <td style="text-align: center">


                                        <a href="{{ route('landing-pages.download-umum-rill', $d->id) }}">
                                          <button class="btn btn-primary btn-sm edit" type="button"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg></button>
                                        </a>


                                      </td>
                                    </tr>
                                  @endforeach
                                </tbody>
                              </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>


</section>


<!--home section end-->
@endsection

@push('scripts')
<!-- Plugins JS start-->
<script src="{{ asset('vendor/fslightbox/fslightbox.js') }}"></script>
<!-- Plugins JS Ends-->

@endpush

@pushOnce('js')
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
<script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
@endPushOnce
