<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard - SMK Babussalam')</title>

  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="57x57" href="/assets/images/favicon/apple-icon-57x57.png" />
  <link rel="apple-touch-icon" sizes="60x60" href="/assets/images/favicon/apple-icon-60x60.png" />
  <link rel="apple-touch-icon" sizes="72x72" href="/assets/images/favicon/apple-icon-72x72.png" />
  <link rel="apple-touch-icon" sizes="76x76" href="/assets/images/favicon/apple-icon-76x76.png" />
  <link rel="apple-touch-icon" sizes="114x114" href="/assets/images/favicon/apple-icon-114x114.png" />
  <link rel="apple-touch-icon" sizes="120x120" href="/assets/images/favicon/apple-icon-120x120.png" />
  <link rel="apple-touch-icon" sizes="144x144" href="/assets/images/favicon/apple-icon-144x144.png" />
  <link rel="apple-touch-icon" sizes="152x152" href="/assets/images/favicon/apple-icon-152x152.png" />
  <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/favicon/apple-icon-180x180.png" />
  <link rel="icon" type="image/png" sizes="192x192" href="/assets/images/favicon/android-icon-192x192.png" />
  <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/favicon/favicon-32x32.png" />
  <link rel="icon" type="image/png" sizes="96x96" href="/assets/images/favicon/favicon-96x96.png" />
  <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon/favicon-16x16.png" />

  <meta name="msapplication-TileColor" content="#ffffff" />
  <meta name="msapplication-TileImage" content="/assets/images/favicon/ms-icon-144x144.png" />
  <meta name="theme-color" content="#ffffff" />

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Color modes -->
  <script src="/assets/js/vendors/color-modes.js"></script>
  <script>
    if (localStorage.getItem('sidebarExpanded') === 'false') {
      document.documentElement.classList.add('collapsed');
      document.documentElement.classList.remove('expanded');
    } else {
      document.documentElement.classList.remove('collapsed');
      document.documentElement.classList.add('expanded');
    }
  </script>

  <!-- Libs CSS -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800&display=swap" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@6.2.1/dist/simplebar.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.47.0/tabler-icons.min.css" />

  <!-- Theme CSS -->
  <link rel="stylesheet" href="/assets/css/theme.css" />
</head>

