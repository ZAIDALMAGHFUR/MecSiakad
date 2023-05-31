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
                  @for ($h = 0; $h < $hierarchies; $h++)
                    <div class="mt-5 mb-5 pt-5 pb-5">
                      <div class="row justify-content-center">
                        @foreach ($structures[$h] as $item)
                          <div class="col-md">
                            <div class="card border mx-auto shadow"
                              style="width: 100%; border-radius: 10px; overflow: hidden;">
                              <div class="card-body py2- px-3 text-center">
                                <h6 class="card-title fw-bold">{{ $item['name'] }}</h6>
                                <p class="card-text p-2">
                                  <a class="" data-bs-toggle="modal"
                                    data-bs-target="#modalDetailPeople{{ $item['struktur_kepemimpinan'] == null ? null : $item['struktur_kepemimpinan'][0]['id'] }}">
                                    {{ $item['struktur_kepemimpinan'] == null ? null : $item['struktur_kepemimpinan'][0]['name'] }}
                                  </a>
                                </p>

                                <!-- Modal -->
                                <div class="modal fade"
                                  id="modalDetailPeople{{ $item['struktur_kepemimpinan'] == null ? null : $item['struktur_kepemimpinan'][0]['id'] }}"
                                  tabindex="-1"
                                  aria-labelledby="modalDetailPeople{{ $item['struktur_kepemimpinan'] == null ? null : $item['struktur_kepemimpinan'][0]['id'] }}Label"
                                  aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Deskription</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                          aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        <img
                                          src="{{ asset('storage/' . ($item['struktur_kepemimpinan'] == null ? null : $item['struktur_kepemimpinan'][0]['pas_foto'])) }}"
                                          class="rounded mx-auto d-block w-100 p-3" alt="...">

                                        <h5>Nama :
                                          {{ $item['struktur_kepemimpinan'] == null ? null : $item['struktur_kepemimpinan'][0]['name'] }}
                                        </h5>
                                        <p>Deskripsi :
                                          {{ $item['struktur_kepemimpinan'] == null ? null : $item['struktur_kepemimpinan'][0]['description'] }}
                                        </p>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                          data-bs-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                @if (count($item['struktur_kepemimpinan']) > 1)
                                  <button class="btn btn-ghost" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseExample{{ $item['struktur_kepemimpinan'] == null ? null : $item['struktur_kepemimpinan'][0]['id'] }}"
                                    aria-expanded="true"
                                    aria-controls="collapseExample{{ $item['struktur_kepemimpinan'] == null ? null : $item['struktur_kepemimpinan'][0]['id'] }}">
                                    ^
                                  </button>

                                  <div class="collapse"
                                    id="collapseExample{{ $item['struktur_kepemimpinan'] == null ? null : $item['struktur_kepemimpinan'][0]['id'] }}">
                                    <div class="card card-body">
                                      @foreach ($item['struktur_kepemimpinan'] as $people)
                                        <a class="" data-bs-toggle="modal"
                                          data-bs-target="#modalDetailPeoplee{{ $people['id'] }}">
                                          {{ $people['name'] }}
                                        </a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="modalDetailPeoplee{{ $people['id'] }}" tabindex="-1"
                                          aria-labelledby="modalDetailPeoplee{{ $people['id'] }}Label"
                                          aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Deskription</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                  aria-label="Close"></button>
                                              </div>
                                              <div class="modal-body">
                                                <img src="{{ asset('storage/' . $people['pas_foto']) }}"
                                                  class="rounded mx-auto d-block w-100 p-3" alt="...">
                                                <h5>Nama : {{ $people['name'] }}</h5>
                                                <p>Deskripsi : {{ $people['description'] }}</p>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                  data-bs-dismiss="modal">Close</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      @endforeach
                                    </div>
                                  </div>
                                @endif
                              </div>

                            </div>
                          </div>
                        @endforeach
                      </div>
                    </div>
                  @endfor
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
