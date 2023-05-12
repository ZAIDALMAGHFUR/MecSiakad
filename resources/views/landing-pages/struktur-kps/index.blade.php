@extends('layouts.landing')

@section('content')
<div class="container" style="padding-top: 150px; min-height: 100vh;">
    <div class="row">
        <div class="col">
            <div class="blog-single">
                <div class="blog-box blog-details">
                    <div class="card">
                        <div class="card-body">
                            <div class="blog-details">
                                <h2 class="text-center fw-bold">
                                    Struktur Kepemimpinan
                                </h2>
                                <hr>
                                <div>
                                    <table class="table table-borderless w-100">
                                        <tbody>
                                            @foreach ($jabatans as $jabatan)
                                            @php
                                            $strukturKps_ = $strukturKps->where('jabatan_id', $jabatan->id);
                                            @endphp

                                            @if ($strukturKps_->isNotEmpty())

                                            <tr>
                                                <td class="fw-bold text-center"
                                                    colspan="{{ $strukturKps_->count() + 1 }}">
                                                    <div class="badge badge-primary">
                                                        {{ strtoupper($jabatan->name) }}
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="row justify-content-center">
                                                        @foreach ($strukturKps_ as $item)
                                                        <div class="col-md-4">
                                                            <div class="card border mx-auto shadow"
                                                                style="width: 15rem; border-radius: 10px; overflow: hidden;">
                                                                <img src="{{ asset('storage/' .
                                                                        $item->pas_foto) }}" class="card-img-top">
                                                                <div class="card-body py-2 px-3 text-center">
                                                                    <h6 class="card-title fw-bold">{{
                                                                        $item->name
                                                                        }}</h6>
                                                                    @if ($item->description)
                                                                    <p class="card-text p-2">
                                                                        {!! nl2br($item->description) !!}
                                                                    </p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            {{-- <div
                                                                class="d-flex align-items-center justify-content-center flex-column">
                                                                <img src="{{ asset('storage/' . $item->pas_foto) }}"
                                                                    alt="" class="img-thumbnail d-block" width="70" />
                                                                <span class="mt-2 fw-bold text-center d-block">{{
                                                                    $item->name
                                                                    }}</span>
                                                                @if ($item->description)
                                                                <p class="text-muted">
                                                                    {!! nl2br($item->description) !!}
                                                                </p>
                                                                @endif

                                                            </div> --}}
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </td>
                                            </tr>
                                            @endif

                                            @endforeach
                                        </tbody>
                                    </table>
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