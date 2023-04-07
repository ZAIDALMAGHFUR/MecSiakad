@extends('layouts.pmb')

@section('content')
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="../../css2.css?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
<link href="../../css2-1.css?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
<link href="../../css2-2.css?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
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
  <div class="page-body">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row">
          <div class="col-sm-6">
            <h3>Dashboard</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item">General</li>
              <li class="breadcrumb-item active">Dashboard</li>
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
    <!-- Container-fluid starts-->
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                  <h5>Foto Kampus</h5>
                </div>
                <div class="card-body">
                  <div class="owl-carousel owl-theme" id="owl-carousel-13">
                    @foreach($fotos as $f)
                      <div class="item"><img src="{{ Storage::url($f->foto_kampus) }}" width="150" alt="Gamabar Mahasiswa" class="rounded"></div>
                      <div class="item"><img src="{{ Storage::url($f->foto_kampus2) }}" width="150" alt="Gamabar Mahasiswa" class="rounded"></div>
                      <div class="item"><img src="{{ Storage::url($f->foto_kampus3) }}" width="150" alt="Gamabar Mahasiswa" class="rounded"></div>
                      <div class="item"><img src="{{ Storage::url($f->foto_kampus4) }}" width="150" alt="Gamabar Mahasiswa" class="rounded"></div>
                      <div class="item"><img src="{{ Storage::url($f->foto_kampus5) }}" width="150" alt="Gamabar Mahasiswa" class="rounded"></div>
                      <div class="item"><img src="{{ Storage::url($f->foto_kampus6) }}" width="150" alt="Gamabar Mahasiswa" class="rounded"></div>
                      <div class="item"><img src="{{ Storage::url($f->foto_kampus7) }}" width="150" alt="Gamabar Mahasiswa" class="rounded"></div>
                      <div class="item"><img src="{{ Storage::url($f->foto_kampus8) }}" width="150" alt="Gamabar Mahasiswa" class="rounded"></div>
                      <div class="item"><img src="{{ Storage::url($f->foto_kampus9) }}" width="150" alt="Gamabar Mahasiswa" class="rounded"></div>
                      <div class="item"><img src="{{ Storage::url($f->foto_kampus10) }}" width="150" alt="Gamabar Mahasiswa" class="rounded"></div>
                    @endforeach
                  </div>
                </div>
              </div>
        </div>
      </div>
      <div class="col-xl-6 xl-100 col-lg-12 box-col-12">
        <div class="card">
          <div class="card-header">
            <h5 class="pull-left">Persyaratan Pendaftaran</h5>
          </div>
          <div class="card-body">
            <div class="tabbed-card">
              <ul class="pull-right nav nav-tabs border-tab nav-secondary" id="top-tabsecondary" role="tablist">
                <li class="nav-item"><a class="nav-link" id="top-home-secondary" data-bs-toggle="tab" href="#top-homesecondary" role="tab" aria-controls="top-home" aria-selected="false"><i class="fa fa-institution"></i>prestasi</a>
                  <div class="material-border"></div>
                </li>
                <li class="nav-item"><a class="nav-link active" id="profile-top-secondary" data-bs-toggle="tab" href="#top-profilesecondary" role="tab" aria-controls="top-profilesecondary" aria-selected="true"><i class="fa fa-users"></i>beasiswa</a>
                  <div class="material-border"></div>
                </li>
                <li class="nav-item"><a class="nav-link" id="contact-top-secondary" data-bs-toggle="tab" href="#top-contactsecondary" role="tab" aria-controls="top-contactsecondary" aria-selected="false"><i class="icofont icofont-contacts"></i>pindahan</a>
                  <div class="material-border"></div>
                </li>
                <li class="nav-item"><a class="nav-link" id="contact-top-secondary" data-bs-toggle="tab" href="#top-contactsecondary" role="tab" aria-controls="top-contactsecondary" aria-selected="false"><i class="icofont icofont-contacts"></i>reguler</a>
                  <div class="material-border"></div>
                </li>
              </ul>
              <div class="tab-content" id="top-tabContentsecondary">
                @foreach($Persyaratans as $persyaratan)
                  <div class="tab-pane fade" id="top-homesecondary" role="tabpanel" aria-labelledby="top-home-tab">
                    <p>{{ $persyaratan->jalur_prestasi }}</p>
                  </div>
                  <div class="tab-pane fade active show" id="top-profilesecondary" role="tabpanel" aria-labelledby="profile-top-tab">
                    <p>{{ $persyaratan->jalur_beasiswa }}</p>
                  </div>
                  <div class="tab-pane fade" id="top-contactsecondary" role="tabpanel" aria-labelledby="contact-top-tab">
                    <p>{{ $persyaratan->jalur_pindahan }}</p>
                  </div>
                  <div class="tab-pane fade" id="top-regulersecondary" role="tabpanel" aria-labelledby="reguler-top-tab">
                    <p>{{ $persyaratan->jalur_reguler }}</p>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid Ends-->
    <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header pb-0">
                <h5>Alur Pendafataran</h5>
              </div>
              <div class="card-body">
                <!-- cd-timeline Start-->
                <section class="cd-container" id="cd-timeline">
                  <div class="cd-timeline-block">
                    <div class="cd-timeline-img cd-picture bg-primary"><i class="icon-pencil-alt"></i></div>
                    <div class="cd-timeline-content">
                      <h4>Pendafataran Online<span class="digits"> </span></h4>
                      <p class="m-0">Melakukan pengisian seluruh berkas dan bla bla  bla.</p><span class="cd-date">
                    </div>
                  </div>
                  <div class="cd-timeline-block">
                    <div class="cd-timeline-img cd-movie bg-secondary"><i class="icon-video-camera"></i></div>
                    <div class="cd-timeline-content">
                      <h4>Tes Intervew<span class="digits"></span></h4>
                      <div class="embed-responsive embed-responsive-21by9 m-t-20">
                        <iframe src="../../embed/wpmHZspl4EM.html" allowfullscreen=""></iframe>
                      </div>
                    </div>
                  </div>
                  <div class="cd-timeline-block">
                    <div class="cd-timeline-img cd-location bg-warning"><i class="icon-image"></i></div>
                    <div class="cd-timeline-content">
                      <h4>Menunggu Penguguman<span class="digits"> </span></h4><img class="img-fluid p-t-20" src="../assets/images/banner/3.jpg" alt="">
                    </div>
                  </div>
                  <div class="cd-timeline-block">
                    <div class="cd-timeline-img cd-movie bg-danger"><i class="icon-pencil-alt"></i></div>
                    <div class="cd-timeline-content">
                      <h4>Final</h4>
                      <p class="m-0">This is the content of the last section</p>
                    </div>
                  </div>
                </section>
                <!-- cd-timeline Ends-->
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>

  

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
  <script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>
  <script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>
  <script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
  <script src="{{ asset('assets/js/timeline/timeline-v-1/main.js') }}"></script>
  <script src="{{ asset('assets/js/modernizr.js') }}"></script>
@endsection