<body>
  @guest
    <div class="container mt-5">
      @yield('content')
    </div>
  @else
    <!-- Vertical Sidebar -->
    <div id="miniSidebar">
      <div class="brand-logo">
        <a class="d-none d-md-flex align-items-center gap-2" href="/">
          <img src="/assets/images/brand/logo/logo-icon.svg" alt="Logo SMK Babussalam" />
          <span class="fw-bold fs-4 site-logo-text">SMK Babussalam</span>
        </a>
      </div>
    <ul class="navbar-nav flex-column">
      <!-- Nav item: Dashboard -->
      <li class="nav-item">
        <a class="nav-link @if(request()->routeIs('dashboard*')) active @endif" href="{{ route('dashboard.index') }}"><span class="nav-icon">
          <i class="ti ti-home"></i>
        </span> <span class="text">Dashboard</span></a>
      </li>

      <li class="nav-item">
        <div class="nav-heading">Menu</div>
        <hr class="mx-5 nav-line mb-1" />
      </li>

      <!-- Nav item: Mengelola Data Siswa -->
      <li class="nav-item">
        <a class="nav-link @if(request()->routeIs('siswa*')) active @endif" href="{{ route('siswa.index') }}"><span class="nav-icon">
          <i class="ti ti-users"></i>
        </span> <span class="text">Mengelola Data Siswa</span></a>
      </li>

      <!-- Nav item: Mengelola Data Kriteria -->
      <li class="nav-item">
        <a class="nav-link @if(request()->routeIs('kriteria*')) active @endif" href="{{ route('kriteria.index') }}"><span class="nav-icon">
          <i class="ti ti-list-details"></i>
        </span> <span class="text">Mengelola Data Kriteria</span></a>
      </li>

      <!-- Nav item: Mengelola Data Jurusan -->
      <li class="nav-item">
        <a class="nav-link @if(request()->routeIs('jurusan*')) active @endif" href="{{ route('jurusan.index') }}"><span class="nav-icon">
          <i class="ti ti-school"></i>
        </span> <span class="text">Mengelola Data Jurusan</span></a>
      </li>

      <!-- Nav item: Input Nilai Kuesioner -->
      <li class="nav-item">
        <a class="nav-link @if(request()->routeIs('nilai*')) active @endif" href="{{ route('nilai.index') }}"><span class="nav-icon">
          <i class="ti ti-clipboard-list"></i>
        </span> <span class="text">Input Nilai Kuesioner</span></a>
      </li>

      <!-- Nav item: Proses Perhitungan SAW -->
      <li class="nav-item">
        <a class="nav-link @if(request()->routeIs('saw.index') || request()->routeIs('saw.show') || request()->routeIs('saw.edit')) active @endif" href="{{ route('saw.index') }}"><span class="nav-icon">
          <i class="ti ti-calculator"></i>
        </span> <span class="text">Proses Perhitungan SAW</span></a>
      </li>

      <!-- Nav item: Melihat Hasil Rekomendasi -->
      <li class="nav-item">
        <a class="nav-link @if(request()->routeIs('saw.hasil')) active @endif" href="{{ route('saw.hasil') }}"><span class="nav-icon">
          <i class="ti ti-eye"></i>
        </span> <span class="text">Melihat Hasil Rekomendasi</span></a>
      </li>

      <!-- Nav item: Cetak/Simpan Hasil -->
      <li class="nav-item">
        <a class="nav-link @if(request()->routeIs('saw.hasil.exportPDF')) active @endif" href="{{ route('saw.hasil.exportPDF') }}" target="_blank" onclick="return confirm('Apakah kamu yakin ingin mencetak hasil ini?');"><span class="nav-icon">
          <i class="ti ti-printer"></i>
        </span> <span class="text">Cetak/Simpan Hasil</span></a>
      </li>
    </ul>
  </div>

  <!-- Main Content -->
  <div id="content" class="position-relative h-100">
    <!-- navbar -->
    <div class="navbar-glass navbar navbar-expand-lg px-0 px-lg-4">
      <div class="container-fluid px-lg-0">
        <div class="d-flex align-items-center gap-4">
          <!-- Collapse -->
          <div class="d-block d-lg-none">
            <a class="text-inherit" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-menu-2">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M4 6l16 0" />
                <path d="M4 12l16 0" />
                <path d="M4 18l16 0" />
              </svg>
            </a>
          </div>
          <div class="d-none d-lg-block">
            <a class="sidebar-toggle d-flex texttooltip p-3" href="javascript:void(0)" data-template="collapseMessage">
              <span class="collapse-mini">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-bar-left text-secondary">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M4 12l10 0" />
                  <path d="M4 12l4 4" />
                  <path d="M4 12l4 -4" />
                  <path d="M20 4l0 16" />
                </svg>
              </span>
              <span class="collapse-expanded">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-bar-right text-secondary">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M20 12l-10 0" />
                  <path d="M20 12l-4 4" />
                  <path d="M20 12l-4 -4" />
                  <path d="M4 4l0 16" />
                </svg>
                <div id="collapseMessage" class="d-none">
                  <span class="small">Collapse</span>
                </div>
              </span>
            </a>
          </div>
        </div>

        <div class="ms-auto d-flex align-items-center gap-3">
          <!-- SMK Babussalam Text and Logo -->
          <div class="d-flex align-items-center gap-2">
            <span class="fw-bold text-primary fs-5 d-none d-lg-block">SMK Babussalam</span>
            <img src="{{ asset('assets/images/logo-smk-babussalam.png') }}" alt="Logo SMK Babussalam" style="width: 40px; height: 40px; border-radius: 50%; border: 2px solid #e9ecef;">
          </div>

          <!-- User dropdown -->
          <div class="dropdown">
            <a class="d-flex align-items-center text-reset text-decoration-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <div class="avatar avatar-sm">
                <img src="/assets/images/avatar/avatar-1.jpg" alt="Avatar" class="avatar-img rounded-circle">
              </div>
              <div class="ms-2 d-none d-lg-block">
                <span class="text-body-secondary fw-medium fs-sm">{{ Auth::user()->name ?? 'Guru BK' }}</span>
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="{{ route('password.change') }}"><i class="ti ti-lock me-2"></i>Ubah Kata Sandi</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="dropdown-item"><i class="ti ti-logout me-2"></i>Logout</button>
                </form>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- container -->
    <div class="custom-container">
      @yield('content')
    </div>
  </div>
  @endguest

  <!-- Libs JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/simplebar@6.2.1/dist/simplebar.min.js"></script>

  <!-- Theme JS -->
  <script src="/assets/js/main.js"></script>
  @yield('scripts')
</body>

</html>