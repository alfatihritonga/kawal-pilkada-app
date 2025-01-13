<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon">
            <i class="fas fa-vote-yea"></i>
        </div>
    </a>
    
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    
    
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('petugas.index') ? 'active' : '' }}">
        <a class="nav-link" href="">
            <i class="fas fa-users"></i>
            <span>Daftar Saksi</span>
        </a>
    </li>
    
    <!-- Divider -->
    <hr class="sidebar-divider">
    
    <!-- Heading -->
    <div class="sidebar-heading">
        Data
    </div>
    
    <!-- Nav Item - Components Collapse Menu -->
    <li class="nav-item {{ request()->routeIs('kabupaten-kota.index', 'kecamatan.index', 'kelurahan-desa.index', 'tps.index') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-map"></i>
            <span>Daerah Pemilihan</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Kelola Daerah Pemilihan:</h6>
                <a class="collapse-item {{ request()->routeIs('kabupaten-kota.index') ? 'active' : '' }}" href="{{ route('kabupaten-kota.index') }}">Kabupaten / Kota</a>
                <a class="collapse-item {{ request()->routeIs('kecamatan.index') ? 'active' : '' }}" href="{{ route('kecamatan.index') }}">Kecamatan</a>
                <a class="collapse-item {{ request()->routeIs('kelurahan-desa.index') ? 'active' : '' }}" href="{{ route('kelurahan-desa.index') }}">Kelurahan / Desa</a>
                <a class="collapse-item {{ request()->routeIs('tps.index') ? 'active' : '' }}" href="{{ route('tps.index') }}">TPS</a>
            </div>
        </div>
    </li>

    <li class="nav-item {{ request()->routeIs('suara.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('suara.index') }}">
            <i class="fas fa-box"></i>
            <span>Daftar Suara</span>
        </a>
    </li>
    
    
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    
    <!-- Heading -->
    <div class="sidebar-heading">
        Laporan
    </div>
    
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('pemilih.index') ? 'active' : '' }}">
        <a class="nav-link" href=" ">
            <i class="fas fa-vote-yea"></i>
            <span>Real Count</span>
        </a>
    </li>
    
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    
</ul>
<!-- End of Sidebar -->
