@extends('layouts.app')
@section('content')
  @pushOnce('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
  @endPushOnce
  <div class="page-body">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row">
          <div class="col-sm-6">
            <h3>KHS</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Applications</a></li>
              <li class="breadcrumb-item">Data Akademik</li>
              <li class="breadcrumb-item active">KHS</li>
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
    <div class="row my-4">
        <div class="col">
            <div class="text-end mt-2 mt-sm-0">
                <button class="btn btn-success waves-effect waves-light me-1" onclick="printDiv('cetak')"><i
                        class="fa fa-print"> </i></button>
            </div>
        </div>
    </div>
    <div class="col-sm-12" id="cetak">
        <div class="card">
            <div class="card-header">
                <div class="row mb-2">
                    <div class="col-sm-12 d-flex justify-content-between">
                        <h3 class="m-0">{{ __('KARTU HASIL STUDI (KHS)') }}</h3>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <center class="mb-5">
                    <table>
                        <tr>
                            <td><strong>NIM</strong></td>
                            <td>&nbsp;: {{ $data_khs['nim'] }} </td>
                        </tr>
                        <tr>
                            <td><strong>Nama Lengkap</strong></td>
                            <td>&nbsp;: {{ $data_khs['name'] }} </td>
                        </tr>
                        <tr>
                            <td><strong>Program Study</strong></td>
                            <td>&nbsp;: {{ $data_khs['prody'] }} </td>
                        </tr>
                        <tr>
                            <td><strong>Tahun Akademik (Semester)</strong></td>
                            <td>&nbsp;: {{ $data_khs['tahun_academic'] }} ({{ $data_khs['semester']}})</td>
                        </tr>
                    </table>
                </center>
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <tr>
                      <th>NO</th>
                      <th>KODE MATA KULIAH</th>
                      <th>NAMA MATA KULIAH</th>
                      <th>SKS</th>
                      <th>NILAI</th>
                      <th>SKOR</th>
                    </tr>
                    @php 
                    $total_sks = 0;
                    $total_nilai = 0;
                    $x = 0;
                    function skorNilai($krs, $skor) {
                      if ($skor == 'A') {
                        $skor = 4 * $krs; 
                      } elseif ($skor == 'B') {
                        $skor = 3 * $krs; 
                      } elseif ($skor == 'C') {
                        $skor = 2 * $krs; 
                      } elseif ($skor == 'D') {
                        $skor = 1 * $krs; 
                      } elseif ($skor == 'E') {
                        $skor = 0 * $krs; 
                      }
                      return $skor;
                    }
                    @endphp
                    
                    @foreach ($data_khs['select_krs'] as $khs)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $khs['kode_mata_kuliah'] }}</td>
                        <td>{{ $khs['name_mata_kuliah'] }}</td>
                        <td>{{ $khs['sks'] }}</td>
                        <td>{{ $data_khs['mhs_data'][$x]['nilai_akhir']}}  </td>
                        <td>{{ $data_khs['mhs_data'][$x]->kriteria}}  </td>
                      </tr>
                    @php
                      $total_sks += $khs->sks;
                      $total_nilai = skorNilai($khs['sks'], $data_khs['mhs_data'][$x]->kriteria) + $total_nilai;
                      $ipk = number_format($total_nilai / $total_sks, 2);
                      $x++;
                    @endphp
                    @endforeach
                    
                    <tr>
                        <td colspan="3" align="right"><strong>Jumlah SKS</strong></td>
                        <td colspan="2"><strong>{{ $total_sks }}</strong></td>
                    </tr>
                </table>
                </div>
                <div class="m-5">
                  <h3>Index Prestasi: {{ $ipk }}</h3>
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
    <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
    <script type="text/javascript">
      $('.show_confirm').click(function(e) {
        var form = $(this).closest("form");
        e.preventDefault();
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              swal("Poof! Your imaginary file has been deleted!", {
                icon: "success",
                // timer: 3000
              });
              form.submit();
            } else {
              swal("Your imaginary file is safe!", {
                icon: "info"
              });
            }
          })
      });
    </script>
    <script>
      @if (session()->has('success'))
        toastr.success(
          '{{ session('success') }}',
          'Wohoooo!', {
            showDuration: 300,
            hideDuration: 900,
            timeOut: 900,
            closeButton: true,
            newestOnTop: true,
            progressBar: true,
          }
        );
      @elseif (session()->has('error'))
        toastr.error(
          '{{ session('error') }}',
          'Whoops!', {
            showDuration: 300,
            hideDuration: 900,
            timeOut: 900,
            closeButton: true,
            newestOnTop: true,
            progressBar: true,
          }
        );
      @endif
    </script>

<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>
  @endPushOnce
@endsection
