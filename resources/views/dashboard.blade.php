@extends('layout.main')

@section('container')
<div class="col-md-4 offset-4 rounded border border-dark">
    <h3 class="fw-bold text-center mb-3 mt-3">Halaman Dashboard User {{ $user->id }}</h3>
    <div class="d-flex justify-content-between px-3">
        <div class="w-50">
            <p class="fw-bold">Nama Akun</p>
            <p class="fw-bold">Email</p>
            <p class="fw-bold">Gender</p>
            <p class="fw-bold">Umur</p>
            <p class="fw-bold">Tanggal Lahir</p>
            <p class="fw-bold">Alamat</p>
        </div>
        <div>
            <p>{{ $user->name }}</p>
            <p>{{ $user->email }}</p>
            <p>{{ $user->gender }}</p>
            <p>{{ $user->age }}</p>
            <p>{{ $user->birth }}</p>
            <p>{{ $user->alamat }}</p>
        </div>
    </div>
    {{-- <div class="d-flex justify-content-center mb-3">
        <a href="{{ route('exportDashboard') }}" class="btn btn-info me-2">Export Data</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf()
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div> --}}
</div>
@endsection