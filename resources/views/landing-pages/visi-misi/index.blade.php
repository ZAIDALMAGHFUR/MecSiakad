@extends('layouts.landing')

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endpush

@section('content')


<!--home section start-->
<section class="section-py-space mt-0 pt-0" style="min-height: 100vh;">
    <div class="w-100 my-5"
        style="padding-top: 100px !important; background-image: url({{ asset('images/1.jpg') }}); background-position: center; background-size: cover; background-attachment: fixed;">
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <h2 class="fw-bold h1">VISI MISI</h2>
                    <hr style="width: 30px; height: 3px;" class="mx-auto mt-3 mb-5 d-block">
                </div>
            </div>
        </div>
    </div>

    <div style="display: flex; justify-content: center;">
        <img src="{{ asset('images/visi.png') }}" alt="">
    </div>
    <div class="mt-5 container">
        <h3 class="fw-bold" style="display: flex; justify-content: center;" >VISI</h3>
        <p style="display: flex; justify-content: center;">Menjadi Perguruan Tinggi yang kompetitif dan Inovatif dalam Bidang Pendidikan Vokasi di Tingkat Nasional Tahun 2030</p>
        <h3 class="fw-bold mt-4" style="display: flex; justify-content: center;" >MISI</h3>
        <p style="display: flex; justify-content: center;"> 1. Menghasilkan SDM yang memiliki kemampuan kompetitif dan Inovatif dalam bidang Pendidikan vokasi serta memiliki pengetahuan dan wawasan yang luas, disertai kesadaran yang tinggi dalam hal ketaqwaan kepada Tuhan Yang Maha Esa, berbudi luhur, dan kepribadian dalam kehidupan bermasyarakat </p>
        <p style="display: flex; justify-content: center;"> 2. Terselenggaranya pendidikan vokasi dengan melaksanakan Tridharma Perguruaan Tinggi serta mengembangkan pendidikan berdasarkan Pancasila dan UUD 1945</p>
        <p style="display: flex; justify-content: center;"> 3. Terjalinnya kerjasama dengan berbagai pihak yang saling menguntungkan untuk mengembangkan keilmuan di bidang pendidikan vokasi  </p>
        <p style="display: flex; justify-content: center;"> 4. Terbangunnya suasana kerja yang kompetitif dan inovatif dalam rangka peningkatan kualitas kesejehteraan dosen dan keryawan di lingkungan Perguruan Tinggi.        </p>
    </div>


</section>


<!--home section end-->
@endsection

@push('scripts')
<!-- Plugins JS start-->
<script src="{{ asset('vendor/fslightbox/fslightbox.js') }}"></script>
<!-- Plugins JS Ends-->

@endpush
