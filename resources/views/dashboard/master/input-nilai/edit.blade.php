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
          <h3>Isi Nilai</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Applications</a></li>
            <li class="breadcrumb-item">Data Akademik</li>
            <li class="breadcrumb-item active">Isi Nilai</li>
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
            <div class="row mb-3">
              <div class="col-md-12 col-12">
                <div class="card">
                  <a href="#parental-data" class="collapsed text-dark" data-bs-toggle="collapse">
                      <div class="p-4">
                          <div class="d-flex align-items-center">
                              <div class="flex-shrink-0 me-3"> <i class="uil uil-bill text-primary h2"></i>
                              </div>
                              <div class="flex-grow-1 overflow-hidden">
                                  <h5 class="font-size-16 mb-1">Kriteria Pengisian Nilai</h5>
                                  <p class="text-muted text-truncate mb-0">Rentang Nilai, Bobot Nilai, Nilai Huruf.
                                  </p>
                              </div>
                              <div class="flex-shrink-0"> <i
                                      class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> </div>
                          </div>
                      </div>
                  </a>
                  <div id="parental-data" class="collapse">
                      <div class="p-4 border-top">
                          <div class="row">
                              <div class="col-lg-4">
                                  <div class="mb-3 mb-4">
                                      @foreach ($bobot as $item)
                                        <p class="form-label" for="nama_ayah">Nama Nilai = {{ $item->nama_rentang_nilai }}</p>
                                      @endforeach
                                  </div>
                              </div>
                              <div class="col-lg-4">
                                  <div class="mb-3 mb-4">
                                    @foreach ($bobot as $it)
                                      <p class="form-label" for="nama_ayah">Nilai Max = {{ $it->rentang_nilai }}</p>
                                    @endforeach
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="p-4">
                          <div class="row">
                              <div class="col-lg-4">
                                  <div class="mb-3 mb-4">
                                      @foreach ($bobot as $p)
                                        <p class="form-label" for="nama_ayah">Nilai Hufur = {{ $p->huruf_nilai }}</p>
                                      @endforeach
                                  </div>
                              </div>
                              <div class="col-lg-4">
                                  <div class="mb-3 mb-4">
                                    @foreach ($bobot as $b)
                                      <p class="form-label" for="nama_ayah">Nilai Bobot = {{ $b->bobot_nilai }}</p>
                                    @endforeach
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
                <div class="card text-left">
                  <div class="card-body">
                      <h4 class="card-title">Info</h4>
                      <p class="card-text">
                          <div class="row">
                              <div class="col-lg-2">NIM</div>
                              @if(isset($krs['0']['nim']))
                                  <div class="col-lg-4">:{{ $krs['0']['nim'] }}</div>
                              @else
                                  <div class="col-lg-4  btn-danger">: Mahasiswa Belum Mengambil Krs</div>
                              @endif
                          </div>
                          <div class="row">
                              <div class="col-lg-2">Nama Mahasiswa</div>
                              <div class="col-lg-4">: {{ $mahasiswa['name'] }}</div>
                          </div>
                      </p>
                  </div>
              </div>


              </div>
          </div>
            <div class="col-md-12 col-12 mb-5">
                <form action="{{ route('nilai.edit', $mahasiswa->id) }}" method="GET">
                        <label for="tahun_academic_id">Tahun Akademik:</label>
                        <select class="js-example-basic-single col-sm-12" name="tahun_academic_id" id="tahun_academic_id" onchange="this.form.submit()">
                            <option value="">Pilih Tahun Akademik</option>
                            @foreach($tahun_akademik as $item)
                              <option {{ request('tahun_academic_id') == $item->id ? 'selected' : ''}} value="{{ $item->id }}">{{ $item->tahun_akademik }}</option>
                            @endforeach
                        </select>
                        <button hidden type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
          <div class="row mb-3">
              <div class="card mb-4">
                  <div class="card-body">
                      <div class="row mb-3">
                          <div class="col-12 col-lg-6">
                          <a href="{{ route('nilai') }}" class="btn btn-danger btn-sm">Kembali</a>
                              <a href="" onclick="event.preventDefault();document.getElementById('form-nilai').submit();">
                                  <button class="btn btn-sm btn-primary">Simpan</button>
                              </a>
                          </div>
                      </div>

                    <form action="{{ route('nilai.update') }}" id="form-nilai" method="POST">
                      <input type="hidden" name="dosen_matkul_id" value="">
                      @csrf
                      @method('POST')
                      <div class="table-responsive">
                      <table class="table table-bordered">
                          <thead>
                              <tr>
                                <th style="width: 55px">No</th>
                                  <th width="20%">NIM</th>
                                  <th width="20%">Mata Kuliah</th>
                                  <th width="10%" class="text-center">Tugas</th>
                                  <th width="10%" class="text-center">Partisipasi Pembelajaran</th>
                                  <th width="10%" class="text-center">Kuis</th>
                                  <th width="10%" class="text-center">UTS</th>
                                  <th width="10%" class="text-center">UAS</th>
                                  <th width="20%" class="text-center">Nilai Akhir</th>
                              </tr>
                              @if ($krs->count() > 0)
                              @endif
                          </thead>
                          <tbody>
                          <?php $x = 0 ?>
                            @foreach ($krs as $k)
                            <?php if (! isset($nilais[$x]) ) {
                              $nilais[$x]['tugas'] = '';
                              $nilais[$x]['partisipasi_pembelajaran'] = '';
                              $nilais[$x]['kuis'] = '';
                              $nilais[$x]['uts'] = '';
                              $nilais[$x]['uas'] = '';
                              $nilais[$x]['nilai_akhir'] = '';
                            }
                            ?>
                              <tr class="rowData">
                                  <input type="hidden"  value="{{ $k->tahun_academic_id }}" name="tahun_academic_id[]">
                                  <input type="hidden" value="{{ $mahasiswa->id }}" name="mahasiswa_id[]">
                                  <input type="hidden" value="{{ $k->mata_kuliah_id }}" name="mata_kuliahs_id[]">
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ $k->nim }}</td>
                                  <td>{{ $k['mataKuliah']['name_mata_kuliah'] }}</td>
                                  <td>
                                      <input type="number" min="0" class="form-control form-control-sm tugas" value="{{ $nilais[$x]['tugas'] }}" name="tugas[]" {{ $nilais[$x]['tugas'] ? 'disabled' : '' }}>
                                  </td>
                                  <td>
                                      <input type="number" min="0" class="form-control form-control-sm partisipasi_pembelajaran" value="{{ $nilais[$x]['partisipasi_pembelajaran'] }}" name="partisipasi_pembelajaran[]" {{ $nilais[$x]['partisipasi_pembelajaran'] ? 'disabled' : '' }}>
                                  </td>
                                  <td>
                                      <input type="number" min="0" class="form-control form-control-sm kuis" value="{{ $nilais[$x]['kuis'] }}" name="kuis[]" {{ $nilais[$x]['kuis'] ? 'disabled' : '' }}>
                                  </td>
                                  <td>
                                      <input type="number" min="0" class="form-control form-control-sm uts" value="{{ $nilais[$x]['uts'] }}" name="uts[]" {{ $nilais[$x]['uts'] ? 'disabled' : '' }}>
                                  </td>
                                  <td>
                                      <input type="number" min="0" class="form-control form-control-sm uas" value="{{ $nilais[$x]['uas'] }}" name="uas[]" {{ $nilais[$x]['uas'] ? 'disabled' : '' }}>
                                  </td>
                                  <td>
                                      <input readonly type="number" class="form-control form-control-sm nilai_akhir" value="{{ $nilais[$x]['nilai_akhir'] }}" name="nilai_akhir[]" {{ $nilais[$x]['nilai_akhir'] ? '' : '' }}>
                                  </td>
                              </tr>
                              <?php $x++ ?>
                          @endforeach

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
