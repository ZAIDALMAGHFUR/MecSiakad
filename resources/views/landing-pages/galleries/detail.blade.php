@extends('layouts.landing')

@section('content')
<div class="container" style="padding-top: 150px; min-height: 100vh;">
    <div class="row mb-3">
        <div class="col">
            <a href="{{ route('landing-pages.galleries') }}" class="btn btn-outline-secondary">Kembali</a>
        </div>
    </div>
    <div class="row">
        <div class="col mb-4">
            <div class="blog-single">
                <div class="blog-box blog-details">
                    <div class="banner-wrraper"><img class="img-fluid w-100 bg-img-cover"
                            src="{{ asset('storage/'. $gallery->thumbnail) }}" alt="blog-main"></div>
                    <div class="card">
                        <div class="card-body">
                            <div class="blog-details">
                                <ul class="blog-social">
                                    <li>{{ $gallery->created_at->format('d F Y') }}</li>
                                </ul>
                                <h4>
                                    {{ $gallery->title }}
                                </h4>
                                <div class="single-blog-content-top py-3">
                                    {!! $gallery->description !!}
                                </div>

                                <div class="grid-galleries">
                                    @foreach ($gallery->galleryItems as $item)
                                    <a class="w-100" data-fslightbox href="{{ asset('storage/' . $item->thumbnail) }}">
                                        <img src="{{ asset('storage/' . $item->thumbnail) }}" alt=""
                                            class="img-thumbnail d-block" />
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Plugins JS start-->
<script src="{{ asset('vendor/fslightbox/fslightbox.js') }}"></script>
<!-- Plugins JS Ends-->
@endpush