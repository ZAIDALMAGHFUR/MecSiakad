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
            <h3>Data Pembayaran</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Applications</a></li>
              <li class="breadcrumb-item">Data Master</li>
              <li class="breadcrumb-item active">Data Pembayaran</li>
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
                    <th>ID Pendaftaran</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Status</th>
                    <th class="text-center">Bukti Pembayaran</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($Pembayaran as $a)
                    <tr style="text-align: center">
                      <td>{{ $loop->iteration }}</td>
                      <td><a href="detail-registration/{{ $a->pendaftaran->id_pendaftaran }}">{{ $a->pendaftaran->id_pendaftaran }}</a></td>
                      <td>{{ $a['tgl_pembayaran'] }}</td>
                      <td>
                        <div class="row">
                            <div class="col-md-6">
                                @if ($a->status == 'Dibayar')
                                    <span class="badge badge-success">Dibayar<span
                                            class="ms-1 fa fa-check"></span>
                                    @elseif($a->status =='Belum Bayar')
                                        <span class="badge badge-warning">Belum Dibayar<span
                                                class="ms-1 fas fa-stream"></span>
                                        @elseif($a->status =='Tidak Sah')
                                            <span class="badge badge-danger">Tidak Sah<span
                                                    class="ms-1 fa fa-ban"></span>
                                                    @elseif ($a->status == 'Gratis')
                                                    <span class="badge badge-success">Gratis<span
                                                            class="ms-1 fa fa-check"></span>
                                                            @elseif($a->status == null)
                                                                <span class="badge badge-warning">Belum bayar<span
                                                                        class="ms-1 fas fa-stream"></span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <div class="dropdown text-sans-serif">
                                  <div
                                        class="btn-link" type="button"
                                        id="order-dropdown-7" data-bs-toggle="dropdown"><span><svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="18px"
                                                height="18px" viewbox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none"
                                                    fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                    <circle fill="#000000" cx="5" cy="12" r="2">
                                                    </circle>
                                                    <circle fill="#000000" cx="12" cy="12" r="2">
                                                    </circle>
                                                    <circle fill="#000000" cx="19" cy="12" r="2">
                                                    </circle>
                                                </g>
                                            </svg></span></div>
                                    <div class="dropdown-menu dropdown-menu-end border py-0"
                                        aria-labelledby="order-dropdown-7">
                                        <div class="py-2"><a class="dropdown-item"
                                                href="/paid-payment/{{ $a->id_pembayaran }}">Bayar</a><a
                                                class="dropdown-item"
                                                href="/unpaid-payment/{{ $a->id_pembayaran }}">Belum Bayar</a>
                                            <div class="dropdown-divider"></div><a
                                                class="dropdown-item text-danger"
                                                href="/invalid-payment/{{ $a->id_pembayaran }}">Tidak Sah</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                      @if ($a->bukti_pembayaran != null)
                          <a class="btn btn-light shadow btn-xs sharp me-1" title="Proof of Payment"
                              href="{{ $a->bukti_pembayaran }}" download><i class="icofont icofont-cloud-download"></i></a>
                      @else
                          @if ($a->status == "Gratis")
                          Gratis Biaya Pendaftaran
                          @else
                          Tidak tersedia
                          @endif
                      @endif
                  </td>
                      <td>
                        <form method="POST" action="{{ route('pembayaran/delete', [$a->id]) }}">
                          @csrf
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
    </script>
  @endPushOnce
@endsection
