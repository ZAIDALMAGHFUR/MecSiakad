@extends('layouts.dosen')
@section('content')
  @pushOnce('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">
    </head>
  @endPushOnce
  <div class="page-body">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row">
          <div class="col-sm-6">
            <h3>Pengajuan Judul</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Applications</a></li>
              <li class="breadcrumb-item">Data Master</li>
              <li class="breadcrumb-item active">Pengajuan Judul</li>
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
          <div class="card-body">
            <div class="table-responsive">
              <table class="display table table-bordered" id="basic-1">
                <thead>
                  <tr style="text-align: center">
                    <th style="width: 55px">No</th>
                    <th>Nama Mahasiswa</th>
                    <th>Judul</th>
                    <th>Lihat Judul</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($pengajuan as $data)
                        <tr>
                        <td style="text-align: center">{{ $loop->iteration }}</td>
                        <td>{{ $data->mahasiswa->name }}</td>
                        <td>{{ $data->judul }}</td>
                        <td style="text-align: center">
                            <a href="{{ route('pengajuan.ambil', [$data->mahasiswa->id, $data->mahasiswa->name]) }}" class="btn btn-primary btn-sm"><i class="fa fa-print"></i></a>
                        </td>
                        <td style="text-align: center">
                            <div class="row">
                                <div class="">
                                    @if ($data->status == 'diterima')
                                        <span class="badge badge-success">Diterima<span class="ms-1 fa fa-check"></span>
                                    @elseif($data->status == 'ditolak')
                                        <span class="badge badge-danger">Di<br>Tolak<br><span class="ms-1 fas fa-stream"></span>
                                    @else
                                        <span class="badge badge-warning">Not Found<span class="ms-1 fa fa-ban"></span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td style="text-align: center">
                            <a class="btn btn-primary btn-sm" title="Edit" data-bs-toggle="modal" data-bs-target=".edit{{ $data->id }}"><i class="fa fa-edit"></i></a>
                        </td>

                        </tr>
                    @endforeach
                </tbody>
              </table>
              <!-- Modal -->
              @foreach ($pengajuan as $data)
              <div class="modal fade edit{{ $data->id }}" id="modal-{{ $data->id }}" tabindex="-1" aria-labelledby="modalLabel-{{ $data->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel-{{ $data->id }}">Pengajuan Judul</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="save-pengajuan/{{ $data->id }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <input type="hidden" name="mahasiswa_id" value="{{ $data->mahasiswa_id }}">
                                <input type="hidden" name="dosen_id" value="{{ $data->dosen_id }}">
                                <div class="mb-3">
                                    <label for="judul_acc" class="form-label">Judul yang di pilih</label>
                                    <select class="form-select" name="judul_acc" id="judul_acc">
                                        <option value="{{ $data->judul_1 }}">{{ $data->judul_1 }}</option>
                                        <option value="{{ $data->judul_2 }}">{{ $data->judul_2 }}</option>
                                        <option value="{{ $data->judul_3 }}">{{ $data->judul_3 }}</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="diterima">Setujui</option>
                                        <option value="ditolak">Tolak</option>
                                    </select>
                                </div>                                                
                                <div class="mb-3">
                                    <label for="pesan" class="form-label">Komentar</label>
                                    <textarea class="form-control" id="pesan" rows="4" cols="50" name="pesan"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @pushOnce('js')
  <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
  @endPushOnce
@endsection
