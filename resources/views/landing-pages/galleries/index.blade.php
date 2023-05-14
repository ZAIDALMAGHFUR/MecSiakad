@extends('layouts.landing')

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
        <div class="row">
            @foreach ($galleries as $item)
            <div class="col-sm-6 col-md-4">
                <div class="card">
                    <img src="{{ asset('storage/' . $item->thumbnail) }}" class="card-img-top"
                        alt="{{ $item->title }} Image">
                    <div class="card-body">
                        <h6 class="card-title fw-bold"><a href="{{ route('landing-pages.berita.detail', $item) }}">{{
                                $item->title }}</a></h6>
                        <p class="card-text">{!! nl2br($item->description) !!}</p>
                        <p class="card-text"><small class="text-body-secondary">{{
                                $item->created_at->diffForHumans() }}</small>
                        </p>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-primary fw-bold w-100 mb-2" data-fslightbox
                            href="{{ asset('storage/' . $item->thumbnail) }}">Lihat
                        </a>
                        <a class="btn btn-secondary fw-bold w-100"
                            href="{{ route('landing-pages.gallery-detail', $item->id) }}">Lihat Gambar Lainnya
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col py-4">
            {{ $galleries->links() }}
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