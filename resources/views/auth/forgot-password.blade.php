@extends('layouts.app')

@section('title', 'Lupa Kata Sandi - SPK Jurusan SMK Babussalam')

@section('content')
<style>
  body {
    margin: 0;
    padding: 0;
    background: #0f172a;
  }

  .login-shell {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
  }

  .login-card {
    width: 100%;
    max-width: 460px;
    background: rgba(255, 255, 255, 0.96);
    border-radius: 24px;
    padding: 2rem;
    box-shadow: 0 30px 90px rgba(15, 23, 42, 0.2);
  }

  .login-title {
    font-size: 28px;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 10px;
    text-align: center;
  }

  .login-subtitle {
    font-size: 14px;
    color: #475569;
    text-align: center;
    margin-bottom: 1.5rem;
  }

  .form-group {
    margin-bottom: 18px;
  }

  label {
    display: block;
    font-weight: 700;
    color: #334155;
    margin-bottom: 8px;
    font-size: 14px;
  }

  .form-control {
    width: 100%;
    padding: 14px 18px;
    border: 1px solid rgba(148, 163, 184, 0.38);
    border-radius: 16px;
    font-size: 15px;
  }

  .btn-login {
    width: 100%;
    padding: 14px 18px;
    background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%);
    color: white;
    border: none;
    border-radius: 16px;
    font-size: 16px;
    font-weight: 700;
  }

  .btn-back {
    display: inline-block;
    width: 100%;
    text-align: center;
    margin-top: 12px;
    color: #3730a3;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
  }

  .btn-back:hover {
    text-decoration: underline;
  }

  .alert {
    border-radius: 14px;
    margin-bottom: 16px;
  }

  .alert-success {
    background-color: #dcfce7;
    color: #166534;
  }

  .alert-danger {
    background-color: #fee2e2;
    color: #991b1b;
  }
</style>

<div class="login-shell">
  <div class="login-card">
    <h2 class="login-title">Lupa Kata Sandi</h2>
    <p class="login-subtitle">Masukkan email Anda, lalu kata sandi akan direset ke password.</p>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
      <div class="alert alert-danger">
        <ul style="margin-bottom: 0; padding-left: 20px;">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
      @csrf
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
      </div>
      <button type="submit" class="btn-login">Reset Kata Sandi</button>
      <a href="{{ route('login') }}" class="btn-back">Kembali ke Login</a>
    </form>
  </div>
</div>
@endsection
