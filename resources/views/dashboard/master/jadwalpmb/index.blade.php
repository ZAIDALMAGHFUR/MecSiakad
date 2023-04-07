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
            <h3>Jadwal PMB</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Applications</a></li>
              <li class="breadcrumb-item">Data Master</li>
              <li class="breadcrumb-item active">Jadwal PMB</li>
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
          <div class="card-header">
            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-original-title="test"
              data-bs-target="#addJadwalPmb">Add Jadwal PMB</button>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="display table table-bordered" id="basic-1">
                <thead>
                  <tr style="text-align: center">
                    <th style="width: 55px">No</th>
                    <th>Nama Kegiatan</th>
                    <th>Jenis Kegiatan</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Berakhir</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($jadwal_pmbs as $a)
                  <tr style="text-align: center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $a['nama_kegiatan'] }}</td>
                    <td>{{ $a['jenis_kegiatan'] }}</td>
                    <td>{{ $a['tgl_mulai'] }}</td>
                    <td>{{ $a['tgl_akhir'] }}</td>
                    <td>
                      @if( $a->tgl_mulai <= $datenow && $a->tgl_akhir > $datenow)    
                          <span class="badge light badge-primary">
                              <i class="fa fa-circle text-primary me-1"></i>
                              Berjalan
                          </span>
                      @elseif( $a->tgl_mulai < $datenow )    
                          <span class="badge light badge-danger">
                              <i class="fa fa-circle text-danger me-1"></i>
                              Berakhir
                          </span>
                      @else
                          <span class="badge light badge-info">
                              <i class="fa fa-circle text-info me-1"></i>
                              Akan Berjalan
                          </span>
                      @endif
                  </td>
                    <td>
                      <form method="POST" action="jadwalpmb/delete/{{ $a['id'] }}">
                        @csrf
                        <a type="button" class="btn btn-primary btn-xs edit" data-bs-id="{{ $a->id }}"><i
                            class="fa fa-edit"></i></a>
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
    @include('dashboard.master.jadwalpmb.add')
    @include('dashboard.master.jadwalpmb.edit')
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
            url: "{{ route('jadwalpmb.add') }}",
            type: "GET",
            dataType: "json",
            success: function(data) {
              $('#addJadwalPmb').modal('show');
            }
          });
        });

        $('#save').on("click", function(e) {
          $.ajax({
            type: "POST",
            data: $('#saveJadwalPmb').serialize(),
            url: "{{ route('jadwalpmb.save') }}",
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
        url: "/jadwalpmb/edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            console.log(data);
            $('#id').val(data.id);
            $('#nama_kegiatan').val(data.nama_kegiatan);
            $('#jenis_kegiatan').val(data.jenis_kegiatan);
            $('#tgl_mulai').val(data.tgl_mulai);
            $('#tgl_akhir').val(data.tgl_akhir);
            $('#editjadwalpmb').modal('show');
        }
    });
});

$('#update').on("click", function(e) {
    e.preventDefault();
    var id = $('#id').val();
    $.ajax({
        type: "POST",
        data: $('#datajadwalpmb').serialize(),
        url: '/jadwalpmb/update/' + id,
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
            console.log(data);
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
