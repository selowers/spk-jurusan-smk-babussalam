@extends('layouts.app')

@section('title', 'Login - SPK Jurusan SMK Babussalam')

@section('content')
<style>
  body {
    margin: 0;
    padding: 0;
  }

  .login-section {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
  }

  /* Animated Background */
  .login-background {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
    background: linear-gradient(-45deg, #1e3c72, #2a5298, #3b5998, #5f7df8);
    background-size: 400% 400%;
    animation: gradientShift 15s ease infinite;
  }

  @keyframes gradientShift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }

  /* Floating Shapes */
  .shape-1, .shape-2, .shape-3 {
    position: absolute;
    border-radius: 50%;
    opacity: 0.1;
    animation: float 20s ease-in-out infinite;
  }

  .shape-1 {
    width: 300px;
    height: 300px;
    background: white;
    top: -100px;
    left: 10%;
    animation: float 25s ease-in-out infinite;
  }

  .shape-2 {
    width: 200px;
    height: 200px;
    background: white;
    bottom: -50px;
    right: 15%;
    animation: float 30s ease-in-out infinite;
  }

  .shape-3 {
    width: 150px;
    height: 150px;
    background: white;
    top: 50%;
    right: 5%;
    animation: float 20s ease-in-out infinite;
  }

  @keyframes float {
    0%, 100% { transform: translateY(0px) translateX(0px); }
    25% { transform: translateY(-30px) translateX(15px); }
    50% { transform: translateY(-60px) translateX(-15px); }
    75% { transform: translateY(-30px) translateX(15px); }
  }

  /* Login Card */
  .login-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    padding: 50px;
    max-width: 450px;
    width: 100%;
    animation: slideUp 0.8s ease-out;
  }

  @keyframes slideUp {
    from {
      opacity: 0;
      transform: translateY(40px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  /* Logo Section */
  .login-logo-section {
    text-align: center;
    margin-bottom: 30px;
  }

  .login-logo {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, #1e3c72, #2a5298);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    box-shadow: 0 10px 25px rgba(30, 60, 114, 0.2);
  }

  .login-logo i {
    color: white;
    font-size: 40px;
  }

  .login-title {
    font-size: 28px;
    font-weight: 700;
    color: #1e3c72;
    margin-bottom: 10px;
  }

  .login-subtitle {
    font-size: 14px;
    color: #7a8fa9;
  }

  /* Form Inputs */
  .login-form .form-group {
    margin-bottom: 20px;
    position: relative;
  }

  .login-form label {
    display: block;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 8px;
    font-size: 14px;
  }

  .login-form .form-control {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e0e6f2;
    border-radius: 10px;
    font-size: 14px;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.9);
  }

  .login-form .form-control:focus {
    border-color: #1e3c72;
    box-shadow: 0 0 0 3px rgba(30, 60, 114, 0.1);
    outline: none;
    background: white;
  }

  .login-form .form-control::placeholder {
    color: #a0adc7;
  }

  .login-form .form-control.is-invalid {
    border-color: #dc3545;
  }

  .login-form .form-control.is-invalid:focus {
    box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
  }

  /* Error Message */
  .invalid-feedback {
    color: #dc3545;
    font-size: 12px;
    margin-top: 5px;
    display: block;
  }

  /* Checkbox */
  .form-check {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
  }

  .form-check-input {
    width: 18px;
    height: 18px;
    margin-right: 8px;
    cursor: pointer;
    border: 2px solid #e0e6f2;
    border-radius: 5px;
    transition: all 0.3s ease;
  }

  .form-check-input:checked {
    background-color: #1e3c72;
    border-color: #1e3c72;
  }

  .form-check-label {
    color: #2c3e50;
    cursor: pointer;
    margin: 0;
    font-size: 14px;
  }

  /* Login Button */
  .btn-login {
    width: 100%;
    padding: 12px 20px;
    background: linear-gradient(135deg, #1e3c72, #2a5298);
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    box-shadow: 0 10px 25px rgba(30, 60, 114, 0.2);
  }

  .btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 35px rgba(30, 60, 114, 0.3);
  }

  .btn-login:active {
    transform: translateY(0);
  }

  .btn-login:disabled {
    opacity: 0.7;
    cursor: not-allowed;
  }

  /* Loading Spinner */
  .btn-login .spinner {
    display: none;
    width: 16px;
    height: 16px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-top-color: white;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
    margin-right: 8px;
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

  /* Footer Links */
  .login-footer {
    text-align: center;
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid #e0e6f2;
  }

  .login-footer a {
    color: #1e3c72;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.3s ease;
  }

  .login-footer a:hover {
    color: #2a5298;
    text-decoration: underline;
  }

  /* Alert Messages */
  .alert-login {
    border-radius: 10px;
    border: none;
    margin-bottom: 20px;
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
    background-color: #d4edda;
    color: #155724;
  }

  .alert-danger {
    background-color: #f8d7da;
    color: #721c24;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .login-card {
      padding: 30px;
      margin: 20px;
    }

    .login-title {
      font-size: 24px;
    }

    .shape-1, .shape-2, .shape-3 {
      display: none;
    }
  }
</style>

<div class="login-background">
  <div class="shape-1"></div>
  <div class="shape-2"></div>
  <div class="shape-3"></div>
</div>

<section class="login-section">
  <div class="login-card">
    <!-- Logo Section -->
    <div class="login-logo-section">
      <div class="login-logo">
        <i class="bi bi-shield-check"></i>
      </div>
      <h2 class="login-title">SPK Jurusan</h2>
      <p class="login-subtitle">SMK Babussalam</p>
    </div>

    <!-- Alert Messages -->
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

    <!-- Login Form -->
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

      <div class="form-check">
        <input 
          type="checkbox" 
          name="remember" 
          class="form-check-input" 
          id="remember" 
          {{ old('remember') ? 'checked' : '' }}>
        <label class="form-check-label" for="remember">Ingat saya</label>
      </div>

      <button type="submit" class="btn-login" id="loginBtn">
        <span class="spinner"></span>
        <span>Login</span>
      </button>

      <div class="login-footer">
        <a href="{{ route('password.change') }}">Lupa Kata Sandi?</a>
      </div>
    </form>
  </div>
</section>

<script>
  // Form submission handling
  document.getElementById('loginForm').addEventListener('submit', function() {
    const btn = document.getElementById('loginBtn');
    btn.classList.add('loading');
    btn.disabled = true;
  });

  // Auto-clear error messages after 5 seconds
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
