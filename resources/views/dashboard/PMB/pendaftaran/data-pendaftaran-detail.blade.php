@extends('layouts.pmb')
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
            <h3>Data Pendaftaran</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Applications</a></li>
              <li class="breadcrumb-item">Data Master</li>
              <li class="breadcrumb-item active">Data Pendaftaran</li>
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
                <div class="row">
                    <div class="tab-pane fade active show" id="AllStatus">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-xl-4  col-lg-6 col-sm-12 align-items-center customers">
                                        <span class="text-primary d-block fs-18 font-w500 mb-1"
                                            style="margin-top: -1.5rem"><strong>{{ $x->id_pendaftaran }}</strong>
                                        </span>
                                        <span class="d-block mb-lg-0 mb-0 fs-16"><i class="fa fa-calendar"></i> Didaftarkan tanggal
                                            {{ $x->tgl_pendaftaran }}</span>
                                    </div>
                                    <div class="col-xl-3  col-lg-3 col-sm-4  col-6">
                                        <div class="d-flex project-image">
                                            <div class="me-3" style="margin-top: -35px">
                                                <img src="{{ Storage::url($x->pas_foto) }}" width="75" alt="Gamabar" class="rounded" style="margin-bottom: -20px">
                                            </div>
                                            <div>
                                                <small class="d-block fs-16 font-w400"
                                                    style="margin-top: -1rem">Pendaftar</small>
                                                <span class="fs-18 font-w500">{{ $x->nama_siswa }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-3  col-lg-6 col-sm-6 mb-sm-4 mb-0">
                                        <div class="d-flex project-image me-3">
                                            <svg class="me-3" width="55" height="55" viewbox="0 0 55 55"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="27.5" cy="27.5" r="27.5" fill="#886CC0"></circle>
                                                <g clip-path="url(#clip0)">
                                                    <path
                                                        d="M37.2961 23.6858C37.1797 23.4406 36.9325 23.2843 36.661 23.2843H29.6088L33.8773 16.0608C34.0057 15.8435 34.0077 15.5738 33.8826 15.3546C33.7574 15.1354 33.5244 14.9999 33.2719 15L27.2468 15.0007C26.9968 15.0008 26.7656 15.1335 26.6396 15.3495L18.7318 28.905C18.6049 29.1224 18.604 29.3911 18.7294 29.6094C18.8548 29.8277 19.0873 29.9624 19.3391 29.9624H26.3464L24.3054 38.1263C24.2255 38.4457 24.3781 38.7779 24.6725 38.9255C24.7729 38.9757 24.8806 39 24.9872 39C25.1933 39 25.3952 38.9094 25.5324 38.7413L37.2058 24.4319C37.3774 24.2215 37.4126 23.931 37.2961 23.6858Z"
                                                        fill="white"></path>
                                                </g>
                                                <defs>
                                                    <clippath>
                                                        <rect width="24" height="24" fill="white"
                                                            transform="translate(16 15)"></rect>
                                                    </clippath>
                                                </defs>
                                            </svg>
                                            <div>
                                                <span
                                                    class="d-block fs-16 font-w400">{{ $x->pilihan1->name }}</span>
                                                <span class="fs-18 font-w500">{{ $x->pilihan2->name }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-2  col-lg-6 col-sm-4 mb-sm-3 mb-3 text-end" >
                                        <div class="d-flex justify-content-end project-btn">
                                            @if ($x->status_pendaftaran == 'Belum Terverifikasi')
                                                <a href="detail-registration-camba/{{ $x->id_pendaftaran }}"
                                                    class=" btn bgl-warning text-warning fs-16 font-w600">Belum <br>
                                                    Terverifikasi</a>
                                            @elseif ($x->status_pendaftaran == 'Terverifikasi')
                                                <a href="detail-registration-camba/{{ $x->id_pendaftaran }}"
                                                    class=" btn bgl-warning text-success fs-16 font-w600">Terverifikasi</a>
                                            @elseif ($x->status_pendaftaran == 'Selesai')
                                                <a href="detail-registration-camba/{{ $x->id_pendaftaran }}"
                                                    class=" btn bgl-warning text-success fs-16 font-w600">Selesai</a>
                                            @else
                                                <a href="detail-registration-camba/{{ $x->id_pendaftaran }}"
                                                    class=" btn bgl-warning text-danger fs-16 font-w600">Tidak
                                                    Sah</a>
                                            @endif
                                            <div class="dropdown ms-4  mt-auto mb-auto">
                                                <div class="btn-link" data-bs-toggle="dropdown">
                                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12Z"
                                                            stroke="#737B8B" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                        <path
                                                            d="M18 12C18 12.5523 18.4477 13 19 13C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11C18.4477 11 18 11.4477 18 12Z"
                                                            stroke="#737B8B" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                        <path
                                                            d="M4 12C4 12.5523 4.44772 13 5 13C5.55228 13 6 12.5523 6 12C6 11.4477 5.55228 11 5 11C4.44772 11 4 11.4477 4 12Z"
                                                            stroke="#737B8B" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                    </svg>
                                                </div>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item"
                                                        href="detail-registration-camba/{{ $x->id_pendaftaran }}">Lihat
                                                        Selengkapnya</a>
                                                    @if ($x->status_pendaftaran == 'Selesai')
                                                        <a class="dropdown-item"
                                                        href="view-graduation/{{ $x->id_pendaftaran }}">Lihat
                                                        Pengumuman</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @pushOnce('js')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
    <script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>
    <script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
  @endPushOnce

  <script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>
@endsection
