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
                            @foreach ($products as $item)
                                <div class="col-3">
                                    <div class="card bg-white w-100">
                                        @if($item->image)
                                        <img class="rounded" src="{{ Storage::url($item->image) }}">
                                        @else
                                        <p>Tidak ada gambar product</p>
                                        @endif
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between my-2">
                                                <p class="card-title fw-bold my-auto" style="font-size: 24px">
                                                    {{ $item->name }}
                                                </p>
                                                @if ($item->condition == 'Baru')
                                                    <p class="my-auto rounded py-1 bg-success px-2 fw-semibold"
                                                        style="font-size: 16px">{{ $item->condition }}
                                                    </p>
                                                @else
                                                    <p class="my-auto rounded py-1 bg-warning px-2 fw-semibold"
                                                        style="font-size: 16px">{{ $item->condition }}
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="d-flex justify-content-between my-2">
                                                <p class="my-auto rounded py-1 bg-success px-2 text-white fw-semibold"
                                                    style="font-size: 16px">{{ $item->stock }}
                                                </p>
                                                <p class="my-auto rounded py-1 bg-info px-2 fw-semibold"
                                                    style="font-size: 16px">Rp.
                                                    {{ number_format($item->price, 0, ',', '.') }}
                                                </p>
                                                <p class="my-auto rounded py-1 bg-secondary text-white px-2 fw-semibold"
                                                    style="font-size: 16px">{{ $item->weight }} gr
                                                </p>
                                            </div>
                                            <p class=""
                                                style="overflow: hidden;max-width: 400px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; margin: 10px auto;">
                                                {{ $item->description }}
                                            </p>
                                            <a href="{{ route('detail_product', $item->id)}}">
                                                <button class="btn btn-primary w-100">Pesan Sekarang</button>
                                            </a>
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