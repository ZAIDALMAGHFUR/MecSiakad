@extends('layouts.landing')

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/photoswipe.css') }}">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endpush

@section('content')


<!--home section start-->
<section class="landing-home section-pb-space" id="home"><img class="img-fluid bg-img-cover"
        src="../assets/images/landing/landing-home/home-bg2.jpg" alt="">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="landing-home-contain w-100">
                    <div class="col-12 col-md-6">
                        {{-- <div class="landing-logo"><img class="img-fluid"
                                src="../assets/images/landing/landing-home/logo.png" alt=""></div> --}}
                        <h6 class="fw-bold uppercase" data-aos="fade-down">SELAMAT DATANG DI</h6>
                        <h2 class="fs-1" data-aos="fade-down">Website Kampus <span>ZAIDAL</span></h2>
                        <p data-aos="zoom-in">When it comes to dashboard or web apps. one of the first impression you
                            consider
                            is the design. It needs to be high quality enough otherwise you will lose
                            potential users due to bad design.</p>
                        <div class="d-flex gap-2 flex-column flex-md-row" data-aos="fade-up">
                            <a class="btn btn-primary py-3 btn-lg" href="/" target="_blank">PMB</a>
                            <a class="btn py-3 btn-secondary btn-lg" href="{{ route('login') }}" target="_blank">Login
                                Sebagai Mahasiswa</a>
                        </div>
                    </div>
                    <div class="d-none d-md-block col-md-6" data-aos="fade-left">
                        <img src="{{ asset('images/mahasiswa.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>

