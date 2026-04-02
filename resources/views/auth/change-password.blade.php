@extends('layouts.app')

@section('title', 'Ubah Kata Sandi - SPK Jurusan SMK Babussalam')

@section('content')
<section class="py-5" style="min-height: 100vh; background: linear-gradient(135deg, #4161c2, #28b3c0);">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-lg border-0">
          <div class="card-body">
            <h4 class="card-title text-center mb-4">Ubah Kata Sandi</h4>
            @if(session('success'))
              <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form method="POST" action="{{ route('password.change.post') }}">
              @csrf
              <div class="mb-3">
                <label for="current_password" class="form-label">Kata Sandi Saat Ini</label>
                <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" required>
                @error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Kata Sandi Baru</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" required>
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
              <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
              </div>
              <button type="submit" class="btn btn-success w-100">Simpan</button>
              <div class="mt-3 text-center">
                <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Kembali ke Dashboard</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
