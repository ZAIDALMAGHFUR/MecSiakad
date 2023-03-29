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
            <h3>Tahun Akademik</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Applications</a></li>
              <li class="breadcrumb-item">Data Master</li>
              <li class="breadcrumb-item active">Tahun Akademik</li>
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
              data-bs-target="#addThnAkademik">Add Tahun Akademik</button>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="display table table-bordered" id="basic-1">
                <thead>
                  <tr style="text-align: center">
                    <th style="width: 55px">No</th>
                    <th>Nama Tahun</th>
                    <th>Semester</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $a)
                    <tr style="text-align: center">
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $a['tahun_akademik'] }}</td>
                      <td>{{ $a['semester'] }}</td>
                      @if ($a['status'] == 'aktif')
                        <td>
                          <span class="span badge rounded badge-success">
                            Active
                          </span>
                        </td>
                      @else
                        <td>
                          <span class="span badge rounded badge-danger">
                            Tidak aktif
                          </span>
                        </td>
                      @endif
                      <td>
                        <form method="POST" action="thnakademik/delete/{{ $a['id']}}">
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
    @include('dashboard.master.thnakademik.add')
    @include('dashboard.master.thnakademik.edit')
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
            url: "{{ route('thnakademik/add') }}",
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
            url: "{{ route('thnakademik/save') }}",
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
        url: "/thnakademik/edit/" + id,
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
        url: '/thnakademik/update/' + id,
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
