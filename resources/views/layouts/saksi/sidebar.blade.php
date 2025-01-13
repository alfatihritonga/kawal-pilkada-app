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
    <li class="nav-item {{ request()->routeIs('saksi.home') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('saksi.home') }}">
            <i class="fas fa-home"></i>
            <span>Home</span>
        </a>
    </li>
    
    <!-- Divider -->
    <hr class="sidebar-divider">
    
    <!-- Heading -->
    <div class="sidebar-heading">
        Laporan
    </div>
    
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('suara.saksi') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('suara.saksi') }}">
            <i class="fas fa-box"></i>
            <span>Hasil Suara TPS</span>
        </a>
    </li>
    
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('') ? 'active' : '' }}">
        <a class="nav-link" href="">
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
