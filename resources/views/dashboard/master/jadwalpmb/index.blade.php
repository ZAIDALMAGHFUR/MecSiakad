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
                      @elseif( $a->tgl_mulai < $datenow ) <span class="badge light badge-danger">
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
                      <a class="btn btn-primary shadow btn-xs sharp me-1" title="Edit" data-bs-toggle="modal"
                        data-bs-target=".edit{{ $a->id }}"><i class="fa fa-edit"></i></a>
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


<div class="modal fade edit{{ $a->id }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Sunting Pengumuman</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
      </div>
      <div class="modal-body">
        <form action="jadwalpmb/update/{{ $a->id }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('POST')
          <div>
            <input class="form-control" id="id" type="hidden" name="id">
            <div class="row g-2">
              <div class="col-md-6">
                <label class="form-label">Nama Kegiatan</label>
                <input class="form-control" type="text" name="nama_kegiatan" id="nama_kegiatan"
                  value="{{ $a->nama_kegiatan }}" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Jenis Kegiatan</label>
                <input class="form-control" type="text" name="jenis_kegiatan" id="jenis_kegiatan"
                  value="{{ $a->jenis_kegiatan }}" required>
              </div>
            </div>
            <div class="row g-2 mt-3 mb-3">
              <div class="col-md-6">
                <label class="form-label">Tanggal Mulai</label>
                <input class="form-control" type="date" name="tgl_mulai" id="tgl_mulai" value="{{ $a->tgl_mulai }}"
                  required required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Tanggal Selesai</label>
                <input class="form-control" type="date" name="tgl_akhir" id="tgl_akhir" value="{{ $a->tgl_akhir }}"
                  required required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="mb-2">
                <label class="form-label" for="description">Keterangan</label>
                <textarea class="form-control" name="description" id="description"
                  required>{{ $a->description }}</textarea>
              </div>
              <div class="mb-2">
                <label for="brosur" class="form-label">Brosur</label>
                <div class="row">
                  <div class="col-sm-4">
                    <img src="{{ asset('storage/' . $a->brosur) }}" alt="" class="w-100 img-thumbnail">
                  </div>
                  <div class="col-sm-8">
                    <input type="file" class="form-control" name="brosur" id="brosur">
                    <small class="text-muted">Untuk edit, jika tidak di-isi, gambar sebelumnya akan digunakan sebagai
                      default gambar. Wajib berbentuk file gambar seperti .jpg, .jpeg, .png, .gif atau
                      sejenisnya dan maksimal ukuran file 5MB.</small>
                  </div>
                </div>
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

@pushOnce('js')
@include('dashboard.master.jadwalpmb.add')
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
          e.preventDefault();
          $.ajax({
            type: "POST",
            data: new FormData($('#saveJadwalPmb')[0]),
            url: "{{ route('jadwalpmb.save') }}",
            // dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
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
      });
</script>
@endPushOnce
@endsection