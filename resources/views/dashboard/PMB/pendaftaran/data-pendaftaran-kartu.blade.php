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
            <h3>Data Pengumuman</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Applications</a></li>
              <li class="breadcrumb-item">Data Master</li>
              <li class="breadcrumb-item active">Data Pengumuman</li>
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
            <div class="row">
                <form action="/update-registration/{{ $viewData->id_pendaftaran }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="col-xl-12">
                        <div class="card card-body" id="cetak" style="margin-bottom: -1rem">
                            <div class="p-4">
                                <div class="d-flex">
                                    <div class="col-lg-3" style="text-align: center; margin-right:25px; margin-left:25px;">
                                        <img width="110px" src="{{ asset('sipenmaru/images/logo.jpg') }}" alt="">
                                    </div>
                                    <div class="col-lg-6">
                                        <center>
                                            <label class="form-label" style="margin-top: -0.5rem"><strong class="d-block">KARTU
                                                    PESERTA</strong></label>
                                            <h5 style="margin-top: -0.5rem"> <strong class="d-block">PENERIMAAN MAHASISWA BARU</strong></h4>
                                                <h4 style="margin-top: -0.5rem"><strong class="d-block">ACTM</strong></h3>
                                                    <p style="margin-top: -0.5rem"><strong class="d-block">Kampus Utama : Jl. Medan - Binjai KM 16,5 Sei Semayang, Sunggal, Deli Serdang.</strong></p>
                                                    <p style="margin-top: -0.5rem"><strong class="d-block">Kampus II : Jl. AH. Nasution No. 18, Pangkalan Masyhur Medan Johor.</strong></p>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" style="margin-bottom: -4rem;">
                                <div class="p-4" style="border-top: 2px solid black!important; margin-top:-2.5rem;">
                                    <div class="d-flex">
                                        <div class="col-lg-4" style="text-align: center; margin-right:25px;">
                                            <img src="{{ Storage::url($viewData->pas_foto) }}" width="250px" height="300"alt="Gamabar" class="rounded">
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3 mb-4">
                                                <h6>DATA PESERTA</h6>
                                                <p>NOMOR PESERTA</p> <h5 style="">{{ $viewData->id_pendaftaran }}</h5>
                                                <p>NAMA PESERTA</p> <h5 style="">{{ $viewData->nama_siswa }}</h5> 
                                                <p>TANGGAL LAHIR</p><h5 style="">{{ $viewData->tanggal_lahir }} </h5>
                                                <p>NISN</p><h5 style="">{{ $viewData->nisn }}</h5> 
                                                <p>ASAL SEKOLAH</p> <h5 style="">{{ $viewData->asal_sekolah }}</h5>
                                            </div>
                                        </div>
        
                                    </div>
                                    <br>
                                    <div class="d-flex">
                                        <div class="col-lg-6" style="width: 50%">
                                            <div class="mb-3 mb-4">
                                                <strong>PILIHAN 1</strong><br>
                                                <h5><strong>{{$viewData->pilihan1->name}}
                                                    </strong></h5>
                                            </div>
                                        </div>
                                        <div class="col-lg-6" style="width: 50%">
                                            <div class="mb-3 mb-4">
                                                <strong>PILIHAN 2</strong><br>
                                                <h5><strong>{{$viewData->pilihan2->name}}
                                                    </strong></h5>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <table class="table ">
                                            <thead>
                                              <tr class="table-danger">
                                                <th scope="col">Jenis tes</th>
                                                <th scope="col">waktu dan tanggal</th>
                                                <th scope="col">penguji</th>
                                                <th scope="col">paraf</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <tr>
                                                <th scope="row">Tes Wawancara</th>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                              </tr>
                                              <tr class="d-flex justify-content-center">
                                                <th scope="col-lg-6">Tes akan di adakan lewat panggilan wa VC Oleh Panitia</th>
                                              </tr>
                                            </tbody>
                                          </table>
                                    </div>
                                    <br>
                                    <div class="mb-4">
                                        <h4><strong>PERNYATAAN</strong></h4>
                                        <p style="text-indent: 0.5in;text-align: justify;">Saya yang menyatakan bahwa data yang
                                            saya isikan dalam formulir pendaftaran penerimaan mahasiswa baru ACTM  tahun {{$viewData->tgl_pendaftaran  }} adalah benar dan saya bersedia menerima ketentuan yang berlaku. Saya
                                            bersedia menerima sanksi pembatalan penerimaan apabila melanggar pernyataan ini.</p>
                                    </div>
                                    <div class="d-flex">
                                        <div class="col-lg-6" style="width:50%; text-align: right; margin:15px;">
                                            <img width="150px" src="{{ asset('sipenmaru/images/qr.png') }}" alt="">
                                        </div>
                                        <div class="col-lg-6" style="width:50%;">
                                            <br>
                                            <center>
                                                <h5><label class="form-label"><strong
                                                            class="d-block">...............................,{{$viewData->tgl_pendaftaran  }}</strong></label>
                                                </h5>
                                                <br>
                                                <p style="color: rgb(156, 156, 156)">ttd</p>
                                                <br>
                                                <h5><strong class="d-block">{{ $viewData->nama_siswa }}</strong></h5>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <div class="row my-4">
                        <div class="col">
                            <div class="text-end mt-2 mt-sm-0">
                                <button class="btn btn-success waves-effect waves-light me-1" onclick="printDiv('cetak')"><i
                                        class="fa fa-print"> </i></button>
                            </div>
                        </div>
                    </div>
                </form>
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
