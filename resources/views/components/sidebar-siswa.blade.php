<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('siswa.dashboard') }}">
        <div class="sidebar-brand-icon">
            <!-- Replace the file at public/sbadmin2/img/smk-logo.png with your SMK logo (PNG/SVG) -->
            <img src="{{ asset('sbadmin2/img/logo-SMK8.png') }}" alt="SMK Logo" style="width:36px; height:36px; object-fit:contain;">
        </div>
        <div class="sidebar-brand-text mx-3">PENGADUAN SARANA<sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('siswa.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu Siswa
    </div>

    <!-- Nav Item - Input Aspirasi -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('siswa.input-aspirasi') }}">
            <i class="fas fa-fw fa-pen"></i>
            <span>Input Aspirasi</span></a>
    </li>

    <!-- Nav Item - Riwayat Pengaduan -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('siswa.riwayat') }}">
            <i class="fas fa-fw fa-history"></i>
            <span>Riwayat Pengaduan</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Akun
    </div>

    <!-- Nav Item - Logout -->
    <li class="nav-item">
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="nav-link" style="background: none; border: none; color: inherit; padding: 0; cursor: pointer;">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span>
            </button>
        </form>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
