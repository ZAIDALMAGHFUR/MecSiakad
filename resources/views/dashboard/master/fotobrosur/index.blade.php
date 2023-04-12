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
            <h3>Foto PMB</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Applications</a></li>
              <li class="breadcrumb-item">Data Master</li>
              <li class="breadcrumb-item active">Foto PMB</li>
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
            <a href="{{ route('foto.add') }}" class="btn btn-primary">Add Foto PMB</a>
          </div>        
          <div class="card-body">
            <div class="table-responsive">
              <table class="display table table-bordered" id="basic-1">
                <thead>
                  <tr style="text-align: center">
                    <th style="width: 55px">No</th>
                    <th>Foto Brosur 1</th>
                    <th>Foto Brosur 2</th>
                    <th>Foto Brosur 3</th>
                    <th>foto kampus 4</th>
                    <th>foto kampus 5</th>
                    <th>foto kampus 6</th>
                    <th>foto kampus 7</th>
                    <th>foto kampus 8</th>
                    <th>foto kampus 9</th>
                    <th>foto kampus 10</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($fotos as $a)
                    <tr style="text-align: center">
                      <td>{{ $loop->iteration }}</td>
                      <td><img src="{{ Storage::url($a->foto_kampus) }}" width="150" alt="Gamabar Mahasiswa" class="rounded"></td>
                      <td><img src="{{ Storage::url($a->foto_kampus2) }}" width="150" alt="Gamabar Mahasiswa" class="rounded"></td>
                      <td><img src="{{ Storage::url($a->foto_kampus3) }}" width="150" alt="Gamabar Mahasiswa" class="rounded"></td>
                      <td><img src="{{ Storage::url($a->foto_kampus4) }}" width="150" alt="Gamabar Mahasiswa" class="rounded"></td>
                      <td><img src="{{ Storage::url($a->foto_kampus5) }}" width="150" alt="Gamabar Mahasiswa" class="rounded"></td>
                      <td><img src="{{ Storage::url($a->foto_kampus6) }}" width="150" alt="Gamabar Mahasiswa" class="rounded"></td>
                      <td><img src="{{ Storage::url($a->foto_kampus7) }}" width="150" alt="Gamabar Mahasiswa" class="rounded"></td>
                      <td><img src="{{ Storage::url($a->foto_kampus8) }}" width="150" alt="Gamabar Mahasiswa" class="rounded"></td>
                      <td><img src="{{ Storage::url($a->foto_kampus9) }}" width="150" alt="Gamabar Mahasiswa" class="rounded"></td>
                      <td><img src="{{ Storage::url($a->foto_kampus10) }}" width="150" alt="Gamabar Mahasiswa" class="rounded"></td>
                      <td>
                        <form method="POST" action="{{ route('foto.delete', [$a]) }}">
                          @csrf
                          <a href="{{ route('foto.edit', [$a->id]) }}" type="button" class="btn btn-primary btn-xs edit" data-bs-id=""><i
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
