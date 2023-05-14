<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <title>Landing Page ZAIDAL</title>
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
                                    <span class="fw-bold fs-5">ZAIDAL</span>
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

            <div class="sub-footer">
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