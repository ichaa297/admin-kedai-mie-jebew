<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard') - Kedai Mie Jebew</title>
    <link rel="icon" type="image/png"
        href="{{ asset('image/logo-mie-jebew.png') }}">

    <!-- CSS Kaiadmin -->
    <link rel="stylesheet" href="{{ asset('backend/kaiadmin-lite-v1.2.0/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/kaiadmin-lite-v1.2.0/assets/css/plugins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/kaiadmin-lite-v1.2.0/assets/css/kaiadmin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/kaiadmin-lite-v1.2.0/assets/css/fonts.min.css') }}">
    <!-- Tema Warna Kustom -->    
    <style>
        :root {
            --warna-utama: {{ Auth::user()->warna_utama ?? '#1572E8' }};
            --warna-latar: {{ Auth::user()->warna_latar ?? '#F5F7FD' }};
            --font-family: '{{ Auth::user()->font_family ?? 'Poppins' }}';
            --font-color: {{ Auth::user()->font_color ?? '#333333' }};
            --font-size: {{ Auth::user()->font_size ?? 14 }}px;
        }

        /* PENGATURAN FONT */
        body {
            font-family: var(--font-family), sans-serif !important;
            font-size: var(--font-size) !important;
            color: var(--font-color);
        }

        /* PENGATURAN FONT SIDEBAR */
        .sidebar .nav-item a,
        .sidebar .nav-item a p,
        .sidebar .nav-item a span,
        .sidebar .nav-item a .sub-item,
        .sidebar .nav-section .text-section {
            font-family: var(--font-family), sans-serif !important;
            font-size: var(--font-size) !important;
            color: var(--font-color) !important;
        }

        /* Ikon sidebar */
        .sidebar .nav-item a i {
            color: var(--font-color) !important;
        }

        /* TULISAN YANG TETAP HITAM */

        /* Administrator Kedai Mie Jebew */
        .main-header .navbar-header,
        .main-header .navbar-header * {
            color: #000000 !important;
        }

        /* Judul halaman */
        .page-header h3,
        .page-header h3.fw-bold {
            color: #000000 !important;
        }

        /* Judul bagian Pengaturan di sidebar */
        .sidebar .nav-section .text-section {
            color: #000000 !important;
        }

        /* Tulisan halaman utama */
        .main-panel,
        .main-panel p,
        .main-panel span,
        .main-panel label,
        .main-panel td,
        .main-panel th,
        .main-panel input,
        .main-panel select,
        .main-panel textarea {
            font-family: var(--font-family), sans-serif !important;
            color: var(--font-color);
            font-size: var(--font-size);
        }

        /* Judul halaman */
        .main-panel h1,
        .main-panel h2,
        .main-panel h3,
        .main-panel h4,
        .main-panel h5,
        .main-panel h6 {
            font-family: var(--font-family), sans-serif !important;
        }

        body,
        .main-panel,
        .page-inner,
        .container,
        .page-inner .container {
            background-color: var(--warna-latar) !important;
        }

        /* Sidebar */
        .sidebar,
        .sidebar[data-background-color],
        .sidebar .sidebar-wrapper,
        .sidebar .logo-header {
            background: var(--warna-utama) !important;
        }

        /* Logo bagian atas */
        .main-header-logo .logo-header {
            background: var(--warna-utama) !important;
        }

        /* Navbar */
        .main-header .navbar-header {
            border-top: 3px solid var(--warna-utama) !important;
        }

        /* Tombol */
        .btn-primary {
            background-color: var(--warna-utama) !important;
            border-color: var(--warna-utama) !important;
        }

        /* Aksen */
        .sidebar .nav-item.active > a {
            border-left-color: var(--warna-utama) !important;
        }

        .text-primary {
            color: var(--warna-utama) !important;
        }
    </style>

</head>

