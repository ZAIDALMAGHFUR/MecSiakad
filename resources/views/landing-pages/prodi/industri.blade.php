@extends('layouts.landing')

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endpush
@pushOnce('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endPushOnce

@section('content')


<!--home section start-->
<section class="section-py-space mt-0 pt-0" style="min-height: 100vh;">
    <div class="w-100 my-5"
        style="padding-top: 100px !important; background-image: url({{ asset('images/1.jpg') }}); background-position: center; background-size: cover; background-attachment: fixed;">
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <h2 class="fw-bold h1">Teknik Kimia</h2>
                    <hr style="width: 30px; height: 3px;" class="mx-auto mt-3 mb-5 d-block">
                </div>
            </div>
        </div>
    </div>

    <div style="display: flex; justify-content: center;">
        <img src="{{ asset('images/menejemen_Industri.png') }}" alt="">
    </div>
    <div class="mt-5 container">
        <p>Program Studi Teknik Kimia Manajemen Industri adalah salah satu jurusan di perguruan tinggi yang menawarkan pendidikan tingkat diploma tiga atau D3.</p>
        <p class="fw-bold">VISI</p>

        <p>Jurusan Teknik Kimiaadalah menjadi pusat pendidikan dan pengembangan teknologi informasi yang terkemuka di tingkat nasional dan internasional. Visi ini mencerminkan tujuan akhir dari program S1 Sistem Informasi, yaitu menghasilkan lulusan yang memiliki keterampilan dan pengetahuan yang tinggi dalam bidang teknologi informasi dan mampu menghadapi tantangan dunia kerja yang terus berkembang.</p>

        <p class="fw-bold">MISI</p>

        <p>1. Memberikan pendidikan yang berkualitas dan relevan dengan kebutuhan industri teknologi informasi di tingkat nasional dan internasional.</p>
        <p>2. Menyediakan kurikulum yang inovatif dan fleksibel untuk mengembangkan keterampilan teknologi informasi serta keahlian manajemen dan bisnis.</p>
        <p>3. Menyediakan lingkungan pembelajaran yang kondusif dan memfasilitasi mahasiswa untuk belajar mandiri serta berpartisipasi dalam proyek dan kegiatan yang relevan dengan industri.</p>
        <p>4. Mengembangkan dan menghasilkan penelitian dan inovasi di bidang teknologi informasi yang berkontribusi pada perkembangan industri dan masyarakat.</p>
        <p>5. Mengembangkan kemitraan strategis dengan industri dan organisasi untuk mengintegrasikan kebutuhan industri ke dalam program pendidikan dan menawarkan peluang kerja bagi lulusan.</p>
        <p>6. Mendorong mahasiswa untuk mengembangkan sikap kritis, etis, dan profesional dalam menggunakan teknologi informasi dalam konteks bisnis dan sosial.</p>


        <p class="fw-bold">KOPETENSI</p>
        <p>Keterampilan teknologi informasi: mahasiswa diharapkan memiliki keterampilan dalam pengembangan perangkat lunak, pengelolaan database, desain sistem, analisis data, dan pengelolaan jaringan.</p>
        <p>Keterampilan manajemen dan bisnis: mahasiswa diharapkan memiliki pemahaman tentang manajemen proyek, strategi bisnis, keuangan, dan etika bisnis, serta mampu mengintegrasikan teknologi informasi dalam konteks bisnis.</p>
        <p>Keterampilan interpersonal dan komunikasi: mahasiswa diharapkan mampu berkomunikasi dengan baik, berkolaborasi, dan bekerja dalam tim, serta memiliki keterampilan interpersonal yang baik.</p>


        <h3 class="fw-bold mt-5">DAFTAR MATA KULIAH</h3>
        <div class="mt-5">
            <div class="page-body">
                <div class="container-fluid">
                  <div class="page-header">
                    <div class="row">
                      <div class="col-sm-6">
                        <h3>Mata Kuliah</h3>
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="index.html">Applications</a></li>
                          <li class="breadcrumb-item">Data Master</li>
                          <li class="breadcrumb-item active">Mata Kuliah</li>
                        </ol>
                      </div>
                      <div class="col-sm-6">
                        <!-- Bookmark Start-->
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
                                <th>Kode Mk</th>
                                <th>Nama MK</th>
                                <th>Jumlah Sks</th>
                                <th>Program Studi</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($Mata_Kuliah_industri as $item)
                                <tr>
                                  <td style="text-align: center">{{ $loop->iteration }}</td>
                                  <td>{{ $item->kode_mata_kuliah }}</td>
                                  <td>{{ $item->name_mata_kuliah }}</td>
                                  <td>{{ $item->sks }}</td>
                                  <td>{{ $item->program_studies->name }}</td>
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
        </div>
    </div>


</section>


<!--home section end-->
@endsection

@push('scripts')
<!-- Plugins JS start-->
<script src="{{ asset('vendor/fslightbox/fslightbox.js') }}"></script>
<!-- Plugins JS Ends-->

@endpush

@pushOnce('js')
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
<script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
@endPushOnce
