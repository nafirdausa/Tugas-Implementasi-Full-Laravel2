@extends('layout.main')
@section('title', 'Login User')

@section('container')
<div class="row justify-content-center mt-1">
    <div class="col-md-4 border p-4 rounded">
        <h1 class="h3 mb-3 fw-bold text-center">Halaman Login Pengguna</h1>

        <!-- error message -->
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- success message -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('login_user') }}" method="POST">
            @csrf

           <div class="form-group mb-3">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Masukan Email Kamu" required>
                @error('email')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Masukan Password Kamu" required>
                @error('password')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <p>Belum Punya Akun? <a href="{{route('register')}}" class="fw-bold">Daftar Sekarang</a> </p>
            </div>
            <div class="text-center">
                <button type="submit " class="btn btn-lg btn-success">Submit</button>
            </div>
            <p class="text-center mt-2">atau</p>
            <div class="text-center">
                <a href="" class="btn btn-lg btn-info">Login with Google</a>
            </div>
        </form>
    </div>
</div>
@endsection