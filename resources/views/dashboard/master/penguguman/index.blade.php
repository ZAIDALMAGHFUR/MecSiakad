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
              <table class="display table table-bordered" id="basic-1">
                <thead>
                  <tr style="text-align: center">
                    <th style="width: 55px">No</th>
                    <th>Id Pendaftaran</th>
                    <th>Hasil</th>
                    <th>Program Studi Penerima</th>
                    <th>Nilai Interview</th>
                    <th>Nilai Tes</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($Pengumuman as $a)
                    <tr style="text-align: center">
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $a->Pendaftaran->id_pendaftaran }}</td>
                      <td>
                        @if ($a->hasil_seleksi == "LULUS" || $a->hasil_seleksi == "Lulus" || $a->hasil_seleksi == "lulus")
                            <span class="badge light badge-success">
                                <i class="fa fa-circle text-success me-1"></i>
                                LULUS
                            </span>
                        @else
                            <span class="badge light badge-danger">
                                <i class="fa fa-circle text-danger me-1"></i>
                                TIDAK LULUS
                            </span>
                        @endif
                    <td>@if ($a->hasil_seleksi == "LULUS" || $a->hasil_seleksi == "Lulus" || $a->hasil_seleksi == "lulus") 
                        {{ $a->Program_studies->name }}
                        @elseif ($a->hasil_seleksi == "TIDAK LULUS" || $a->hasil_seleksi == "Tidak Lulus" || $a->hasil_seleksi == "tidak lulus")
                        -
                        @endif
                    </td>
                    <td><strong>{{ $a->nilai_interview }}</strong></a></td>
                    <td><strong>{{ $a->nilai_test }}</strong></a></td>

                      <td>
                        <form method="POST" action="{{ route('pembayaran/delete', [$a->id]) }}">
                          @csrf
                          <a class="btn btn-secondary shadow btn-xs sharp me-1" title="Detail Registration"
                                href="view-announcement/{{ $a->pendaftaran->id_pendaftaran }}"><i class="fa fa-eye"></i></a>
                          <a class="btn btn-primary shadow btn-xs sharp me-1" title="Edit" data-bs-toggle="modal" data-bs-target=".edit{{ $a->id_pengumuman }}"><i class="fa fa-edit"></i></a>
                          <input name="_method" type="hidden" class="btn-primary btn-xs" value="DELETE">
                          <a type="submit" class="btn btn-danger btn-xs show_confirm"><i class="fa fa-trash"></i></a>
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

 @if (isset($a)){
  <div class="modal fade edit{{ $a->id_pengumuman  }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sunting Pengumuman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
              <form action="update-announcement/{{ $a->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="col-xl-6">
                                <label for="users_id">Hidden</label>
                                <input type="text" class="form-control" id="users_id"
                                    value="{{ $a }}" name="users_id"
                                  hidden >
                            </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xl-6">
                                <label for="id_pendaftaran">ID Pendaftaran</label>
                                <select class="default-select form-control wide" title="id_pendaftaran" name="id_pendaftaran" required>
                                    <option value="{{ $a->id_pendaftaran }}">
                                      {{ $a->pendaftaran->id_pendaftaran }}</option>
                                </select> 
                            </div>
                            <div class="col-xl-6">
                                <label for="hasil_seleksi">Hasil</label>
                                <select class="default-select form-control wide" title="Result" name="hasil_seleksi" required>
                                    <option value="LULUS">LULUS</option>
                                    <option value="TIDAK LULUS">TIDAK LULUS</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="prodi_penerima">Program Studi Penerima </label>
                        <select class="default-select form-control wide" title="Recipient" name="prodi_penerima" required>
                            @if ($a->hasil_seleksi == "LULUS" || $a->hasil_seleksi == "Lulus" || $a->hasil_seleksi == "lulus") 
                            <option value="{{ $a->prodi_penerima }}" selected>{{ $a->Program_studies->name }}</option>
                            @endif
                            <option value="{{ $a->pendaftaran->pil1 }}">Pilihan 1 : {{ $a->pendaftaran->pilihan1->name }}</option>
                            <option value="{{ $a->pendaftaran->pil2 }}">Pilihan 2 : {{ $a->pendaftaran->pilihan2->name }}</option>
                            <option value="">Tidak DiTerima</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xl-6">
                                <label for="nilai_interview">Nilai Interview</label>
                                <input type="number" class="form-control" id="nilai_interview"
                                    value="{{ $a->nilai_interview }}"
                                    name="nilai_interview" required>
                            </div>
                            <div class="col-xl-6">
                                <label for="nilai_test">Nilai Tes</label>
                                <input type="number" class="form-control" id="nilai_test"
                                    value="{{ $a->nilai_test }}" name="nilai_test"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 d-flex">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
 } 
 @endif

  @pushOnce('js')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
    <script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>
    <script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
    <script>
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
