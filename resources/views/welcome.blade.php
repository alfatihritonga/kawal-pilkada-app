<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kawal Pilkada | Kabupaten Batu Bara</title>
    
    <!-- Custom fonts and styles for SB Admin 2 -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
</head>
<body id="page-top">
    
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container py-2">
            <span class="navbar-brand mb-0 h1 font-weight-bold">Kawal Pilkada</span>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mx-lg-2 mx-0 my-lg-0 my-1">
                        <a class="nav-link font-weight-bold" href="#about">About</a>
                    </li>
                    <li class="nav-item mx-lg-2 mx-0 my-lg-0 my-1">
                        <a class="nav-link font-weight-bold" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item ml-lg-2 mx-0 my-lg-0 my-1">
                        @if (Auth::user())
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="nav-link font-weight-bold btn btn-light text-primary px-3">Logout</button>
                        </form>
                        @else
                        <a class="nav-link font-weight-bold btn btn-light text-primary px-3" href="{{ route('login') }}"><i class="fas fa-arrow-alt-circle-right pr-2"></i>Login</a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Greeting Section -->
    <header class="text-center" style="height: 100vh; display: flex; align-items: center;">
        <div class="container">
            <h1 class="">Selamat Datang di Kawal Pilkada</h1>
            <p class="h5">Pantau hasil Pemilihan Bupati Batu Bara secara real-time dan akurat.</p>
            <p class="">Kawal Hasil Perhitungan Suara dan jadilah bagian dari kami!</p>
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg mt-2">Kawal Suara</a>
        </div>
    </header>
    
    <!-- About Section -->
    <section id="about" class="py-5 bg-primary text-light" style="height: 100vh; display: flex; align-items: center;">
        <div class="container">
            <h2 class="text-center">Tentang Kawal Pilkada</h2>
            <p class="text-center mt-3">Kawal Pilkada adalah platform digital yang dirancang untuk memantau dan mengawal proses Pilkada Bupati Batu Bara 2024 secara transparan dan real-time. Dengan menggunakan teknologi terbaru, sistem ini memungkinkan masyarakat untuk melihat hasil hitung cepat (quick count) yang akurat dan cepat, serta mengurangi potensi kecurangan dalam pemilu.</p>
        </div>
    </section>
    
    <!-- Contact Section -->
    <section id="contact" class="bg-light py-5" style="height: 100vh; display: flex; align-items: center;">
        <div class="container">
            <h2 class="text-center">Kontak Kami</h2>
            <p class="text-center mt-3">Untuk informasi lebih lanjut, silakan hubungi kami:</p>
            <div class="row justify-content-center mt-4">
                <div class="col-md-4 text-center">
                    <i class="fas fa-envelope fa-2x text-primary mb-2"></i>
                    <p>Email: support@kawalpilkada.com</p>
                </div>
                <div class="col-md-4 text-center">
                    <i class="fas fa-phone fa-2x text-primary mb-2"></i>
                    <p>Telepon: +62 123 456 789</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4">
        <div class="container">
            <p>Copyright &copy; 2024 Kawal Pilkada. All Rights Reserved.</p>
        </div>
    </footer>
    
    <!-- JavaScript for Bootstrap and SB Admin 2 -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>
</html>
