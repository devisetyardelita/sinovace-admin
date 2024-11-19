
<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>@yield('title') | SINOVACE</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    {{-- {{ asset('style') }} --}}
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('style/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('style/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('style/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('style/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('style/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('style/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('style/assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('style/assets/js/config.js') }}"></script>

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">

              <a href="{{ url('home') }}" class="app-brand-link">
                <span class="app-brand-logo demo"></span>
                <span class="app-brand-text demo menu-text fw-bolder ms-2 d-flex align-items-center">
                  <i class='bx bxs-book-content text-primary' style="font-size: 1.75rem;"></i>
                  <span class="ms-2 text-primary">SINOVACE</span>
                </span>
              </a>

            {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
              <i class="bx bx-menu"></i>
            </button> --}}

          </div>

            {{-- <div class="divider text-end">
              <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="bx bx-menu" style="font-size: 1.75rem;"></i>
              </a>
            </div> --}}


          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item {{ Request::is('home') ? 'active' : '' }}">
              <a href="{{ url('home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>
        
            <!-- Forms & Tables -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Data Layanan</span></li>
            
            <!-- PAUD -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-file-blank"></i>
                <div data-i18n="Tables">PAUD</div>
              </a>
            </li>
            
            <!-- SD -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div data-i18n="Tables">SD</div>
              </a>
            </li>
            
            <!-- SMP -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-file"></i>
                <div data-i18n="Tables">SMP</div>
              </a>
            </li>
        
            <!-- Sekretaris -->
            <li class="menu-item {{ Request::is('layanan_pengaduan*') || Request::is('legalisir_fotokopi_ijazah_sttb*') || Request::is('legalisir_piagam_penghargaan*') || Request::is('mutasi_siswa') || Request::is('pelayanan_dapodik*') || Request::is('pengelolaan_dana_bos*') || Request::is('surat_keterangan_ralat_ijazah_sttb*') || Request::is('surat_pengganti_ijazah_sttb_hilang*') ? 'active open' : '' }}">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-file-archive"></i>
                <div data-i18n="Tables">Sekretaris</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item {{ Request::is('layanan_pengaduan*') ? 'active' : '' }}">
                  <a href="{{ url('layanan_pengaduan') }}" class="menu-link">
                    <div data-i18n="Tables">Layanan Pengaduan</div>
                  </a>
                </li>
                <li class="menu-item {{ Request::is('legalisir_fotokopi_ijazah_sttb*') ? 'active' : '' }}">
                  <a href="{{ url('legalisir_fotokopi_ijazah_sttb') }}" class="menu-link">
                    <div data-i18n="Tables">Legalisir Fotokopi Ijazah/STTB</div>
                  </a>
                </li>
                <li class="menu-item {{ Request::is('legalisir_piagam_penghargaan*') ? 'active' : '' }}">
                  <a href="{{ url('legalisir_piagam_penghargaan') }}" class="menu-link">
                    <div data-i18n="Tables">Legalisir Piagam Penghargaan</div>
                  </a>
                </li>
                <li class="menu-item {{ Request::is('mutasi_siswa') ? 'active' : '' }}">
                  <a href="{{ url('mutasi_siswa') }}" class="menu-link">
                    <div data-i18n="Tables">Mutasi Siswa</div>
                  </a>
                </li>
                <li class="menu-item {{ Request::is('pelayanan_dapodik') ? 'active' : '' }}">
                  <a href="{{ url('pelayanan_dapodik') }}" class="menu-link">
                    <div data-i18n="Tables">DAPODIK</div>
                  </a>
                </li>
                <li class="menu-item {{ Request::is('pengelolaan_dana_bos') ? 'active' : '' }}">
                  <a href="{{ url('pengelolaan_dana_bos') }}" class="menu-link">
                    <div data-i18n="Tables">Pengelolaan BOS</div>
                  </a>
                </li>
                <li class="menu-item {{ Request::is('surat_keterangan_ralat_ijazah_sttb*') ? 'active' : '' }}">
                  <a href="{{ url('surat_keterangan_ralat_ijazah_sttb') }}" class="menu-link">
                    <div data-i18n="Tables">Surat Keterangan Ralat Ijazah/STTB</div>
                  </a>
                </li>
                <li class="menu-item {{ Request::is('surat_pengganti_ijazah_sttb_hilang*') ? 'active' : '' }}">
                  <a href="{{ url('surat_pengganti_ijazah_sttb_hilang') }}" class="menu-link">
                    <div data-i18n="Tables">Surat Pengganti Ijazah/STTB Hilang</div>
                  </a>
                </li>
              </ul>
            </li>
        </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          
        <!-- Navbar -->
        <nav class="navbar-nav-right navbar-expand-xl d-flex align-items-center" id="navbar-collapse">
          <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Place this tag where you want the button to render. -->

            <div class="navbar-nav-right d-flex align-items-end row" id="navbar-collapse">
        <!-- Search -->
        {{-- <div class="navbar-nav align-items-center me-auto">
          <div class="nav-item d-flex align-items-center">
              <div class="divider text-start">
                  <div class="divider-text">
                      <i class="bx bx-menu fs-4 lh-0"></i>
                  </div>
              </div>
          </div>
      </div> --}}
      <!-- /Search -->
            </div>

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
              <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                <div class="avatar avatar-online">
                  <img src="{{ asset('profile/' . Auth::user()->avatar) }}" alt="Avatar" class="avatar w-px-40 h-auto rounded-circle">
                  {{-- <img src="{{ asset('build/assets/Profil.png') }}" alt class="w-px-40 h-auto rounded-circle" /> --}}
                </div>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                  <a class="dropdown-item" href="#">
                    <div class="d-flex">
                      <div class="flex-shrink-0 me-3">
                        <div class="avatar avatar-online">
                          <img src="{{ asset('profile/' . Auth::user()->avatar) }}" alt="Avatar" class="w-px-10 h-auto rounded-circle" />
                          {{-- <img src="{{ asset('build/assets/Profil.png') }}" alt class="w-px-40 h-auto rounded-circle" /> --}}
                        </div>
                      </div>
                      <div class="flex-grow-1">
                        <span class="fw-semibold d-block">
                          @auth
                          {{auth()->user()->name }}
                          @endauth
                        </span>
                        <small class="text-muted">Admin</small>
                      </div>
                    </div>
                  </a>
                </li>

                  <div class="dropdown-divider"></div>
                </li>
                @auth
                  <li>
                    <a class="dropdown-item" href="{{ url('login') }}">
                      <i class="bx bx-power-off me-2"></i>
                      <span class="align-middle">Log Out</span>
                    </a>
                  </li>
                @endauth
              </ul>
            </li>
            <!--/ User -->
          </ul>
        </nav>
        <!-- / Navbar -->
          <!-- Navbar -->
          {{-- <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div> --}}

            {{-- <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
                  />
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="{{ asset('style/assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">John Doe</span>
                            <small class="text-muted">Admin</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="auth-login-basic.html">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div> --}}
          </nav>
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            
            @yield('content')
            <!-- / Content -->


            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  SINOVACE
                  {{-- , made with ❤️ by
                  <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a> --}}
                </div>
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    {{-- <div class="buy-now">
      <a
        href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/"
        target="_blank"
        class="btn btn-danger btn-buy-now"
        >Upgrade to Pro</a
      >
    </div> --}}

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('style/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('style/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('style/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('style/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('style/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('style/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('style/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('style/assets/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Include JS files -->
    <script>
      document.addEventListener('DOMContentLoaded', function () {
          const currentUrl = window.location.pathname;
          const menuItems = document.querySelectorAll('.menu-item a');
  
          menuItems.forEach(item => {
              if (item.href === window.location.href) {
                  item.parentElement.classList.add('active');
  
                  // Tambahkan kelas aktif ke menu induk jika item adalah submenu
                  const parentMenuItem = item.closest('.menu-item.menu-toggle');
                  if (parentMenuItem) {
                      parentMenuItem.classList.add('active');
                  }
              }
          });
      });
    </script>

    <!-- Toggle script -->
    <script>
      document.querySelector('.navbar-toggler').addEventListener('click', function () {
        const mainMenu = document.getElementById('main-menu');
        mainMenu.classList.toggle('show');
      });
    </script>
  </body>
</html>
