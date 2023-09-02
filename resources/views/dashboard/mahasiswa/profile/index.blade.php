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
            <h3>Profile</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="">Applications</a></li>
              <li class="breadcrumb-item active">Profile</li>
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
            <div class="edit-profile">
              <div class="row">
                <div class="col-xl-4">
                  <div class="card">
                    <div class="card-header pb-0">
                      <h4 class="card-title mb-0">My Profile</h4>
                      <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                    </div>
                    <div class="card-body">
                      <form>
                        <div class="row mb-2">
                          <div class="profile-title">
                            <div class="media"><img class="img-70 rounded-circle"
            src="{{ Storage::url(Auth::user()->foto) == '/storage/' ? asset('assets/images/dashboard/1.png') : Storage::url(Auth::user()->foto)  }}" alt="">
                              <div class="media-body">
                                <h3 class="mb-1 f-20 txt-primary">{{$profile->name}}</h3>
                                <p class="f-12">{{$profile->program_studies->name}}</p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="mb-3">
                          <h6 class="form-label">Bio</h6>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Email-Address</label>
                          <input class="form-control" placeholder="{{$profile->email}}" disabled>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Nim</label>
                          <input class="form-control" type="text" value="{{$profile->nim}}" disabled>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Status</label>
                          <input class="form-control" placeholder="{{$profile->status}}" disabled>
                        </div>
                        <div class="form-footer">
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col-xl-8">
                  <form class="card">
                    <div class="card-header pb-0">
                      <h4 class="card-title mb-0">Profile</h4>
                      <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-5">
                          <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input class="form-control" type="text" placeholder="{{$profile->name}}" disabled>
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                          <div class="mb-3">
                            <label class="form-label">Nim</label>
                            <input class="form-control" type="text" placeholder="{{$profile->nim}}" disabled>
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                          <div class="mb-3">
                            <label class="form-label">Program Studi</label>
                            <input class="form-control" type="email" placeholder="{{$profile->program_studies->name}}" disabled >
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Tempat Lahir</label>
                            <input class="form-control" type="text" placeholder="{{$profile->tempat_lahir}}" disabled>
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Tanggal Lahir</label>
                            <input class="form-control" type="text" placeholder="{{$profile->tanggal_lahir}}" disabled>
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <input class="form-control" type="text" placeholder="{{$profile->jenis_kelamin}}" disabled>
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Agama</label>
                            <input class="form-control" type="text" placeholder="{{$profile->agama}}" disabled>
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Nama Ayah</label>
                            <input class="form-control" type="text" placeholder="{{$profile->nama_ayah}}" disabled>
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Nama ibu</label>
                            <input class="form-control" type="text" placeholder="{{$profile->nama_ibu}}" disabled>
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Pekerjaan Ayah</label>
                            <input class="form-control" type="text" placeholder="{{$profile->pekerjaan_ayah}}" disabled>
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Pekerjaan ibu ibu</label>
                            <input class="form-control" type="text" placeholder="{{$profile->pekerjaan_ibu}}" disabled>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" type="text" placeholder="{{$profile->alamat}}" disabled></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer text-end">
                    </div>
                  </form>
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
