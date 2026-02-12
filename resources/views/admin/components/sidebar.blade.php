<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('sbadmin2/img/logo-SMK8.png') }}" alt="SMK Logo" style="width:36px; height:36px; object-fit:contain;">
        </div>
        <div class="sidebar-brand-text mx-3">ADMIN<sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @if(request()->routeIs('admin.dashboard')) active @endif">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Master Data
    </div>

    <!-- Nav Item - Manajemen Siswa -->
    <li class="nav-item @if(request()->routeIs('admin.siswa.*')) active @endif">
        <a class="nav-link" href="{{ route('admin.siswa.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Manajemen Siswa</span>
        </a>
    </li>

    <!-- Nav Item - Manajemen Kategori -->
    <li class="nav-item @if(request()->routeIs('admin.kategori.*')) active @endif">
        <a class="nav-link" href="{{ route('admin.kategori.index') }}">
            <i class="fas fa-fw fa-list"></i>
            <span>Manajemen Kategori</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data Pengaduan
    </div>

    <!-- Nav Item - Pengaduan -->
    <li class="nav-item @if(request()->routeIs('admin.pengaduan.*')) active @endif">
        <a class="nav-link" href="{{ route('admin.pengaduan.index') }}">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Pengaduan</span>
        </a>
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
            <button type="submit" class="nav-link" style="background: none; border: none; color: inherit; padding: 0; cursor: pointer; text-align: left; width: 100%;">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span class="text-white">Keluar</span>
            </button>
        </form>
    </li>

    <!-- Divider at bottom -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggle (Topbar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
