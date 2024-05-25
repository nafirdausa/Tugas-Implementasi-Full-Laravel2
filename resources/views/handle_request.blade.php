@extends('layout.main')
@section('container')
<div class="container">
    <div class="row">
        <div class="col-md-4 offset-4 rounded bg-info mt-3 py-3">
            <h2 class="text-center fw-bold" style="font-size: 20px">Tambah Data Produk</h2>
            <form class="mt-3" action="{{ route('postRequest') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-1">
                    <label for="exampleFormControlInput1" class="form-label fw-semibold">Gambar Produk</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                        placeholder="Masukkan gambar produk" value="{{ old('image') }}">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-1">
                    <label for="exampleFormControlInput1" class="form-label fw-semibold">Nama Produk</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                        placeholder="Masukkan nama produk" value="{{ old('nama') }}">
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-1">
                    <label for="exampleFormControlInput1" class="form-label fw-semibold">Berat</label>
                    <input type="number" class="form-control @error('berat') is-invalid @enderror" name="berat"
                        placeholder="Masukkan berat produk" value="{{ old('berat') }}">
                    @error('berat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-1">
                    <label for="exampleFormControlInput1" class="form-label fw-semibold">Harga</label>
                    <input type="number" class="form-control @error('harga') is-invalid @enderror" name="harga"
                        placeholder="Masukkan harga produk" value="{{ old('harga') }}">
                    @error('harga')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-1">
                    <label for="exampleFormControlInput1" class="form-label fw-semibold">Stok</label>
                    <input type="number" class="form-control @error('stok') is-invalid @enderror" name="stok"
                        placeholder="Masukkan stok produk" value="{{ old('stok') }}">
                    @error('stok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-1">
                    <label for="exampleFormControlInput1" class="form-label fw-semibold">Kondisi</label>
                    <select class="form-select form-control @error('kondisi') is-invalid @enderror"
                        aria-label="Default select example" name="kondisi">
                        <option selected value="0">Pilih Kondisi Barang</option>
                        <option value="Bekas" @if (old('kondisi') == 'Bekas') selected @endif>Bekas</option>
                        <option value="Baru" @if (old('kondisi') == 'Baru') selected @endif>Baru</option>
                    </select>
                    @error('kondisi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label fw-semibold">Deskripsi</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi"
                        id="exampleFormControlTextarea1" rows="3" placeholder="Tuliskan deskripsi produk yang akan dijual">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-center ">
                    <a href="{{ route('admin_page') }}" class="btn btn-warning" type="submit">Kembali</a>
                    <button class="btn btn-dark ms-2" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection