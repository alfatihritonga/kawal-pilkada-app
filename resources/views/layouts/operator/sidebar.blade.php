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
    <li class="nav-item {{ request()->routeIs('operator.home') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('operator.home') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>Beranda</span>
        </a>
    </li>
    
    
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('operator.saksi') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('operator.saksi') }}">
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

    <li class="nav-item {{ request()->routeIs('operator.suara') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('operator.suara') }}">
            <i class="fas fa-box"></i>
            <span>Hasil Suara TPS</span>
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
