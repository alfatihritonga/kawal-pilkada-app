<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kawal Pilkada | Login</title>
    
    <!-- Custom fonts and styles for SB Admin 2 -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
</head>
<body id="page-top">
    
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container py-2">
            <span class="navbar-brand font-weight-bold mb-0 h1">Kawal Pilkada</span>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mx-lg-2 mx-0 my-lg-0 my-1">
                        <a class="nav-link font-weight-bold" href="/">Kembali ke Halaman Utama</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <section id="loginForm" class="d-flex align-items-center" style="height: 100vh">
        <div class="container">
            <div class="card">
                <div class="card-header text-center py-4">
                    <h4 class="mb-0 fw-bold">Login</h4>
                </div>
                <div class="card-body px-4">
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <!-- Menampilkan Pesan Sukses -->
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="username" class="font-weight">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}" placeholder="masukkan username anda" required>
                            @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="font-weight">Password</label>
                            <input type="password" name="password" id="password" class="form-control" value="{{ old('password') }}" placeholder="masukkan password anda" required>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success w-100">Login</button>
                    </form>
                    <span class="d-block my-2">Belum punya akun? <a href="{{ route('register') }}">Registrasi disini.</a></span>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4">
        <div class="container">
            <p>&copy; 2024 SiPilih. All Rights Reserved.</p>
        </div>
    </footer>
    
    <!-- JavaScript for Bootstrap and SB Admin 2 -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>
</html>