<section class="demo-section section-py-space">
    <div class="title">
        <h2>Berita Terbaru</h2>
        <hr style="width: 30px; height: 3px;" class="mx-auto mt-3 mb-5 d-block">
    </div>
    <div class="container">
        <div class="row demo-block demo-imgs">
            @foreach ($newestBerita as $item)
            <div class="col-sm-6 col-md-4">
                <div class="card" data-aos="fade-down" data-aos-offset="200"
                    data-aos-delay="{{ 50 + ($loop->iteration * 50) }}">
                    <div class="blog-box blog-grid">
                        <div class="blog-wrraper"><a href="{{ route('landing-pages.berita.detail', $item) }}">
                                <img class="img-fluid top-radius-blog" src="{{ asset('storage/' . $item->thumbnail) }}"
                                    alt=""></a>
                        </div>
                        <div class="blog-details-second">
                            <div class="blog-post-date"><span class="blg-month">{{
                                    strtoupper($item->created_at->format('M')) }}</span><span class="blg-date">{{
                                    $item->created_at->format('d') }}</span>
                            </div><a href="{{ route('landing-pages.berita.detail', $item) }}">
                                <h6 class="blog-bottom-details">{{ $item->title }}</h6>
                            </a>
                            <p>{{ $item->description }}</p>
                            <p>
                                @if ($item->tags)
                                @foreach ($item->tags as $tag)
                                <a href="{{ route('landing-pages.berita', ['tag' => $tag]) }}"
                                    class="text-secondary">#{{ $tag }}</a>
                                @endforeach
                                @endif
                            </p>
                            <div class="detail-footer">
                                <ul class="sociyal-list">
                                    <li>
                                        <i class="fa fa-tag"></i> <a
                                            href="{{ route('landing-pages.berita', ['category' => $item->category]) }}">{{
                                            $item->category }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="demo-section section-py-space light-bg">
    <div class="title">
        <h2>Jurnal Terbaru</h2>
        <hr style="width: 30px; height: 3px;" class="mx-auto mt-3 mb-5 d-block">
    </div>
    <div class="container">
        <div class="row demo-block demo-imgs">
            @foreach ($newestJurnal as $item)
            <div class="col-sm-6 col-md-4">
                <div class="card" data-aos="fade-down" data-aos-offset="200"
                    data-aos-delay="{{ 50 + ($loop->iteration * 50) }}">
                    <div class="blog-box blog-grid">
                        <div class="blog-wrraper"><a href="{{ route('landing-pages.jurnal.detail', $item) }}">
                                <img class="img-fluid top-radius-blog" src="{{ asset('storage/' . $item->thumbnail) }}"
                                    alt=""></a>
                        </div>
                        <div class="blog-details-second">
                            <div class="blog-post-date"><span class="blg-month">{{
                                    strtoupper($item->created_at->format('M')) }}</span><span class="blg-date">{{
                                    $item->created_at->format('d') }}</span>
                            </div><a href="{{ route('landing-pages.jurnal.detail', $item) }}">
                                <h6 class="blog-bottom-details">{{ $item->title }}</h6>
                            </a>
                            <p>{{ $item->description }}</p>
                            <p>
                                @if ($item->tags)
                                @foreach ($item->tags as $tag)
                                <a href="{{ route('landing-pages.jurnal', ['tag' => $tag]) }}"
                                    class="text-secondary">#{{ $tag }}</a>
                                @endforeach
                                @endif
                            </p>
                            <div class="detail-footer">
                                <ul class="sociyal-list">
                                    <li>
                                        <i class="fa fa-tag"></i> <a
                                            href="{{ route('landing-pages.jurnal', ['category' => $item->category]) }}">{{
                                            $item->category }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="demo-section section-py-space">
    <div class="title">
        <h2>Galeri Terbaru</h2>
        <hr style="width: 30px; height: 3px;" class="mx-auto mt-3 mb-5 d-block">
    </div>
    <div class="container">
        <div class="row demo-block demo-imgs">
            <div class="my-gallery card-body row gallery-with-description" itemscope="">
                @foreach ($newestGaleri as $item)
                <figure class="col-xl-3 col-sm-6 xl-33" data-aos="fade-down" data-aos-offset="200"
                    data-aos-delay="{{ 50 + ($loop->iteration * 50) }}" itemprop="associatedMedia" itemscope="">
                    <a href="{{ asset('storage/' . $item->thumbnail) }}" itemprop="contentUrl" data-size="1600x950"
                        class="bg-white">
                        <img src="{{asset('storage/' . $item->thumbnail)}}" itemprop="thumbnail"
                            alt="Image description">
                        <div class="caption">
                            <h4>{{ $item->title }}</h4>
                            <p>{{ $item->description }}</p>
                        </div>
                    </a>
                    <figcaption itemprop="caption description">
                        <h4>{{ $item->title }}</h4>
                        <p>{{ $item->description }}</p>
                    </figcaption>
                </figure>
                @endforeach
            </div>
            <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
                <!--
                Background of PhotoSwipe.
                It's a separate element, as animating opacity is faster than rgba().
                -->
                <div class="pswp__bg"></div>
                <!-- Slides wrapper with overflow:hidden.-->
                <div class="pswp__scroll-wrap">
                    <!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory.-->
                    <!-- don't modify these 3 pswp__item elements, data is added later on.-->
                    <div class="pswp__container">
                        <div class="pswp__item"></div>
                        <div class="pswp__item"></div>
                        <div class="pswp__item"></div>
                    </div>
                    <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed.-->
                    <div class="pswp__ui pswp__ui--hidden">
                        <div class="pswp__top-bar">
                            <!-- Controls are self-explanatory. Order can be changed.-->
                            <div class="pswp__counter"></div>
                            <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                            <button class="pswp__button pswp__button--share" title="Share"></button>
                            <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                            <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                            <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR-->
                            <!-- element will get class pswp__preloader--active when preloader is running-->
                            <div class="pswp__preloader">
                                <div class="pswp__preloader__icn">
                                    <div class="pswp__preloader__cut">
                                        <div class="pswp__preloader__donut"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                            <div class="pswp__share-tooltip"></div>
                        </div>
                        <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
                        <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
                        <div class="pswp__caption">
                            <div class="pswp__caption__center"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="jadwalPMB" tabindex="-1" aria-labelledby="jadwalPMBLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="jadwalPMBLabel">{{ $jadwalPmb->nama_kegiatan }} - <div
                        class="badge badge-primary">{{ $jadwalPmb->jenis_kegiatan }}</div>
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('landing-pages.hide-modal') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 mb-4 mb-md-0">
                            <img src="{{ asset('storage/' . $jadwalPmb->brosur) }}" alt=""
                                class="img-thumbnail w-100 d-block">
                        </div>
                        <div class="col-md-8">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="fw-bold px-3 py-2 bg-primary">{{
                                    \Carbon\Carbon::parse($jadwalPmb->tgl_mulai)->translatedFormat('d F
                                    Y') }}</div>
                                <div>Sampai</div>
                                <div class="fw-bold px-3 py-2 bg-secondary">{{
                                    \Carbon\Carbon::parse($jadwalPmb->tgl_akhir)->translatedFormat('d F
                                    Y') }}</div>
                            </div>
                            <p>{!! $jadwalPmb->description !!}</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tutup & Jangan Pernah Tampilkan Lagi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--home section end-->
@endsection

@push('scripts')
<!-- Plugins JS start-->
<script src="{{ asset('assets/js/photoswipe/photoswipe.min.js') }}"></script>
<script src="{{ asset('assets/js/photoswipe/photoswipe-ui-default.min.js') }}"></script>
<script src="{{ asset('assets/js/photoswipe/photoswipe.js') }}"></script>
<!-- Plugins JS Ends-->

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
    const jadwalPMBModal = new bootstrap.Modal(document.getElementById('jadwalPMB'));
    @if($showModal)
    jadwalPMBModal.show();
    @endif
</script>
@endpush