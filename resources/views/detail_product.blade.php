@extends('layout.main')
@section('container')
@if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
@endif
<div class="row justify-content-center container ms-5 mt-5">
    <div class="col-md-9 border rounded-2 border-black">
        <h1 class="text-center fw-bold fs-4 mt-2 mb-3">Detail Produk</h1>
        <div class="d-flex m-3">
            @foreach ($products as $item)
                <div class="img">
                    @if($item->image)
                    <img class="rounded" src="{{ Storage::url($item->image) }}" width="450px">
                    @else
                    <p>Tidak ada gambar product</p>
                    @endif
                </div>
                <div class="detail ms-3 mt-3 " style="width: 500px">
                    <h3 class="fw-bold fs-4">{{ $item->name }}</h3>
                    <div class="d-flex justify-content-between">
                        <P class="mb-1 ">Stok: {{ $item->stock }}</P>
                        <p class="my-auto rounded py-1 bg-info px-2 fw-semibold"
                            style="font-size: 16px">Rp.
                            {{ number_format($item->price, 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <P class="mb-1">Kondisi: {{ $item->condition }}</P>
                        <p class="mb-1">{{ $item->weight }} gr</p>
                    </div>
                    <p style="text-align: justify">{{ $item->description }}</p>
                    <div class="text-center">
                        <a href="{{ route('detail_transaksi', ['id' => $item->id]) }}" class="btn btn-dark fw-semibold">Checkout</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection