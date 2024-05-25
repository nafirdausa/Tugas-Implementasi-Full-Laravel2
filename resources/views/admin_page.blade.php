@extends('layout.main')
@section('container')

    <div class="container mt-lg-4 mb-lg-3">
        <div class="row bg-info rounded px-3 py-3 w-100">
            <div class="d-flex justify-content-between">
                <h2 class="fw-semibold">List Product</h2>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('get_profile') }}" class="btn btn-md btn-primary fw-bold my-auto me-1">Lihat
                        Profil</a>
                    <a href="{{ route('form_product') }}" class="btn btn-md btn-dark fw-bold my-auto me-1">Tambah
                        Produk</a>
                    <button data-bs-toggle="modal" data-bs-target="#exampleModal"
                        class="btn btn-md btn-success fw-bold my-auto me-1">Import
                        Produk</button>
                    <a href="{{ route('product.export') }}" class="btn btn-md btn-warning fw-bold my-auto">Eksport
                    {{-- <a href="{{ route('exportData') }}" class="btn btn-md btn-warning fw-bold my-auto">Eksport --}}
                        Produk</a>
                </div>
            </div>
            <table class="table table-striped w-100 mt-3" id="datatable">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col" class="text-center">Nama</th>
                        <th scope="col" class="text-center">Stok</th>
                        <th scope="col" class="text-center">Berat</th>
                        <th scope="col" class="text-center">Harga</th>
                        <th scope="col" class="text-center">Kondisi</th>
                        <th scope="col" class="text-center" style="width: 150px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $product->name }}</td>
                            <td class="text-center">{{ $product->stock }}</td>
                            <td class="text-center">{{ $product->weight }}</td>
                            <td class="text-center">Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                            @if ($product->condition == 'Baru')
                                <td class="text-center"><div
                                        class="rounded px-3 py-1 bg-success w-50 mx-auto">{{ $product->condition }}</div></td>
                            @else
                                <td class="text-center"><div
                                        class="rounded px-3 py-1 bg-dark text-white w-50 mx-auto">{{ $product->condition }}</div></td>
                            @endif
                            <td class="d-flex">
                                <a href="{{ route('edit_product', ['product' => $product->id]) }}"
                                    class="btn btn-warning btn-md">Update</a>
                                <form action="{{ route('delete_product', ['product' => $product->id]) }}" method="POST"
                                    class="ms-1">
                                    @csrf()
                                    <button class="btn btn-md btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Data Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('product.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <a href="{{ url('/templates/dummy_products.csv') }}">Klik untuk mengunduh template import</a>
                    <p class="font-weight-bold">Data Excel</p>
                    <input type="file" class="form-control" id="import_csv" name="import_csv" accept=".csv">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
            </div>
        </div>
        </div>
    </div>

   
@endsection
