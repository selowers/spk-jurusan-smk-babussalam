<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - SMK Babussalam</title>

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
  <!-- Vertical Sidebar -->
  <div id="miniSidebar">
    <div class="brand-logo">
      <a class="d-none d-md-flex align-items-center gap-2" href="/">
        <img src="/assets/images/brand/logo/logo-icon.svg" alt="Logo SMK Babussalam" />
        <span class="fw-bold fs-4 site-logo-text">SMK Babussalam</span>
      </a>
    </div>
    <ul class="navbar-nav flex-column">
      <!-- Nav item -->
      <li class="nav-item">
        <a class="nav-link active" href="/"><span class="nav-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-home">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
          </svg>
        </span> <span class="text">Dashboard</span></a>
      </li>

      <li class="nav-item">
        <div class="nav-heading">Menu</div>
        <hr class="mx-5 nav-line mb-1" />
      </li>

      <!-- Nav item -->
      <li class="nav-item">
        <a class="nav-link" href="#"><span class="nav-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
          </svg>
        </span> <span class="text">Siswa</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#"><span class="nav-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-school">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M22 9l-10 -4l-10 4l10 4l10 -4v6" />
            <path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4" />
          </svg>
        </span> <span class="text">Jurusan</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#"><span class="nav-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-chart-bar">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M3 12m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
            <path d="M9 8m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
            <path d="M15 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
            <path d="M4 20l14 0" />
          </svg>
        </span> <span class="text">SPK</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#"><span class="nav-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-settings">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c.996 .608 2.296 .07 2.572 -1.065z" />
            <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
          </svg>
        </span> <span class="text">Pengaturan</span></a>
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
          <!-- User dropdown -->
          <div class="dropdown">
            <a class="d-flex align-items-center text-reset text-decoration-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <div class="avatar avatar-sm">
                <img src="/assets/images/avatar/avatar-1.jpg" alt="Avatar" class="avatar-img rounded-circle">
              </div>
              <div class="ms-2 d-none d-lg-block">
                <span class="text-body-secondary fw-medium fs-sm">Admin</span>
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="#"><i class="ti ti-user me-2"></i>Profile</a></li>
              <li><a class="dropdown-item" href="#"><i class="ti ti-settings me-2"></i>Settings</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#"><i class="ti ti-logout me-2"></i>Logout</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- container -->
    <div class="custom-container">
      <!-- row -->
      <div class="row mb-6 g-6">
        <div class="col-12">
          <div class="bg-gradient-mixed p-8 py-10 rounded-3 p-lg-7">
            <!--heading-->
            <h1 class="fs-3">👋 Selamat Datang di Dashboard SPK Jurusan</h1>
            <p class="mb-0">Sistem Pendukung Keputusan untuk Pemilihan Jurusan di SMK Babussalam.</p>
            <p>Monitor siswa, kelola jurusan, dan dapatkan rekomendasi terbaik.</p>
            <a href="#" class="btn btn-dark">Mulai Analisis</a>
          </div>
        </div>
      </div>

      <!-- Additional content can be added here -->
      <div class="row mb-6 g-6">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title mb-0">Dashboard Overview</h5>
            </div>
            <div class="card-body">
              <p>Halaman dashboard untuk Sistem Pendukung Keputusan Jurusan SMK Babussalam telah berhasil diintegrasikan dengan template Bootstrap modern.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Statistik Siswa -->
      <div class="row mb-6 g-6">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title mb-0">Statistik Siswa</h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover">
                  <thead class="table-dark">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Nama Siswa</th>
                      <th scope="col">Jurusan</th>
                      <th scope="col">Nilai Rata-rata</th>
                      <th scope="col">Status</th>
                      <th scope="col">Rekomendasi SPK</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>Ahmad Fauzi</td>
                      <td>Teknik Komputer Jaringan</td>
                      <td>85.5</td>
                      <td><span class="badge bg-success">Aktif</span></td>
                      <td>Teknik Komputer Jaringan</td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>Siti Nurhaliza</td>
                      <td>Akuntansi</td>
                      <td>88.2</td>
                      <td><span class="badge bg-success">Aktif</span></td>
                      <td>Akuntansi</td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td>Budi Santoso</td>
                      <td>Teknik Otomotif</td>
                      <td>82.1</td>
                      <td><span class="badge bg-warning">Pending</span></td>
                      <td>Teknik Otomotif</td>
                    </tr>
                    <tr>
                      <th scope="row">4</th>
                      <td>Rina Sari</td>
                      <td>Tata Boga</td>
                      <td>90.3</td>
                      <td><span class="badge bg-success">Aktif</span></td>
                      <td>Tata Boga</td>
                    </tr>
                    <tr>
                      <th scope="row">5</th>
                      <td>Dedi Rahman</td>
                      <td>Teknik Elektronika</td>
                      <td>87.8</td>
                      <td><span class="badge bg-success">Aktif</span></td>
                      <td>Teknik Elektronika</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Libs JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/simplebar@6.2.1/dist/simplebar.min.js"></script>

  <!-- Theme JS -->
  <script src="/assets/js/main.js"></script>
</body>

</html>