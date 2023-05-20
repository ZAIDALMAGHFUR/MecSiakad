@extends('layouts.mahasiswa')
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
            <h3>Buat Pengajuan Skripsi</h3>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Applications</a></li>
              <li class="breadcrumb-item">Data Master</li>
              <li class="breadcrumb-item active">Buat Pengajuan Skripsi</li>
            </ul>
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
                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" href="#">Add Surat Pengajuan</a>
              </div>      
              
              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Surat Pengajuan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('mhsjudul.save') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                    <div class="modal-body">
                        <input type="hidden" name="mahasiswa_id" value="{{ $mahasiswa_id }}" >
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul">
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Dengan hormat saya yang mengajukan judul ini guna melengkapi pendidikan saya"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="judul_1" class="form-label">Judul 1</label>
                            <input type="text" class="form-control" id="judul_1" name="judul_1">
                        </div>
                        <div class="mb-3">
                            <label for="judul_2" class="form-label">Judul 2</label>
                            <input type="text" class="form-control" id="judul_2" name="judul_2">
                        </div>
                        <div class="mb-3">
                            <label for="judul_3" class="form-label">Judul 3</label>
                            <input type="text" class="form-control" id="judul_3" name="judul_3">
                        </div>
                        <div class="mb-3">
                            <label for="dosen_id" class="form-label">Kepda dosen</label>
                            <p class="form-control" disabled>{{ $ketua_prodi_id->dosen->nama_dosen }}</p>
                            <input type="hidden" class="form-control" id="dosen_id" name="dosen_id" value="{{ $ketua_prodi_id->dosen->id }}"?>
                        </div>
                    </div>
                    <div class="modal-footer">
                    
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                  </div>
                </div>
                    </form>
                </div>
            </div>


          <div class="card-body">
            <div class="table-responsive">
              <table class="display table table-bordered" id="basic-1">
                <thead>
                  <tr style="text-align: center">
                    <th style="width: 55px">No</th>
                    <th>Judul</th>
                    <th>Descripsi</th>
                    <th>Nama Dosen</th>
                    <th>Judul 1</th>
                    <th>Judul 2</th>
                    <th>Judul 3</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($pengajuan as $item)
                    <tr>
                        <td style="text-align: center">{{ $loop->iteration }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->deskripsi }}</td>
                        <td>{{ $item->dosen->nama_dosen }}</td>
                        <td>{{ $item->judul_1 }}</td>
                        <td>{{ $item->judul_2 }}</td>
                        <td>{{ $item->judul_3 }}</td>
                        <td style="text-align: center">
                            <a href="{{ route('pengajuan-cetak') }}">
                                <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-print"></i></button>
                            </a>
                            <form action="{{ route('mhsjudul.delete', [$item->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm show_confirm"><i class="fa fa-trash"></i></button>
                            </form>
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
