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
            <h3>Edit Nilai</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Applications</a></li>
              <li class="breadcrumb-item">Data Master</li>
              <li class="breadcrumb-item active">Edit Nilai</li>
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
              <div class="row mb-3">
                <div class="col-md-12 col-12">
                  <div class="card mb-4">
                      <div class="card-body">
                          <div class="row mb-3">
                              <div class="col-12 col-lg-6">
                              <a href="{{ route('change') }}" class="btn btn-danger btn-sm">Kembali</a>
                                  <a href="" onclick="event.preventDefault();document.getElementById('form-nilai').submit();">
                                      <button class="btn btn-sm btn-primary">Simpan</button>
                                  </a>
                              </div>
                          </div>
    
                          <form action="{{ route('change.update', [$nilai]) }}" id="form-nilai" method="POST">
                            <input type="hidden" name="dosen_matkul_id" value="">
                            @csrf
                            @method('POST')
                            <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="20%">Mata Kuliah</th>
                                        <th width="10%" class="text-center">Tugas</th>
                                        <th width="10%" class="text-center">Partisipasi Pembelajaran</th>
                                        <th width="10%" class="text-center">Kuis</th>
                                        <th width="10%" class="text-center">UTS</th>
                                        <th width="10%" class="text-center">UAS</th>
                                        <th width="20%" class="text-center">Nilai Akhir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="rowData">
                                        <input type="hidden"  value="{{ $nilai->tahun_academic_id }}" name="tahun_academic_id">
                                        <input type="hidden" value="{{ $nilai->mahasiswas_id }}" name="mahasiswa_id">
                                        <input type="hidden" value="{{ $nilai->mata_kuliahs_id }}" name="mata_kuliahs_id">
                                        <td>{{ $nilai['mataKuliah']['name_mata_kuliah'] }}</td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm kuis" value="{{ $nilai->kuis }}" name="kuis">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm partisipasi_pembelajaran" value="{{ $nilai->partisipasi_pembelajaran }}" name="partisipasi_pembelajaran">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm tugas" value="{{ $nilai->tugas }}" name="tugas">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm uts" value="{{ $nilai->uts }}" name="uts">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm uas" value="{{ $nilai->uas }}" name="uas">
                                        </td>
                                        <td>
                                            <input readonly type="number" class="form-control form-control-sm nilai_akhir" value="{{ $nilai->nilai_akhir }}" name="nilai_akhir">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
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
    <script>
      const rowData = document.getElementsByClassName('rowData');
    
      // iterasi melalui semua baris data
      Array.from(rowData).forEach(row => {
        row.addEventListener('keyup', function(event) {
          // matikan tab
          if (event.keyCode == 9) {
            event.preventDefault();
          }
    
          // ambil input dengan kelas yang sesuai
          let tugas = this.getElementsByClassName('tugas')[0];
          let partisipasi_pembelajaran = this.getElementsByClassName('partisipasi_pembelajaran')[0];
          let kuis = this.getElementsByClassName('kuis')[0];
          let uts = this.getElementsByClassName('uts')[0];
          let uas = this.getElementsByClassName('uas')[0];
          let nilai_akhir = this.getElementsByClassName('nilai_akhir')[0];
    
          let nilai_tugas = parseInt(tugas.value) || 0;
          let nilai_partisipasi_pembelajaran = parseInt(partisipasi_pembelajaran.value) || 0;
          let nilai_kuis = parseInt(kuis.value) || 0;
          let nilai_uts = parseInt(uts.value) || 0;
          let nilai_uas = parseInt(uas.value) || 0;
    
          function calculateNilaiAkhir() {
            // calculate the final value
            let finalValue = Number(nilai_kuis) + Number(nilai_tugas) + Number(nilai_partisipasi_pembelajaran) + Number(nilai_uts) + Number(nilai_uas);
            // set the value to the input
            nilai_akhir.value = finalValue;
          }
    
          if (nilai_tugas !== 0 && nilai_kuis !== 0 && nilai_uts !== 0 && nilai_uas !== 0) {
            calculateNilaiAkhir();
          }
    
          tugas.addEventListener('keyup', function() {
            if (tugas.value !== "") {
              nilai_tugas = parseInt(this.value);
              calculateNilaiAkhir();
            }
          });
    
          partisipasi_pembelajaran.addEventListener('keyup', function() {
            if (partisipasi_pembelajaran.value !== "") {
              nilai_partisipasi_pembelajaran = parseInt(this.value);
              calculateNilaiAkhir();
            }
          });
    
          kuis.addEventListener('keyup', function() {
            if (kuis.value !== "") {
              nilai_kuis = parseInt(this.value);
              calculateNilaiAkhir();
            }
          });
    
          uts.addEventListener('keyup', function() {
            if (uts.value !== "") {
              nilai_uts = parseInt(this.value);
              calculateNilaiAkhir();
            }
          });
    
          uas.addEventListener('keyup', function() {
            if (uas.value !== "") {
              nilai_uas = parseInt(this.value);
              calculateNilaiAkhir();
            }
          });
        });
      });
    </script>
  @endPushOnce
@endsection
