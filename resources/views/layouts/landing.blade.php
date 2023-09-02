<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="kampus ACTM, Kampus ati cut meutiam, ACTM, medan, clean &amp; kampus actm kampus hebat dan berkualitas, kampus at cut meutia.">
    <meta name="keywords"
        content="kampus ati cut meutia, kampus actm, actm, ati cut meutia, kampus actm,  landing pages kampus actm, actm kampus, kampus actm,  landing pages kampus, website kampus act, website kampus ati cut meutia, kamppus actm">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <title>Landing Page ACTM</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/icofont.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themify.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/flag-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/feather-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owlcarousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/color-1.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">

    @stack('styles')

    <style>
        .grid-galleries {
            width: 100%;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 10px;
        }
    </style>
</head>

<body class="landing-wrraper">
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper landing-page">
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- header start-->
            <header class="landing-header">
                <div class="custom-container">
                    <div class="row">
                        <div class="col-12">
                            <nav class="navbar navbar-light p-0" id="navbar-example2">
                                <a class="navbar-brand" href="javascript:void(0)">
                                    <span class="fw-bold fs-5">ACTM</span>
                                    {{-- <img class="img-fluid" src="../assets/images/logo/logo.png" alt=""> --}}
                                </a>
                                <ul class="landing-menu nav nav-pills">
                                    <li class="nav-item menu-back">back<i class="fa fa-angle-right"></i></li>
                                    <li class="nav-item"><a class="nav-link" href="/">Beranda</a></li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('landing-pages.berita') }}">Berita</a></li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('landing-pages.jurnal') }}">Jurnal</a></li>
                                    @if (isset($pages[""]) && count($pages[""]) > 0)
                                    @foreach ($pages[""] as $item)
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('landing-pages.pages.detail',$item) }}">{{ $item->menu }}</a>
                                    </li>
                                    @endforeach
                                    @endif

                                    @foreach ($pages as $key => $page)
                                    @if ($key != "")
                                    <li class="nav-item">
                                        <div class="onhover-dropdown navs-dropdown">
                                            <a href="#" class="nav-link link-dark onhover-dropdown"
                                                data-bs-original-title="" title="">{{ $key }}</i></a>
                                            <div class="onhover-show-div">
                                                <div class="nav-list">
                                                    <ul class="nav-list-disc">
                                                        @foreach ($page as $item)
                                                        <li><a href="{{ route('landing-pages.pages.detail',$item) }}"
                                                                data-bs-original-title="" title=""><i
                                                                    class="fa fa-angle-right"></i><span>
                                                                    {{ $item->menu }}</span></a></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endif
                                    @endforeach





                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('landing-pages.galleries') }}">Galeri</a></li>


                                      <li class="nav-item">
                                        <div class="onhover-dropdown navs-dropdown">
                                          <a href="#" class="nav-link link-dark onhover-dropdown"
                                            data-bs-original-title="" title="">Profile <i class="fa fa-angle-down"></i></a>
                                          <div class="onhover-show-div">
                                            <div class="nav-list">
                                              <ul class="nav-list-disc">
                                                <li>
                                                  <a href="{{ route('landing-pages.sejarah') }}" data-bs-original-title="" title=""><i class="fa fa-angle-right"></i><span>Sejarah Kampus</span></a>
                                                </li>
                                                <li>
                                                  <a href="{{ route('landing-pages.visi-misi') }}" data-bs-original-title="" title=""><i class="fa fa-angle-right"></i><span>Visi Misi</span></a>
                                                </li>
                                              </ul>
                                            </div>
                                          </div>
                                        </div>
                                      </li>

                                      <li class="nav-item">
                                        <div class="onhover-dropdown navs-dropdown">
                                          <a href="#" class="nav-link link-dark onhover-dropdown"
                                            data-bs-original-title="" title="">Academic <i class="fa fa-angle-down"></i></a>
                                          <div class="onhover-show-div">
                                            <div class="nav-list">
                                              <ul class="nav-list-disc">
                                                <li>
                                                  <a href="{{ route('landing-pages.prodi-kimia') }}" data-bs-original-title="" title=""><i class="fa fa-angle-right"></i><span>Program Studi Kimia</span></a>
                                                </li>
                                                <li>
                                                  <a href="{{ route('landing-pages.prodi-industri') }}" data-bs-original-title="" title=""><i class="fa fa-angle-right"></i><span>Program Studi Manajemen Industri </span></a>
                                                </li>
                                                <li>
                                                  <a href="https://sinta.kemdikbud.go.id/affiliations/profile/718" data-bs-original-title="" title=""><i class="fa fa-angle-right"></i><span>SINTA</span></a>
                                                </li>
                                              </ul>
                                            </div>
                                          </div>
                                        </div>
                                      </li>

                                      <li class="nav-item"><a class="nav-link"
                                        href="{{ route('landing-pages.download-umum') }}">Berkas Download</a>
                                        </li>

                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('landing-pages.struktur-kps') }}">Struktur Kepemimpinan</a>
                                    </li>
                                </ul>
                                <div class="buy-block"><a class="btn-landing" href="{{ route('login') }}">Login</a>
                                    <div class="toggle-menu"><i class="fa fa-bars"></i></div>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </header>
            <!-- header end-->

            @yield('content')

            <!-- <div class="sub-footer">
                <div class="custom-container">
                    <div class="row">
                        <div class="col-md-6 col-sm-2">
                            <div class="footer-contain">
                                <img class="img-fluid" src="../assets/images/logo/logo.png" alt="">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-10">
                            <div class="footer-contain">
                                <p class="mb-0">Copyright {{ date('Y') }} © ZAIDAL All rights reserved. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

        </div>
            <!--footer start-->
            <div style="margin-left: -17rem;">
