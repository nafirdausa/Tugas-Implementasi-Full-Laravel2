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
            <h2 class="text-center fw-bold" style="font-size: 20px">Tambah Data Produk</h2>
            <form class="mt-3" action="{{ route('postRequest') }}" method="POST" enctype="multipart/form-data">
                @csrf()
                <div class="mb-1">
                    <label for="exampleFormControlInput1" class="form-label fw-semibold">Gambar Produk</label>
                    <input type="file" class="form-control" name="image" id="image" placeholder="Masukkan gambar produk" value="{{ old('image') }}">
                    @error('image')
                        <div id="imageError" class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-1">
                    <label for="exampleFormControlInput1" class="form-label fw-semibold">Nama Produk</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan nama produk" value="{{ old('name') }}">
                    @error('name')
                        <div id="nameError" class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-1">
                    <label for="exampleFormControlInput1" class="form-label fw-semibold">Berat</label>
                    <input type="number" class="form-control" name="weight" id="weight" placeholder="Masukkan berat produk" value="{{ old('weight') }}">
                    @error('weight')
                        <div id="weightError" class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-1">
                    <label for="price" class="form-label fw-semibold">price</label>
                    <input type="number" class="form-control form-control-sm" placeholder="Masukkan price produk" name="price" id="price" value="{{ old('price') }}">
                    @error('price')
                        <div id="priceError" class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-1">
                    <label for="exampleFormControlInput1" class="form-label fw-semibold">Stok</label>
                    <input type="number" class="form-control" name="stock" id="stock" placeholder="Masukkan stok produk" value="{{ old('stock') }}">
                    @error('stock')
                        <div id="stockError" class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-1">
                    <label for="exampleFormControlInput1" class="form-label fw-semibold">Kondisi</label>
                    <select class="form-select form-control" aria-label="Default select example" name="condition">
                        <option value="0" {{ old('condition') == '0' ? 'selected' : '' }}>Pilih Kondisi Barang</option>
                        <option value="Bekas" {{ old('condition') == 'Bekas' ? 'selected' : '' }}>Bekas</option>
                        <option value="Baru" {{ old('condition') == 'Baru' ? 'selected' : '' }}>Baru</option>
                    </select>
                    @error('condition')
                        <div id="conditionError" class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label fw-semibold">Deskripsi</label>
                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="Tuliskan deskripsi produk yang akan dijual">{{ old('description') }}</textarea>
                    @error('description')
                        <div id="descriptionError" class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex">
                    <button class="btn btn-dark mx-auto" id="formId" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection