@extends('layout.main')
@section('title', 'Register User')

@section('container')
    <div class="container">
        <div class="mx-lg-5 mt-lg-5 mb-lg-3">
            <div class="rounded bg-info pt-3 pb-3">
                <h2 class="text-center fw-bold mt-2">PRODUCTS</h2>
                <div class="mt-3 bg-dark mx-auto rounded" style="height: 3px;width: 75px"></div>
                    <div class="grid mx-3 mt-4">
                        <div class="row row-gap-4">
                            @foreach ($list as $item)
                                <div class="col-3">
                                    <div class="card bg-white w-100">
                                        <img class="rounded" src="{{ $item['image'] }}">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <p class="card-title fw-bold my-auto" style="font-size: 24px">{{ $item['namaProduct'] }}
                                                </p>
                                                <p class="my-auto rounded bg-success px-2 py-1 fw-semibold" style="font-size: 16px">
                                                    {{ $item['kondisi'] }}
                                                </p>
                                            </div>
                                            <div class="d-flex justify-content-between mt-2">
                                                <p class="my-auto rounded bg-warning px-2 py-1 fw-semibold" style="font-size: 16px">
                                                    {{ $item['stok'] }}
                                                </p>
                                                <p class="my-auto rounded bg-info px-2 py-1 fw-semibold" style="font-size: 16px">Rp.
                                                    {{ number_format($item['harga'], 0, ',', '.') }}
                                                </p>
                                            </div>
                                            <p class=""
                                                style="overflow: hidden;max-width: 400px; display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical; margin: 20px auto;">
                                                {{ $item['deskripsi'] }}
                                            </p>
                                            <button class="btn btn-primary w-100">Pesan Sekarang</button>
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