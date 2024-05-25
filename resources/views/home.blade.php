@extends('layout.main')

@section('container')

<div class="row">
    <div class="col d-flex align-items-center">
        <div>
            <h5>Discover. Connect. Thrive</h5>
            <h1 class="fw-bold">Transform Your Shopping Experience</h1>
            <p>Welcome to Amandemy Shopping, where your desire meet their perfect match. Immerse yourself in a world of endless possibilities, curated just for you. Whether you're hunting for unique finds, everyday essentials, or extraordinary gifts, we've got you covered.</p>
            <a href="{{ route('product') }}">
                <button class="btn bg-info fw-bold">Buy Now!</button>
            </a>
        </div>
    </div>
    <div class="col">
        <img src="{{ asset('images/img-home.jpg') }}" alt="gambar online shopping" width="80%">
    </div>
</div>

@endsection