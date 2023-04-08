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
                        <div class="card"  id="cetak">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between flex-wrap">
                                    <div class="mb-3">
                                        <h4 class="fs-24 font-w700">Pengumuman <br>Pendaftaran Mahasiswa Baru</h4>
                                        <span>didaftarkan oleh <strong>{{ auth()->user()->username }}</strong> pada
                                            {{ $dataid->tgl_pendaftaran }}</span>
                                    </div>
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center mb-4 pb-3 justify-content-end flex-wrap">
                                            <div class="me-3">
                                                <h4 class="fs-18 font-w600">PMB</h4>
                                                <span>Zaid Ganteng jago hebat awoakowk  <br>Keren nih bos senggol dong</span>
                                            </div>
                                            <div class="me-3">
                                                <img src="{{ asset('sipenmaru/images/logo.png') }}" alt="" width="50px">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <br>
                                    <div class="p-4 border-top">
                                        <table class="table mb-0">
            
                                            <thead class="table-light col-lg-12">
                                                <tr>
                                                    <td colspan="2">Data Siswa Pendaftar</td>
                                                </tr>
                                            </thead>
                                            <tbody border="5">
                                                
                                                <tr border="5">
                                                    <td scope="row" width="70%">
                                                        <table>
                                                            <tr border="5">
                                                                <th scope="row" width="50%">No Pendafataran</th>
                                                                <td  width="50%">{{ $dataid->id_pendaftaran }}</td>
                                                            <tr>
                                                            <tr border="5">
                                                                <th scope="row"  width="50%">NISN Siswa</th>
                                                                <td width="50%">{{ $dataid->nisn }}</td>
                                                            </tr>
                                                            <tr border="5">
                                                                <th scope="row"  width="50%">Nama Siswa</th>
                                                                <td  width="50%">{{ $dataid->nama_siswa }}</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td colspan="4"><img src="{{ Storage::url($dataid->pas_foto) }}" width="250px" height="300"alt="Gamabar" class="rounded"></td>
                                                <tr>
                                            
                                                
                                                <tr border="5">
                                                    <th colspan="3" scope="row">
                                                        <br>
                                                        @foreach ($data as $x)
                                                                @if($x->hasil_seleksi == 'TIDAK LULUS' && $x->id_pendaftaran== $dataid->id)
                                                                <div class="alert alert-danger solid alert-rounded" style="border-radius: 0%">
                                                                    <strong>Semangat!</strong> Anda TIDAK LULUS seleksi Penerimaan
                                                                    Mahasiswa Baru, Silahkan coba kembali, Jangan Menyerah Ya!
                                                                </div>
                                                                @elseif ($x->hasil_seleksi == 'LULUS' && $x->id_pendaftaran== $dataid->id)
                                                                    <div class="alert alert-success solid" style="border-radius: 0%">
                                                                        <strong>Selamat!</strong> Anda dinyatakan <strong>LULUS</strong>  seleksi
                                                                        Penerimaan Mahasiswa Baru
                                                                    </div>
                                                                    <div class="alert alert-outline-success alert-dismissible fade show" style="border-radius: 0%; margin-top:-1rem">
                                                                        <table>
                                                                            <tr>
                                                                                <th scope="row">Program Studi Penerima <b>{{$x->Program_studies->name}}</b></th>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                    <tr>
                                                                      <td scope="row" style="margin-top:-50px"><small>* Bawa Bukti Penerimaan Saat Melakukan Daftar Ulang</small></td>
                                                                  </tr>
                                                                @endif
                                                    @endforeach
                                                </th>
                                            </tr>
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