<footer class="py-5">
    <div class="row" style="margin-left: 0;">
      <div class="col-6 col-md-2 mb-3">
      <img class="img-fluid" src="{{ asset('assets/images/logoactm.png') }}" alt="">
      </div>

      <div class="col-6 col-md-2 mb-3">
        <h5 class="link-body-emphasis fw-bold text-success ">Kampus Utama</h5>
        <ul class="nav flex-column ">
<<<<<<< HEAD
          <a class="text-body-secondary fw-bold">Jl. Medan-Binjai Km 16,5 Sei Semayang, Kec. Sunggal Kab. Deli Serdang - Sumatera Utara</a>
          <div class="mt-3">
            <a href=""><svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/></svg></i> <a style="font-size: 20px;">0823 6515 7391</a></a>
            <a style="font-size: 15px; " class="text-body-secondary fw-bold" >info@aticutmeutia.ac.id</a>
=======
          <a class="text-body-secondary fw-bold">Kampus Utama : Jl. Medan-Binjai Km 16,5 Sei Semayang, Kec. Sunggal Kab. Deli Serdang - Sumatera Utara</a>
          <div class="mt-3">
            <a href=""><svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/></svg></i> <a style="font-size: 20px;">0823 6515 7391</a></a>
            <a style="font-size: 15px; " class="text-body-secondary fw-bold" >info@aticutmeutia.ac.id</a>  
>>>>>>> 677e430bffcdef9b793a4ea4fe77845b84b75ec6
        </div>
        </ul>

      </div>

      <div class="col-6 col-md-2 mb-3">
        <h5 class="link-body-emphasis fw-bold text-success ">Kampus II</h5>
        <ul class="nav flex-column ">
<<<<<<< HEAD
          <a class="text-body-secondary fw-bold"> Jl. AH. Nasution No. 18, Pangkalan Masyhur, Medan Johor, Medan - Sumatera Utara</a>
=======
          <a class="text-body-secondary fw-bold">Kampus Utama : Kampus II : Jl. AH. Nasution No. 18, Pangkalan Masyhur, Medan Johor, Medan - Sumatera Utara</a>
          <div class="mt-3">
            <a href=""><svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/></svg></i> <a style="font-size: 20px;">0823 6515 7391</a></a>
            <a style="font-size: 13px; " class="text-body-secondary fw-bold" >info@aticutmeutia.ac.id</a>  
        </div>
>>>>>>> 677e430bffcdef9b793a4ea4fe77845b84b75ec6
        </ul>

      </div>

      <div class="col-md-5 offset-md-1 mb-3">
        <div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3981.932955144437!2d98.5382053!3d3.602827999999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3031292ef8dd5ec1%3A0x449756fa63449563!2sAkademi%20Teknik%20Indonesia%20Cut%20Meutia%20Kampus%20I!5e0!3m2!1sid!2sid!4v1685867692240!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>

    <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top">
    <p>© {{ date('Y') }} <a class="link-body-emphasis fw-bold ">Akademi Teknik Indonesia Cut Meutia</a> by © <a class="link-body-emphasis fw-bold ">PT. Mec Tech Inv</a> rights reserved.</p>
      <ul class="list-unstyled d-flex">
        <li class="ms-3"><a class="link-body-emphasis" href="#"><i class="fa fs-1 fa-twitter"></i></a></li>
        <li class="ms-3"><a class="link-body-emphasis" href="#"><i class="fa fs-1 fa-instagram"></i></a></li>
        <li class="ms-3"><a class="link-body-emphasis" href="#"><i class="fa fs-1 fa-facebook"></i></a></li>
        <li class="ms-3"><a class="link-body-emphasis" href="#"><i class="fa fs-1 fa-youtube"></i></li>
        <li class="ms-3"><a class="link-body-emphasis" href="#"><i class="fa fs-1 fa-whatsapp"></i></li>
      </ul>
    </div>
  </footer>
</div>
            <!--footer end-->
        </div>
    </div>
    <!-- latest jquery-->

    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/owlcarousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/owlcarousel/owl-custom.js') }}"></script>
    <script src="{{ asset('assets/js/landing_sticky.js') }}"></script>
    <script src="{{ asset('assets/js/landing.js') }}"></script>
    <script src="{{ asset('assets/js/jarallax_libs/libs.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
    <script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>
    <script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
    <!-- login js-->
    <!-- Plugin used-->

    @stack('scripts')
</body>

</html>