<body>

    <div class="wrapper">

        <!-- SIDEBAR -->
        <div class="sidebar" data-background-color="dark">

            <div class="sidebar-logo">
                <div class="logo-header" data-background-color="dark">

                    <a href="{{ route('backend.beranda') }}"
                        class="logo d-flex align-items-center"
                        style="gap: 8px;">

                        <img src="{{ asset('image/logo-mie-jebew.png') }}"
                            alt="Logo Kedai Mie Jebew"
                            style="width: 35px; height: 35px; object-fit: contain;">

                        <span class="text-white fw-bold">
                            KEDAI MIE JEBEW
                        </span>

                    </a>

                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>

                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>

                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>

                </div>
            </div>

            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">

                    <ul class="nav nav-secondary">

                        <!-- BERANDA -->
                        <li class="nav-item {{ request()->routeIs('backend.beranda') ? 'active' : '' }}">
                            <a href="{{ route('backend.beranda') }}">
                                <i class="fas fa-home"></i>
                                <p>Beranda</p>
                            </a>
                        </li>

                        <!-- MENU DATA MASTER -->
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Data Master</h4>
                        </li>

                        @if (Auth::user()->role == 1)
                            <li class="nav-item {{ request()->routeIs('backend.user.*') ? 'active' : '' }}">
                                <a data-bs-toggle="collapse"
                                    href="#menuUser"
                                    aria-expanded="{{ request()->routeIs('backend.user.*') ? 'true' : 'false' }}">
                                    <i class="fas fa-users"></i>
                                    <p>Data User</p>
                                    <span class="caret"></span>
                                </a>

                                <div class="collapse {{ request()->routeIs('backend.user.*') ? 'show' : '' }}" id="menuUser">
                                    <ul class="nav nav-collapse">
                                        <li>
                                            <a href="{{ route('backend.user.index') }}">
                                                <span class="sub-item">Daftar User</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif

                        <li class="nav-item {{ request()->routeIs('backend.kategori.*', 'backend.produk.*') ? 'active' : '' }}">
                            <a data-bs-toggle="collapse"
                                href="#menuProduk"
                                aria-expanded="{{ request()->routeIs('backend.kategori.*', 'backend.produk.*') ? 'true' : 'false' }}">
                                <i class="fas fa-box"></i>
                                <p>Data Produk</p>
                                <span class="caret"></span>
                            </a>

                            <div class="collapse {{ request()->routeIs('backend.kategori.*', 'backend.produk.*') ? 'show' : '' }}" id="menuProduk">
                                <ul class="nav nav-collapse">
                                    <li class="{{ request()->routeIs('backend.kategori.*') ? 'active' : '' }}">
                                        <a href="{{ route('backend.kategori.index') }}">
                                            <span class="sub-item">Kategori</span>
                                        </a>
                                    </li>
                                    <li class="{{ request()->routeIs('backend.produk.*') ? 'active' : '' }}">
                                        <a href="{{ route('backend.produk.index') }}">
                                            <span class="sub-item">Produk</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        
                        <!-- MENU TRANSAKSI -->
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Transaksi</h4>
                        </li>

                        <!-- PESANAN -->
                        <li class="nav-item {{ request()->routeIs('backend.pesanan.*') ? 'active' : '' }}">
                            <a href="{{ route('backend.pesanan.index') }}">
                                <i class="fas fa-shopping-cart"></i>
                                <p>Pesanan</p>
                            </a>
                        </li>

                        <!-- LAPORAN -->
                        <li class="nav-item {{ request()->routeIs('backend.laporan.*') ? 'active' : '' }}">
                            <a data-bs-toggle="collapse"
                                href="#menuLaporan"
                                aria-expanded="{{ request()->routeIs('backend.laporan.*') ? 'true' : 'false' }}">
                                <i class="fas fa-chart-bar"></i>
                                <p>Laporan</p>
                                <span class="caret"></span>
                            </a>

                            <div class="collapse {{ request()->routeIs('backend.laporan.*') ? 'show' : '' }}"
                                id="menuLaporan">
                                <ul class="nav nav-collapse">

                                    @if (Auth::user()->role == 1)
                                        <li class="{{ request()->routeIs('backend.laporan.formuser', 'backend.laporan.cetakuser') ? 'active' : '' }}">
                                            <a href="{{ route('backend.laporan.formuser') }}">
                                                <span class="sub-item">Laporan User</span>
                                            </a>
                                        </li>
                                    @endif

                                    <li class="{{ request()->routeIs('backend.laporan.formproduk', 'backend.laporan.cetakproduk') ? 'active' : '' }}">
                                        <a href="{{ route('backend.laporan.formproduk') }}">
                                            <span class="sub-item">Laporan Produk</span>
                                        </a>
                                    </li>

                                    <li class="{{ request()->routeIs('backend.laporan.formpesanan', 'backend.laporan.cetakpesanan') ? 'active' : '' }}">
                                        <a href="{{ route('backend.laporan.formpesanan') }}">
                                            <span class="sub-item">Laporan Pesanan</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        
                        <!-- MENU PENGATURAN -->
                        <li class="nav-item {{ request()->routeIs('backend.pengaturan_profil.*', 'backend.pengaturan_tema.*', 'backend.pengaturan_font.*') ? 'active' : '' }}">
                            <a data-bs-toggle="collapse"
                                href="#menuPengaturan"
                                aria-expanded="{{ request()->routeIs('backend.pengaturan_profil.*', 'backend.pengaturan_tema.*', 'backend.pengaturan_font.*') ? 'true' : 'false' }}">
                                <i class="fas fa-cog"></i>
                                <p>Pengaturan</p>
                                <span class="caret"></span>
                            </a>

                            <div class="collapse {{ request()->routeIs('backend.pengaturan_profil.*', 'backend.pengaturan_tema.*', 'backend.pengaturan_font.*') ? 'show' : '' }}"
                                id="menuPengaturan">
                                <ul class="nav nav-collapse">

                                    <li class="{{ request()->routeIs('backend.pengaturan_profil.*') ? 'active' : '' }}">
                                        <a href="{{ route('backend.pengaturan_profil.index') }}">
                                            <span class="sub-item">Pengaturan Profil</span>
                                        </a>
                                    </li>

                                    <li class="{{ request()->routeIs('backend.pengaturan_tema.*') ? 'active' : '' }}">
                                        <a href="{{ route('backend.pengaturan_tema.index') }}">
                                            <span class="sub-item">Pengaturan Tema</span>
                                        </a>
                                    </li>

                                    <li class="{{ request()->routeIs('backend.pengaturan_font.*') ? 'active' : '' }}">
                                        <a href="{{ route('backend.pengaturan_font.index') }}">
                                            <span class="sub-item">Pengaturan Font</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <!-- LOGOUT DI LUAR PENGATURAN -->
                        <li class="nav-item">
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-sidebar').submit();">
                                <i class="fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>

                            <form id="logout-sidebar" action="{{ route('backend.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>

                    </ul>


                </div>
            </div>
        </div>
        <!-- END SIDEBAR -->


        <!-- MAIN PANEL -->
        <div class="main-panel">
            
        <!-- NAVBAR -->
        <div class="main-header">

            <div class="main-header-logo">
                <div class="logo-header" data-background-color="dark">
                    <a href="{{ route('backend.beranda') }}" class="logo">
                        <span class="text-white fw-bold">Kedai Mie Jebew</span>
                    </a>
                </div>
            </div>

            <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">

                <div class="container-fluid">

                    <h5 class="mb-0">Administrator Kedai Mie Jebew</h5>

                    <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">

                        <!-- DROPDOWN PROFIL -->
                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle"
                            href="#"
                            id="profileDropdown"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">

                                <i class="fas fa-user-circle"></i>
                                {{ Auth::user()->nama }}

                            </a>

                            <ul class="dropdown-menu dropdown-menu-end"
                                aria-labelledby="profileDropdown">

                                <!-- ROLE USER -->
                                <li>
                                    <span class="dropdown-item-text">
                                        @if (Auth::user()->role == 1)
                                            Super Admin
                                        @elseif (Auth::user()->role == 0)
                                            Admin
                                        @else
                                            Customer
                                        @endif
                                    </span>
                                </li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <!-- PROFIL -->
                                <li>
                                    <a class="dropdown-item"
                                    href="{{ route('backend.pengaturan_profil.index') }}">
                                        <i class="fas fa-user me-2"></i>
                                        Profil
                                    </a>
                                </li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <!-- LOGOUT -->
                                <li>
                                    <form action="{{ route('backend.logout') }}" method="POST">
                                        @csrf

                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i>
                                            Logout
                                        </button>
                                    </form>
                                </li>

                            </ul>

                        </li>
                        <!-- END DROPDOWN PROFIL -->

                    </ul>

                </div>
            </nav>
        </div>
        <!-- END NAVBAR -->


            <!-- KONTEN HALAMAN -->
            <div class="container">
                <div class="page-inner">

                    @yield('content')

                </div>
            </div>
            <!-- END KONTEN -->


            <!-- FOOTER -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="copyright">
                        &copy; {{ date('Y') }} Kedai Mie Jebew
                    </div>
                </div>
            </footer>
            <!-- END FOOTER -->

        </div>
        <!-- END MAIN PANEL -->

    </div>


    <!-- JAVASCRIPT KAIADMIN -->
    <script src="{{ asset('backend/kaiadmin-lite-v1.2.0/assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('backend/kaiadmin-lite-v1.2.0/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('backend/kaiadmin-lite-v1.2.0/assets/js/core/bootstrap.min.js') }}"></script>

    <script src="{{ asset('backend/kaiadmin-lite-v1.2.0/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Plugin Grafik -->
    <script src="{{ asset('backend/kaiadmin-lite-v1.2.0/assets/js/plugin/chart.js/chart.min.js') }}"></script>

    <!-- Plugin DataTables -->
    <script src="{{ asset('backend/kaiadmin-lite-v1.2.0/assets/js/plugin/datatables/datatables.min.js') }}"></script>

    <!-- Plugin Notifikasi -->
    <script src="{{ asset('backend/kaiadmin-lite-v1.2.0/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <!-- Plugin SweetAlert -->
    <script src="{{ asset('backend/kaiadmin-lite-v1.2.0/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Kaiadmin -->
    <script src="{{ asset('backend/kaiadmin-lite-v1.2.0/assets/js/kaiadmin.min.js') }}"></script>

    <!-- Script tambahan tiap halaman -->
    @stack('scripts')

</body>
</html>