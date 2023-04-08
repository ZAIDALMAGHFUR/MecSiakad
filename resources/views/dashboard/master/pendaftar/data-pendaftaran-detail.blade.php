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
            <div class="table-responsive">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="text-end mt-2 mt-sm-0">
                            <button class="btn btn-info waves-effect waves-light mb-4" onclick="printDiv('cetak')"><i
                                class="fa fa-print"> </i></button>
                        </div>
                        <div class="card card-body" id="cetak">
                            <div class="card-header">
                                <h4 class="card-title">Data Pendaftaran</h4>
                                <!-- center modal -->
                                <div>
                                    @if ($viewData->status_pendaftaran == "Belum Terverifikasi")
                                    <button class="btn btn-warning mb-4" style="margin-bottom: 1rem;" disabled>Belum Terverifikasi</button>
                                    @elseif ($viewData->status_pendaftaran == "Terverifikasi")
                                        @if ($viewDataPembayaran->status !="Gratis" && $viewDataPembayaran->status !="Dibayar")
                                        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target=".upload"
                                        style="margin-bottom: 1rem;"><i class="mdi mdi-plus me-1"></i>Upload Pembayaran  </button>    
                                        @endif
                                    
                                    <button class="btn btn-success mb-4" style="margin-bottom: 1rem;" disabled>Terverifikasi</button>
                                    @elseif ($viewData->status_pendaftaran == "Selesai")
                                    <button class="btn btn-primary mb-4" style="margin-bottom: 1rem;" disabled>Selesai</button>
                                    @else
                                    <span class="badge badge-danger">Data Tidak Sah</span>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row mb-2">
                                            <div class="pt-4 border-bottom-1 pb-3">
                                                <h4 class="text-primary"><b>PROFIL SISWA</b></h4>
                                            </div>
                                            <div class="col-sm-4 col-5">
                                                <p class="f-w-400">ID Pendaftaran</p>
                                            </div>
                                            <div class="col-sm-8 col-7">
                                                <p class="f-w-500">: {{ $viewData->id_pendaftaran }}</p>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-4 col-6">
                                                <p class="f-w-400">Nama</p>
                                            </div>
                                            <div class="col-sm-8 col-6">
                                                <p class="f-w-500">: {{ $viewData->nama_siswa }}</p>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-4 col-6">
                                                <p class="f-w-400">Jenis Kelamin</p>
                                            </div>
                                            <div class="col-sm-8 col-6">
                                                <p class="f-w-500">: {{ $viewData->jenis_kelamin }}</p>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-4 col-6">
                                                <p class="f-w-400">TTL</p>
                                            </div>
                                            <div class="col-sm-8 col-6">
                                                <p class="f-w-500">: {{ $viewData->tempat_lahir }},{{ $viewData->tanggal_lahir }}</p>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-4 col-6">
                                                <p class="f-w-400">Agama</p>
                                            </div>
                                            <div class="col-sm-8 col-6">
                                                <p class="f-w-500">: {{ $viewData->agama }}</p>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-4 col-6">
                                                <p class="f-w-400">NISN</p>
                                            </div>
                                            <div class="col-sm-8 col-6">
                                                <p class="f-w-500">: {{ $viewData->nisn }}</p>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-4 col-6">
                                                <p class="f-w-400">NIK</p>
                                            </div>
                                            <div class="col-sm-8 col-6">
                                                <p class="f-w-500">: {{ $viewData->nik }}</p>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-4 col-6">
                                                <p class="f-w-400">Alamat</p>
                                            </div>
                                            <div class="col-sm-8 col-6">
                                                <p class="f-w-500">: {{ $viewData->alamat }}</p>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-4 col-6">
                                                <p class="f-w-400">Email</p>
                                            </div>
                                            <div class="col-sm-8 col-6">
                                                <p class="f-w-500">: {{ $viewData->email }}</p>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-4 col-6">
                                                <p class="f-w-400">Telepon/What'sApp</p>
                                            </div>
                                            <div class="col-sm-8 col-6">
                                                <p class="f-w-500">: {{ $viewData->nik }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="pt-4 border-bottom-1 pb-3">
                                            <img src="{{ Storage::url($viewData->pas_foto) }}" width="250px" height="300"alt="Gamabar" class="rounded">
                                        </div>
                                    </div>
                                </div>
        
        
                                    
                                    <div class="pt-4 border-bottom-1 pb-3">
                                        <h4 class="text-primary"><b>DATA ORANG TUA</b></h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="row mb-2">
                                                <div class="col-sm-3 col-6">
                                                    <p class="f-w-400">Nama Ayah</p>
                                                </div>
                                                <div class="col-sm-9 col-6">
                                                    <p class="f-w-500">: {{ $viewData->nama_ayah }}</p>
                                                </div>
                                                <div class="col-sm-3 col-6">
                                                    <p class="f-w-400">Pekerjaan Ayah</p>
                                                </div>
                                                <div class="col-sm-9 col-6">
                                                    <p class="f-w-500">: {{ $viewData->pekerjaan_ayah }}</p>
                                                </div>
                                                <div class="col-sm-3 col-6">
                                                    <p class="f-w-400">No Handphone</p>
                                                </div>
                                                <div class="col-sm-9 col-6">
                                                    <p class="f-w-500">: {{ $viewData->nohp_ayah }}</p>
                                                </div>
                                                <div class="col-sm-3 col-6">
                                                    <p class="f-w-400">Penghasilan Ayah</p>
                                                </div>
                                                <div class="col-sm-9 col-6">
                                                    <p class="f-w-500">: {{ $viewData->penghasilan_ayah }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--kiri-->
                                        <div class="col-lg-6">
                                            <div class="row mb-2">
                                                <div class="col-sm-3 col-6">
                                                    <p class="f-w-400">Nama Ibu</p>
                                                </div>
                                                <div class="col-sm-9 col-6">
                                                    <p class="f-w-500">: {{ $viewData->nama_ibu }}</p>
                                                </div>
                                                <div class="col-sm-3 col-6">
                                                    <p class="f-w-400">Pekerjaan Ibu</p>
                                                </div>
                                                <div class="col-sm-9 col-6">
                                                    <p class="f-w-500">: {{ $viewData->pekerjaan_ibu }}</p>
                                                </div>
                                                <div class="col-sm-3 col-6">
                                                    <p class="f-w-400">No Handphone</p>
                                                </div>
                                                <div class="col-sm-9 col-6">
                                                    <p class="f-w-500">: {{ $viewData->nohp_ibu }}</p>
                                                </div>
                                                <div class="col-sm-3 col-6">
                                                    <p class="f-w-400">Penghasilan Ibu</p>
                                                </div>
                                                <div class="col-sm-9 col-6">
                                                    <p class="f-w-500">: {{ $viewData->penghasilan_ibu }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-12 col-12">
                                                <p class="f-w-400">Berkas Orang Tua <small>kk,slip gaji</small></p>
                                                <div class="col-sm-9 col-7">
                                                    <a href="{{ Storage::url($viewData->berkas_ortu) }}"><i class="fa fa-file-pdf-o" style="font-size:48px;color:red"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pt-4 border-bottom-1 pb-3">
                                        <h4 class="text-primary"><b>DATA REGISTRASI</b></h4>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-4 col-4">
                                            <p class="f-w-400">Periode Pendaftaran</p>
                                            <div class="col-sm-9 col-7">
                                                <p class="f-w-500">: {{ $viewData->jadwal_pmbs_id }} / {{ $viewData->tahun_masuk }}</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-4">
                                            <p class="f-w-400">Pilihan 1</p>
                                            <div class="col-sm-9 col-7">
                                                <p class="f-w-500">: {{ $viewData->pilihan1->name }}</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-4">
                                            <p class="f-w-400">Pilihan 2</p>
                                            <div class="col-sm-9 col-7">
                                                <p class="f-w-500">: {{ $viewData->pilihan2->name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pt-4 border-bottom-1 pb-3">
                                        <h4 class="text-primary"><b>DATA SEKOLAH DAN PENDIDIKAN SEBELUMNYA</b></h4>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3 col-3">
                                            <p class="f-w-400">Asal Sekolah</p>
                                            <div class="col-sm-9 col-7">
                                                {{ $viewData->asal_sekolah }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-2 col-2">
                                            <p class="f-w-400">Semester 1</p>
                                            <div class="col-sm-9 col-7">
                                                <p class="f-w-500">: {{ $viewData->smt1 }}</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-2">
                                            <p class="f-w-400">Semester 2</p>
                                            <div class="col-sm-9 col-7">
                                                <p class="f-w-500">: {{ $viewData->smt2 }}</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-2">
                                            <p class="f-w-400">Semester 3</p>
                                            <div class="col-sm-9 col-7">
                                                <p class="f-w-500">: {{ $viewData->smt3 }}</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-2">
                                            <p class="f-w-400">Semester 4</p>
                                            <div class="col-sm-9 col-7">
                                                <p class="f-w-500">: {{ $viewData->smt4 }}</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-2">
                                            <p class="f-w-400">Semester 5</p>
                                            <div class="col-sm-9 col-7">
                                                <p class="f-w-500">: {{ $viewData->smt5 }}</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-2">
                                            <p class="f-w-400">Semester 6</p>
                                            <div class="col-sm-9 col-7">
                                                <p class="f-w-500">: {{ $viewData->smt5 }}</p>
                                                <small><i>*jika ada</i></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-6 col-6">
                                            <p class="f-w-400">Berkas Calon Pendaftar <small>raport,ijazah</small></p>
                                            <div class="col-sm-9 col-7">
                                                <a href="{{ Storage::url($viewData->berkas_siswa) }}"><i class="fa fa-file-pdf-o" style="font-size:48px;color:red"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-6">
                                            @if ($viewData->prestasi != null)
                                                <p class="f-w-400">Prestasi <small><i>*jika ada</i></small></p>
                                                <div class="col-sm-9 col-7">
                                                    <a href="{{ Storage::url($viewData->prestasi) }}"><i class="fa fa-file-pdf-o" style="font-size:48px;color:red"></i></a>
                                                </div>
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
