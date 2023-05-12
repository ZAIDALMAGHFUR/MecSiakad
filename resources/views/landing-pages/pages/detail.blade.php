@extends('layouts.landing')

@section('content')
<div class="container" style="padding-top: 150px; min-height: 100vh;">
    <div class="row mb-3">
        <div class="col">
            <a href="{{ route('landing-pages.index') }}" class="btn btn-outline-secondary">Kembali</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="blog-single">
                <div class="blog-box blog-details">
                    @if ($page->thumbnail)
                    <div class="banner-wrraper"><img class="img-fluid w-100 bg-img-cover"
                            src="{{ asset('storage/'. $page->thumbnail) }}" alt="blog-main"></div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <div class="blog-details">
                                <ul class="blog-social">
                                    <li>{{ $page->created_at->format('d F Y') }}</li>
                                    <li>
                                        <a href="#">{{
                                            $page->category }}</a>
                                    </li>
                                    <li>
                                        @if ($page->tags)
                                        @foreach ($page->tags as $tag)
                                        <a href="#" class="text-secondary">#{{ $tag }}</a>
                                        @endforeach
                                        @endif
                                    </li>
                                </ul>
                                <h4>
                                    {{ $page->title }}
                                </h4>
                                <div class="single-blog-content-top py-3">
                                    {!! $page->body !!}
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