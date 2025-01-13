<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    
    <!-- Sidebar Toggle (Topbar) -->
    @if (Auth::user()->roles()->where('nama', 'saksi')->exists())
    
    @else
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars text-primary"></i>
    </button>
    @endif

    <!-- Centered Brand Image -->
    <div class="mx-auto d-flex align-items-center">
        {{-- <img src="{{ asset('img/undraw_posting_photo.svg') }}" alt="Brand Logo" class="img-fluid" style="height: 40px;"> --}}
        <h1 class="h5 d-md-none mb-0 text-primary font-weight-bold">Kawal Pilkada</h1>
        <h1 class="h3 d-md-block d-none mb-0 text-primary font-weight-bold">Kawal Pilkada</h1>
    </div>
    
    <!-- Topbar Navbar -->
    <ul class="navbar-nav">
        
        <div class="topbar-divider d-none d-sm-block"></div>
        
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->profile->nama ?? 'no profile' }}</span>
                <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
        
    </ul>
    
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn bg-primary text-white">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</nav>
<!-- End of Topbar -->
