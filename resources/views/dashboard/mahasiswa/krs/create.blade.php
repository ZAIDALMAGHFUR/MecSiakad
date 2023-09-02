@extends('layouts.mahasiswa')
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
    <div class="container-fluid">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card p-3">
                            <form method="POST" action="{{ route('mhskrs.store') }}">
                                    @csrf
                                    @method('POST')
                                    <div class="row g-2 mt-3">
                                      <div class="col-md-6">
                                        <label for="nim" class="form-label">Nim</label>
                                        <div class="col-sm-10">
                                          <input readonly type="text" class="form-control" name="nim" value="{{ $nim }}" id="nim">
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <label for="tahun_academic_id" class="form-label">Tahun Akademik</label>
                                          <div class="col-sm-10">
                                            <select readonly class="form-control" name="tahun_academic_id" id="tahun_academic_id">
                                              <option readonly value="{{ $tahun_akademik->id }}"> {{ $tahun_akademik->tahun_akademik . $tahun_akademik->semester }}</option>
                                          </select>
                                          </div>
                                      </div>
                                    </div>
                                    <div class="row g-2 mt-3">
                                      <div class="col-md-6">
                                        <label for="mata_kuliah_id" class="form-label">Mata Kuliah</label>
                                        <div class="col-sm-10">
                                            <select class="js-example-placeholder-multiple col-sm-12" name="mata_kuliah_id[]" id="mata_kuliah_id" multiple="multiple">
                                                @foreach($data_mata_kuliah as $mata_kuliah)
                                                    <option value="{{ $mata_kuliah->id }}">{{ $mata_kuliah->name_mata_kuliah }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                      </div>
                                    </div>
                                    <button type="submit" class="btn btn-success mt-4">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
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
