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
            <h3>Data Pendaftar</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Applications</a></li>
              <li class="breadcrumb-item">Data Master</li>
              <li class="breadcrumb-item active">Data Pendaftar</li>
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
                    <th>No Peserta</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Daftar</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($Pendaftaran as $a)
                    <tr style="text-align: center">
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $a['id_pendaftaran'] }}</td>
                      <td>{{ $a['nama_siswa'] }}</td>
                      <td>{{ $a['jenis_kelamin'] }}</td>
                      <td>{{ $a['tgl_pendaftaran'] }}</td>
                      <td>
                        <div class="row">
                          <div class="col-md-6">
                              @if ($a->status_pendaftaran == 'Terverifikasi')
                                  <span class="badge badge-success">Terverifikasi<span
                                          class="ms-1 fa fa-check"></span>
                                  @elseif($a->status_pendaftaran == 'Belum Terverifikasi')
                                      <span class="badge badge-warning">Belum <br> Terverifikasi
                                          <br><span class="ms-1 fas fa-stream"></span>
                                      @elseif($a->status_pendaftaran == 'Selesai')
                                          <span class="badge badge-primary">Selesai<span
                                                  class="ms-1 fa fa-check"></span>
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
                                          <a class="dropdown-item" href="/verified-registration/{{ $a->id_pendaftaran }}">Terverifikasi</a>
                                          <a class="dropdown-item" href="/notverified-registration/{{ $a->id_pendaftaran }}">Belum Terverifikasi</a>
                                        <div class="dropdown-divider"></div>
                                          <a class="dropdown-item text-success" href="/finish-registration/{{ $a->id_pendaftaran }}">Selesai </a>
                                        </div>
                                        <div class="dropdown-divider"></div>
                                          <a class="dropdown-item text-danger" href="/invalid-registration/{{ $a->id_pendaftaran }}">Tidak Sah</a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      </td>
                      <td>
                        <form method="POST" action="{{ route('pendaftar/delete', [$a->id]) }}">
                          @csrf
                          <a class="btn btn-secondary shadow btn-xs sharp me-1" title="Detail Registration" href="detail-registration/{{ $a->id_pendaftaran }}"><i class="fa fa-eye"></i></a>
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

      // Function CRUD with Ajax
      $(document).ready(function() {
        $('.add').on("click", function(e) {
          e.preventDefault()
          $.ajax({
            url: "",
            type: "GET",
            dataType: "json",
            success: function(data) {
              $('#addThnAkademik').modal('show');
            }
          });
        });

        $('#save').on("click", function(e) {
          const validation = new JustValidate('#saveThnAkademik', {
            errorFieldCssClass: 'is-invalid',
          });
          validation.addRequiredGroup(
            '#status',
            'Silahkan pilih status terlebih dahulu!',
          );
          $.ajax({
            type: "POST",
            data: $('#saveThnAkademik').serialize(),
            url: "",
            dataType: "json",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
              toastr.success(
                data.success,
                'Wohoooo!', {
                  showDuration: 300,
                  hideDuration: 900,
                  timeOut: 900,
                  closeButton: true,
                  newestOnTop: true,
                  progressBar: true,
                  onHidden: function() {
                    window.location.reload();
                  }
                }
              );
            },
            error: function(data) {
              var errors = data.responseJSON.errors;
              var errorsHtml = '';
              $.each(errors, function(key, value) {
                errorsHtml += '- ' + value[0] + '<br>';
              });
              toastr.error(errorsHtml, 'Whoops gagal men!');
            }
          });
        });

        $('.edit').on("click", function(e) {
    e.preventDefault()
    var id = $(this).attr('data-bs-id');
    // console.log(id);
    $.ajax({
        url: "",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            console.log(data);
            $('#id').val(data.id);
            $('#tahun_akademik').val(data.tahun_akademik);
            $('#semester').val(data.semester);
            $('input[id="status"][value="' + data.status + '"]').prop('checked', true);
            $('#editThnAkademik').modal('show');
        }
    });
});

$('#update').on("click", function(e) {
    e.preventDefault();
    const validation = new JustValidate('#dataThnAkademik', {
        errorFieldCssClass: 'is-invalid',
    });
    validation.addRequiredGroup(
        '#status',
        'Silahkan pilih status terlebih dahulu!',
    );
    var id = $('#id').val();
    // console.log(id);
    // console.log($('#dataThnAkademik').serialize());
    $.ajax({
        type: "PUT",
        data: $('#dataThnAkademik').serialize(),
        url: '',
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            // console.log(data);
            toastr.success(
                data.success,
                'Wohoooo!', {
                    showDuration: 300,
                    hideDuration: 900,
                    timeOut: 900,
                    closeButton: true,
                    newestOnTop: true,
                    progressBar: true,
                    onHidden: function() {
                        window.location.reload();
                    }
                }
            );
        },
        error: function(data) {
            // console.log(data);
            var errors = data.responseJSON.errors;
            var errorsHtml = '';
            $.each(errors, function(key, value) {
                errorsHtml += '- ' + value[0] + '<br>';
            });
            toastr.error(errorsHtml, 'Whoops ga bisa men!');
        }
    });
});

      });
    </script>
  @endPushOnce
@endsection
