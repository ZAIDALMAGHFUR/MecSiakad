@extends('layouts.landing')

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/photoswipe.css') }}">
@endpush

@section('content')
<!--home section start-->
<section class="section-py-space mt-0 pt-0" style="min-height: 100vh;">
    <div class="w-100 my-5"
        style="padding-top: 100px !important; background-image: url({{ asset('images/1.jpg') }}); background-position: center; background-size: cover; background-attachment: fixed;">
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <h2 class="fw-bold h1">Galeri</h2>
                    <hr style="width: 30px; height: 3px;" class="mx-auto mt-3 mb-5 d-block">
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row py-3">
            <div class="col">
                <form action="">
                    <div class="input-group mb-3 flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">
                            <span data-feather="search"></span>
                        </span>
                        <input type="text" class="form-control" placeholder="Cari berdasarkan keyword..." name="keyword"
                            value="{{ request('keyword') }}" />
                        <button class="btn btn-primary" type="submit" id="button-addon2">Cari</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row demo-block demo-imgs">
            <div class="my-gallery card-body row gallery-with-description" itemscope="">
                @foreach ($galleries as $item)
                <div class="col-xl-3 col-sm-6 xl-33 mb-4" data-aos="fade-down" data-aos-offset="200"
                    data-aos-delay="{{ 50 + ($loop->iteration * 50) }}">
                    <figure itemprop="associatedMedia" itemscope="" class="mb-1">
                        <a href="{{ asset('storage/' . $item->thumbnail) }}" itemprop="contentUrl" data-size="1600x950">
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
                    <a onclick="window.location.href = this.href"
                        href="{{ route('landing-pages.gallery-detail', $item->id) }}"
                        class="btn btn-primary fw-bold w-100">Lihat</a>
                </div>
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
        <div class="row">
            <div class="col py-4">
                {{ $galleries->links() }}
            </div>
        </div>
    </div>
</section>
<!--home section end-->
@endsection

@push('scripts')
<!-- Plugins JS start-->
<script src="{{ asset('assets/js/photoswipe/photoswipe.min.js') }}"></script>
<script src="{{ asset('assets/js/photoswipe/photoswipe-ui-default.min.js') }}"></script>
<script src="{{ asset('assets/js/photoswipe/photoswipe.js') }}"></script>
<!-- Plugins JS Ends-->
@endpush