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
            <h3>Mahasiswa</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="">Applications</a></li>
              <li class="breadcrumb-item">Data Pengguna</li>
              <li class="breadcrumb-item active">Mahasiswa</li>
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
    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Mahasiswa Via Excel</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('import_excel') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-grop">
                                <input type="file" name="file" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if(session('importedRows'))
        <div class="alert alert-success">
            Jumlah Mahasiswa yang berhasil diimpor: {{ session('importedRows') }}
        </div>
    @endif
    <div class="container-fluid">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
              <a href="{{ route('mahasiswa.admin.add') }}" class="btn btn-primary">Add Mahasiswa</a>
              <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Import Mahasiswa
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal" href="#">Import from Excel</a></li>
                <li><a class="dropdown-item" href="{{ route('export_excel') }}">Export to Excel</a></li>
                <li><a class="dropdown-item" href="Template/import siakad.xlsx">Download Template Import</a></li>
              </ul>
          </div>

          @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
          @endif

          <div class="card-body">
            <div class="table-responsive">
              <table class="display table table-bordered" id="basic-1">
                <thead>
                  <tr style="text-align: center">
                    <th style="width: 55px">No</th>
                    <th>Nama Mahasiswa</th>
                    <th>Nim</th>
                    <th>Program Studi</th>
                    <th>Tempat, Tanggal Lahir</th>
                    {{-- <th>Jenis Kelamin</th> --}}
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $d)
                    <tr>
                      <td style="text-align: center">{{ $loop->iteration }}</td>
                      <td>{{ $d->name }}</td>
                      <td>{{ $d->nim }}</td>
                      <td>{{ $d->program_studies->name }}</td>
                      <td>{{ $d->tempat_lahir }}, {{ date('d M Y',strtotime($d->tanggal_lahir)) }}</td>
                      {{-- <td>{{ $d->jenis_kelamin }}</td> --}}
                      <td>
                        @if ($d->status == 'aktif')
                          <span class="badge bg-success">Aktif</span>
                        @else
                          @if ($d->status == 'tidak aktif')
                            <span class="badge bg-danger">Tidak Aktif</span>
                          @endif
                          @if ($d->status == 'lulus')
                            <span class="badge bg-info bg-gradient">Lulus</span>
                          @endif
                          @if ($d->status == 'drop out')
                            <span class="badge bg-info">Drop Out</span>
                            @endif
                          @if ($d->status == 'alumni')
                            <span class="badge bg-warning">Alumni</span>
                          @endif
                        @endif
                      </td>
                      <td style="text-align: center">

                        <a href="{{ route('mahasiswa.admin.show', [$d]) }}">
                            <button class="btn btn-warning  btn-sm edit" type="button"><i class="fa fa-eye"></i></button>
                        </a>

                        <a href="{{ route('mahasiswa.admin.edit', [$d]) }}">
                          <button class="btn btn-primary btn-sm edit" type="button"><i class="fa fa-edit"></i></button>
                        </a>

                        <form action="{{ route('mahasiswa.admin.delete', [$d]) }}" method="POST" class="d-inline">
                          @csrf
                          @method('delete')
                          <button class="btn btn-danger btn-sm show_confirm" type="submit"><i class="fa fa-trash"></i></button>
                        </form>
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
    <script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>
    <script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
    <script type="text/javascript">
      // Sweetalert Delete Confirmation
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

      // Alert Toastr for delete
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
      @endif
    </script>
  @endPushOnce
@endsection
