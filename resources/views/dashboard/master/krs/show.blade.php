@extends('layouts.app')
@section('content')
  @pushOnce('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
  @endPushOnce
  <div class="page-body">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row">
          <div class="col-sm-6">
            <h3>KRS</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Applications</a></li>
              <li class="breadcrumb-item">Data Akademik</li>
              <li class="breadcrumb-item active">KRS</li>
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
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="row mb-2">
                    <div class="col-sm-12 d-flex justify-content-between">
                        <h3 class="m-0">{{ __('KARTU RENCANA STUDI (KRS)') }}</h3>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
        
                <center class="mb-5">
                    <table>
                        <tr>
                            <td><strong>NIM</strong></td>
                            <td>&nbsp;: {{ $data_krs['nim'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>Nama Lengkap</strong></td>
                            <td>&nbsp;: {{ $data_krs['nama_lengkap'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>Program Study</strong></td>
                            <td>&nbsp;: {{ $data_krs['prody'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>Tahun Akademik (Semester)</strong></td>
                            <td>&nbsp;:{{ $data_krs['tahun_academic'] }} ({{ $data_krs['semester']}})</td>
                        </tr>
                    </table>
                </center>
                
                <a href="{{ route('krs.create', [$data_krs['nim'],$data_krs['tahun_academic_id']])  }}" class="btn btn-sm btn-primary mb-4"> <i class="fa fa-plus fa-sm"></i> Tambah Data</a>
        
                <table class="display table table-bordered">
                    <tr>
                        <th>NO</th>
                        <th>KODE MATA KULIAH</th>
                        <th>NAMA MATA KULIAH</th>
                        <th>SKS</th>
                        <th colspan="2">AKSI</th>
                    </tr>
                    @php $total_sks = 0 @endphp
                    @foreach($data_krs['select_krs'] as $krs)
                        <tr>
                            <td width="20px">{{ $loop->iteration }}</td>
                            <td>{{ $krs->kode_mata_kuliah }}</td>
                            <td>{{ $krs->name_mata_kuliah }}</td>
                            <td>{{ $krs->sks }}</td>
                            <td>
                                <form method="POST" action="{{ route('krs.destroy', $krs->id) }}">
                                    @csrf
                                    <a href="" class="btn btn-primary btn-xs edit"> <i class="fa fa-edit"></i> </a>
                                    @method('DELETE')
                                    <input name="_method" type="hidden" class="btn-primary btn-xs" value="DELETE">
                                    <a type="submit" class="btn btn-danger btn-xs show_confirm"><i class="fa fa-trash"></i></a>
                                </form>                          
                            </td>
                        </tr>
                        @php $total_sks += $krs->sks @endphp
                    @endforeach
                    <tr>
                        <td colspan="3" align="right"><strong>Jumlah SKS</strong></td>
                        <td colspan="2"><strong>{{ $total_sks }}</strong></td>
                    </tr>
                </table>
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
  @endPushOnce
@endsection
