@extends('layout.main')
@section('container')
<div class="container">
    @if (Session::get('error'))
        <div class="row">
            <div class="col-md-4 offset-4 mt-2 py-2 rounded bg-danger text-white fw-bold">
                {{ Session::get('error') }}
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-4 offset-4 rounded bg-info mt-3 py-3">
            <h2 class="text-center fw-bold" style="font-size: 20px">Edit Data Produk {{ $product->id }}</h2>
            <form class="mt-3" action="{{ route('update_product', ['product' => $product->id, 'user' => $user->id]) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="mb-1">
                    <label for="exampleFormControlInput1" class="form-label fw-semibold">Gambar Produk</label>
                    <input type="text" class="form-control" name="image" placeholder="Masukkan gambar produk"
                        value="{{ $product->image }}">
                </div>
                <div class="mb-1">
                    <label for="exampleFormControlInput1" class="form-label fw-semibold">Nama Produk</label>
                    <input type="text" class="form-control" name="name"
                        placeholder="Masukkan nama produk"value="{{ $product->name }}">
                </div>
                <div class="mb-1">
                    <label for="exampleFormControlInput1" class="form-label fw-semibold">Berat</label>
                    <input type="number" class="form-control" name="weight"
                        placeholder="Masukkan berat produk"value="{{ $product->weight }}">
                </div>
                <div class="mb-1">
                    <label for="exampleFormControlInput1" class="form-label fw-semibold">Harga</label>
                    <input type="number" class="form-control" name="price"
                        placeholder="Masukkan harga produk"value="{{ $product->price }}">
                </div>
                <div class="mb-1">
                    <label for="exampleFormControlInput1" class="form-label fw-semibold">Stok</label>
                    <input type="number" class="form-control" name="stock"
                        placeholder="Masukkan stok produk"value="{{ $product->stock }}">
                </div>
                <div class="mb-1">
                    <label for="exampleFormControlInput1" class="form-label fw-semibold">Kondisi</label>
                    <select class="form-select form-control" aria-label="Default select example" name="condition">
                        <option value="Bekas" {{ $product->condition == 'Bekas' ? 'Seleted' : '' }}>Bekas</option>
                        <option value="Baru" {{ $product->condition == 'Baru' ? 'Seleted' : '' }}>Baru</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label fw-semibold">Deskripsi</label>
                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"
                        placeholder="Tuliskan deskripsi produk yang akan dijual">{{ $product->description }}</textarea>
                </div>
                <div class="d-flex">
                    <button class="btn btn-dark mx-auto" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection