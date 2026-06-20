@extends('layouts.app')

@section('title', 'Login - SPK Jurusan SMK Babussalam')

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
    position: relative;
    overflow: hidden;
  }

  .login-shell::before,
  .login-shell::after {
    content: '';
    position: absolute;
    border-radius: 50%;
    background: rgba(99, 102, 241, 0.18);
    filter: blur(36px);
    z-index: 1;
  }

  .login-shell::before {
    width: 320px;
    height: 320px;
    top: -80px;
    right: -80px;
  }

  .login-shell::after {
    width: 240px;
    height: 240px;
    bottom: -60px;
    left: 50px;
  }

  .login-panel {
    position: relative;
    z-index: 2;
    display: grid;
    grid-template-columns: 1fr;
    gap: 2rem;
    width: 100%;
    max-width: 980px;
  }

  .login-card {
    background: rgba(255, 255, 255, 0.96);
    backdrop-filter: blur(18px);
    border-radius: 28px;
    border: 1px solid rgba(148, 163, 184, 0.18);
    box-shadow: 0 30px 90px rgba(15, 23, 42, 0.2);
    padding: 2rem;
    animation: slideUp 0.9s ease-out;
  }

  @keyframes slideUp {
    from {
      opacity: 0;
      transform: translateY(36px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .login-side {
    display: none;
    position: relative;
    overflow: hidden;
    border-radius: 28px;
    background: linear-gradient(180deg, #312e81 0%, #4338ca 100%);
    color: #f8fafc;
    padding: 2.5rem;
    min-height: 520px;
    box-shadow: 0 30px 90px rgba(15, 23, 42, 0.25);
  }

  .login-side::before {
    content: '';
    position: absolute;
    top: -50px;
    right: -50px;
    width: 220px;
    height: 220px;
    background: rgba(255, 255, 255, 0.12);
    border-radius: 50%;
  }

  .login-side::after {
    content: '';
    position: absolute;
    bottom: -40px;
    left: -40px;
    width: 160px;
    height: 160px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
  }

  .login-side h3 {
    font-size: 32px;
    line-height: 1.1;
    margin-bottom: 18px;
  }

  .login-side p {
    color: rgba(248, 250, 252, 0.8);
    line-height: 1.8;
    margin-bottom: 28px;
  }

  .feature-item {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 18px;
  }

  .feature-icon {
    width: 44px;
    height: 44px;
    border-radius: 14px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.14);
  }

  .feature-icon i {
    font-size: 1.1rem;
    color: #fff;
  }

  .feature-text {
    font-size: 15px;
    color: rgba(255, 255, 255, 0.92);
  }

  .login-logo-section {
    text-align: center;
    margin-bottom: 2rem;
  }

  .login-logo {
    width: 86px;
    height: 86px;
    border-radius: 50%;
    background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 18px;
    box-shadow: 0 24px 60px rgba(37, 99, 235, 0.2);
  }

  .login-logo i {
    color: white;
    font-size: 36px;
  }

  .login-title {
    font-size: 30px;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 10px;
    letter-spacing: -0.04em;
  }

  .login-subtitle {
    font-size: 15px;
    color: #475569;
  }

  .login-form .form-group {
    margin-bottom: 18px;
  }

  .login-form label {
    display: block;
    font-weight: 700;
    color: #334155;
    margin-bottom: 8px;
    font-size: 14px;
  }

  .login-form .form-control {
    width: 100%;
    padding: 14px 18px;
    border: 1px solid rgba(148, 163, 184, 0.38);
    border-radius: 16px;
    font-size: 15px;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.94);
  }

  .login-form .form-control:focus {
    border-color: #4338ca;
    box-shadow: 0 0 0 4px rgba(67, 56, 202, 0.12);
    outline: none;
    background: white;
  }

  .login-form .form-control::placeholder {
    color: #94a3b8;
  }

  .login-form .form-control.is-invalid {
    border-color: #ef4444;
  }

  .login-form .form-control.is-invalid:focus {
    box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.14);
  }

  .invalid-feedback {
    color: #dc2626;
    font-size: 13px;
    margin-top: 6px;
    display: block;
  }

  .form-check {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
  }

  .form-check-input {
    width: 18px;
    height: 18px;
    margin-right: 10px;
    cursor: pointer;
    border: 2px solid rgba(148, 163, 184, 0.6);
    border-radius: 6px;
    transition: all 0.3s ease;
  }

  .form-check-input:checked {
    background-color: #2563eb;
    border-color: #2563eb;
  }

  .form-check-label {
    color: #334155;
    cursor: pointer;
    margin: 0;
    font-size: 14px;
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
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    box-shadow: 0 18px 40px rgba(37, 99, 235, 0.22);
  }

  .btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 22px 48px rgba(37, 99, 235, 0.26);
  }

  .btn-login:active {
    transform: translateY(0);
  }

  .btn-login:disabled {
    opacity: 0.75;
    cursor: not-allowed;
  }

  .btn-login .spinner {
    display: none;
    width: 16px;
    height: 16px;
    border: 2px solid rgba(255, 255, 255, 0.35);
    border-top-color: white;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
    margin-right: 10px;
    vertical-align: middle;
  }

  .btn-login.loading .spinner {
    display: inline-block;
  }

  .btn-login.loading span {
    display: none;
  }

  @keyframes spin {
    to { transform: rotate(360deg); }
  }

  .login-footer {
    text-align: center;
    margin-top: 20px;
    padding-top: 18px;
    border-top: 1px solid rgba(148, 163, 184, 0.2);
  }

  .login-footer a {
    color: #3730a3;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    transition: all 0.3s ease;
  }

  .login-footer a:hover {
    color: #4f46e5;
    text-decoration: underline;
  }

  .alert-login {
    border-radius: 14px;
    border: none;
    margin-bottom: 22px;
    animation: slideDown 0.5s ease-out;
  }

  @keyframes slideDown {
    from {
      opacity: 0;
      transform: translateY(-10px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .alert-success {
    background-color: #dcfce7;
    color: #166534;
  }

  .alert-danger {
    background-color: #fee2e2;
    color: #991b1b;
  }

  @media (min-width: 992px) {
    .login-panel {
      grid-template-columns: 1.05fr 0.95fr;
    }

    .login-side {
      display: block;
    }
  }

  @media (max-width: 768px) {
    .login-card {
      padding: 1.75rem;
    }

    .login-title {
      font-size: 26px;
    }

    .login-shell::before,
    .login-shell::after {
      display: none;
    }
  }
</style>

<div class="login-shell">
  <div class="login-panel">
    <div class="login-side">
      <div>
        <h3>Selamat datang di SPK Jurusan</h3>
        <p>Gabung sebagai Guru BK untuk mengatur siswa, kriteria, jurusan, dan melihat hasil rekomendasi dengan mudah.</p>
      </div>
      <div class="feature-item">
        <span class="feature-icon"><i class="ti ti-users"></i></span>
        <span class="feature-text">Kelola data siswa profesional</span>
      </div>
      <div class="feature-item">
        <span class="feature-icon"><i class="ti ti-list-details"></i></span>
        <span class="feature-text">Atur kriteria dengan bobot akurat</span>
      </div>
      <div class="feature-item">
        <span class="feature-icon"><i class="ti ti-printer"></i></span>
        <span class="feature-text">Cetak hasil rekomendasi kapanpun</span>
      </div>
      <div class="feature-item">
        <span class="feature-icon"><i class="ti ti-shield-check"></i></span>
        <span class="feature-text">Akses aman hanya untuk Guru BK</span>
      </div>
    </div>

    <div class="login-card">
      <div class="login-logo-section">
        <div class="login-logo">
          <i class="ti ti-shield-check"></i>
        </div>
        <h2 class="login-title">Masuk ke Akun</h2>
        <p class="login-subtitle">Gunakan email Guru BK dan kata sandi untuk melanjutkan.</p>
      </div>

      @if($errors->any())
        <div class="alert alert-danger alert-login">
          <strong>Login Gagal!</strong>
          <ul style="margin-bottom: 0; padding-left: 20px;">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      @if(session('success'))
        <div class="alert alert-success alert-login">
          {{ session('success') }}
        </div>
      @endif

      <form method="POST" action="{{ route('login.post') }}" class="login-form" id="loginForm">
        @csrf

        <div class="form-group">
          <label for="email">Email Guru BK</label>
          <input
            type="email"
            name="email"
            class="form-control @error('email') is-invalid @enderror"
            id="email"
            value="{{ old('email') }}"
            placeholder="guru_bk@smkbabussalam.sch.id"
            required
            autofocus>
          @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
          <label for="password">Kata Sandi</label>
          <input
            type="password"
            name="password"
            class="form-control @error('password') is-invalid @enderror"
            id="password"
            placeholder="Masukkan kata sandi Anda"
            required>
          @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="btn-login" id="loginBtn">
          <span class="spinner"></span>
          <span>Login</span>
        </button>

        <div class="login-footer">
          <a href="{{ route('password.request') }}">Lupa Kata Sandi?</a>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  document.getElementById('loginForm').addEventListener('submit', function() {
    const btn = document.getElementById('loginBtn');
    btn.classList.add('loading');
    btn.disabled = true;
  });

  const alerts = document.querySelectorAll('.alert-login');
  alerts.forEach(alert => {
    setTimeout(() => {
      alert.style.transition = 'opacity 0.5s ease';
      alert.style.opacity = '0';
      setTimeout(() => alert.remove(), 500);
    }, 5000);
  });
</script>
@endsection
