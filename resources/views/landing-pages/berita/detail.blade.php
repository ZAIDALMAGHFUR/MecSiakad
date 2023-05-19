@extends('layouts.landing')

@section('content')
<div class="container" style="padding-top: 150px; min-height: 100vh;">
    <div class="row mb-3">
        <div class="col">
            <a href="{{ route('landing-pages.berita') }}" class="btn btn-outline-secondary">Kembali</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="blog-single">
                <div class="blog-box blog-details">
                    <div class="banner-wrraper"><img class="img-fluid w-100 bg-img-cover"
                            src="{{ asset('storage/'. $berita->thumbnail) }}" alt="blog-main"></div>
                    <div class="card">
                        <div class="card-body">
                            <div class="blog-details">
                                <ul class="blog-social">
                                    <li>{{ $berita->tanggal_publish}}</li>
                                    <li>
                                        <a
                                            href="{{ route('landing-pages.berita', ['category' => $berita->category]) }}">{{
                                            $berita->category }}</a>
                                    </li>
                                    <li>
                                        @if ($berita->tags)
                                        @foreach ($berita->tags as $tag)
                                        <a href="{{ route('landing-pages.berita', ['tag' => $tag]) }}"
                                            class="text-secondary">#{{ $tag }}</a>
                                        @endforeach
                                        @endif
                                    </li>
                                </ul>
                                <h4>
                                    {{ $berita->title }}
                                </h4>
                                <div class="single-blog-content-top py-3">
                                    {!! $berita->body !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col">
                    <h4>Berita Terbaru</h4>
                    <hr>
                    @foreach ($lastBerita as $item)
                    <div class="card">
                        <div class="blog-box blog-grid">
                            <div class="blog-wrraper">
                                <a href="{{ route('landing-pages.berita.detail', $item) }}">
                                    <img class="img-fluid top-radius-blog"
                                        src="{{ asset('storage/' . $item->thumbnail) }}" alt=""></a>
                            </div>
                            <div class="blog-details-second">
                                <div class="blog-post-date">
                                    <span class="blg-month">{{ strtoupper(date('M', strtotime($item->tanggal_publish))) }}</span>
                                    <span class="blg-date">{{ date('d', strtotime($item->tanggal_publish)) }}</span>
                                </div><a href="{{ route('landing-pages.berita.detail', $item) }}">
                                    <h6 class="blog-bottom-details">{{ $item->title }}</h6>
                                </a>
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
                    @endforeach

                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h4>Related Berita</h4>
                    <hr>
                    @foreach ($sameByCategoryBerita as $item)
                    <div class="card">
                        <div class="blog-box blog-grid">
                            <div class="blog-wrraper">
                                <a href="{{ route('landing-pages.berita.detail', $item) }}">
                                    <img class="img-fluid top-radius-blog"
                                        src="{{ asset('storage/' . $item->thumbnail) }}" alt=""></a>
                            </div>
                            <div class="blog-details-second">
                                <div class="blog-post-date"><span class="blg-month">{{
                                        strtoupper($item->created_at->format('M')) }}</span><span class="blg-date">{{
                                        $item->created_at->format('d') }}</span>
                                </div><a href="{{ route('landing-pages.berita.detail', $item) }}">
                                    <h6 class="blog-bottom-details">{{ $item->title }}</h6>
                                </a>
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
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection