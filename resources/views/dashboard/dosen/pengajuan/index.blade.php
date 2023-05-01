@extends('layouts.dosen')
@section('content')
  @pushOnce('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">
    </head>
  @endPushOnce
  <div class="page-body">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row">
          <div class="col-sm-6">
            <h3>Pengajuan Nilai</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Applications</a></li>
              <li class="breadcrumb-item">Data Master</li>
              <li class="breadcrumb-item active">Pengajuan Nilai</li>
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
          <div class="card-header">

          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="display table table-bordered" id="basic-1">
                <thead>
                  <tr style="text-align: center">
                    <th style="width: 55px">No</th>
                    <th>Nama Mahasiswa</th>
                    <th>Judul</th>
                    <th>Action</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($Pengajuan as $data)
                        <tr>
                        <td style="text-align: center">{{ $loop->iteration }}</td>
                        <td>{{ $data->mahasiswa->name }}</td>
                        <td>{{ $data->judul }}</td>
                        <td style="text-align: center">
                            <a href="" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                        </td>
                        {{-- <td style="text-align: center">
                            @if ($data->status == 'diterima')
                                <span class="badge badge-success">Diterima</span>
                            @elseif($data->status == 'ditolak')
                                <span class="badge badge-danger">Ditolak</span>
                            @endif
                        </td> --}}
                        <td>
                            <div class="row">
                              <div class="col-md-6">
                                  @if ($data->status == 'diterima')
                                      <span class="badge badge-success">Diterima<span
                                              class="ms-1 fa fa-check"></span>
                                      @elseif($data->status == 'ditolak')
                                          <span class="badge badge-warning">Di  <br> Tolak
                                              <br><span class="ms-1 fas fa-stream"></span>
                                              @else
                                                  <span class="badge badge-danger">Not Found<span
                                                          class="ms-1 fa fa-ban"></span>
                                  @endif
                              </div>
                              <div class="col-md-6">
                                  <div class="dropdown text-sans-serif">
                                    <div class="btn-link" type="button" id="order-dropdown-7" data-bs-toggle="dropdown">
                                      <span>
                                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewbox="0 0 24 24" version="1.1">
                                              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                  <rect a="0" y="0" width="24" height="24"></rect>
                                                    <circle fill="#000000" cx="5" cy="12" r="2"> </circle>
                                                    <circle fill="#000000" cx="12" cy="12" r="2"> </circle>
                                                    <circle fill="#000000" cx="19" cy="12" r="2"> </circle>
                                              </g>
                                          </svg>
                                        </span>
                                    </div>
                                      <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="order-dropdown-7">
                                          <div class="py-2">
                                              <a class="dropdown-item" href="">Terima</a>
                                              <a class="dropdown-item" href="">Tolak</a>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
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
  @pushOnce('js')
  <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
  @endPushOnce
@endsection
