@extends('layouts.landing')

@section('content')
<!--home section start-->
<section class="section-py-space mt-0 pt-0" style="min-height: 100vh;">
    <div class="w-100 my-5"
        style="padding-top: 100px !important; background-image: url({{ asset('images/1.jpg') }}); background-position: center; background-size: cover; background-attachment: fixed;">
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <h2 class="fw-bold h1">Jurnal</h2>
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
            @if ($jurnal->count() > 0)
                @foreach ($jurnal as $item)
                <div class="col-sm-6 col-md-4">
                    <div class="card">
                        <div class="blog-box blog-grid">
                            <div class="blog-wrraper">
                                <a href="{{ route('landing-pages.jurnal.detail', $item) }}">
                                    <img class="img-fluid top-radius-blog" src="{{ asset('storage/' . $item->thumbnail) }}"
                                        alt=""></a>
                            </div>
                            <div class="blog-details-second">
                                <div class="blog-post-date">
                                    <span class="blg-month">{{ strtoupper(date('M', strtotime($item->tanggal_publish))) }}</span>
                                    <span class="blg-date">{{ date('d', strtotime($item->tanggal_publish)) }}</span>
                                </div>
                                <a href="{{ route('landing-pages.jurnal.detail', $item) }}">
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
            @else
                <div class="col">
                    <p>Maaf, data yang Anda cari tidak ditemukan.</p>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col py-4">
                {{ $jurnal->links() }}
            </div>
        </div>
    </div>
    
</section>
<!--home section end-->
@endsection