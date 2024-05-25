@extends('layout.main')
@section('title', 'Register User')

@section('container')
<div class="row justify-content-center mt-5">
    <div class="col-md-4 border p-4 rounded">
        <h1 class="h3 mb-3 fw-bold text-center">Halaman Register User</h1>

         <!-- error message -->
         @if (session('error'))
         <div class="alert alert-danger">{{ session('error') }}</div>
     @endif

     <!-- success message -->
     @if (session('success'))
         <div class="alert alert-success">{{ session('success') }}</div>
     @endif

     <form action="{{ route('register_user') }}" method="POST">
         @csrf

         <div class="form-group mb-3">
             <label for="name">Nama Lengkap</label>
             <input type="text" name="name" id="name" class="form-control"
                 placeholder="Masukan Nama Lengkap Kamu" required>
             @error('name')
                 <div class="text-danger mt-2">{{ $message }}</div>
             @enderror
         </div>

         <div class="form-group mb-3">
             <label for="email">Email Address</label>
             <input type="email" name="email" id="email" class="form-control"
                 placeholder="Masukan Email Kamu" required>
             @error('email')
                 <div class="text-danger mt-2">{{ $message }}</div>
             @enderror
         </div>

         <div class="form-group mb-3">
             <label for="password">Password</label>
             <input type="password" name="password" id="password" class="form-control"
                 placeholder="Masukan Password Kamu" required>
             @error('password')
                 <div class="text-danger mt-2">{{ $message }}</div>
             @enderror
         </div>

         <div class="form-group mb-3">
             <label for="password_confirmation">Konfirmasi Password</label>
             <input type="password" name="password_confirmation" id="password_confirmation"
                 class="form-control" placeholder="Masukan Konfirmasi Password Kamu" required>
             @error('password_confirmation')
                 <div class="text-danger mt-2">{{ $message }}</div>
             @enderror
         </div>

         <div class="form-group mb-3">
             <label for="role">Role</label>
             <select name="role" class="form-select" required>
                 <option value="">Select role</option>
                 <option value="superadmin">superadmin</option>
                 <option value="user">user</option>
             </select>
             @error('role')
                 <div class="text-danger mt-2">{{ $message }}</div>
             @enderror
         </div>

         <div class="form-group mb-3">
             <label for="gender">Jenis Kelamin</label>
             <select name="gender" class="form-select" required>
                 <option value="">Pilih Jenis Kelamin</option>
                 <option value="male">Male</option>
                 <option value="female">Female</option>
             </select>
             @error('gender')
                 <div class="text-danger mt-2">{{ $message }}</div>
             @enderror
         </div>

         <div class="form-group mb-3">
             <label for="age">Umur</label>
             <input type="number" name="age" id="age" class="form-control"
                 placeholder="Masukan Umur Kamu" required>
             @error('age')
                 <div class="text-danger mt-2">{{ $message }}</div>
             @enderror
         </div>

         <div class="form-group mb-3">
             <label for="birth">Tanggal Lahir</label>
             <input type="date" name="birth" id="birth" class="form-control" required>
             @error('birth')
                 <div class="text-danger mt-2">{{ $message }}</div>
             @enderror
         </div>

         <div class="form-group mb-3">
             <label for="address">Alamat</label>
             <textarea name="address" id="address" class="form-control" placeholder="Masukan Alamat Kamu" required></textarea>
             @error('address')
                 <div class="text-danger mt-2">{{ $message }}</div>
             @enderror
         </div>
         <div class="text-center">
             <button type="submit" class=" btn btn-success">Submit</button>
         </div>
    </form>

    </div>
</div>
@endsection