<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lengkapi Profile | Kawal Pilkada</title>
    
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
                    <li class="nav-item mx-lg-2 mx-0 my-lg-0 my-1">
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn bg-light text-dark">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="py-4"></div>
    
    <section id="loginForm" class="d-flex justify-content-center align-items-center h-100 vh-100">
        <div class="container">
            <div class="card">
                <div class="card-header text-center py-4">
                    <h4 class="mb-0 fw-bold">Lengkapi Profile</h4>
                </div>
                <div class="card-body px-4">
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <!-- Menampilkan Pesan Sukses -->
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    
                    <form action="{{ route('profile.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="nomor_hp">Nomor Handphone</label>
                            <input type="tel" name="nomor_hp" id="nomor_hp" class="form-control" value="{{ old('nomor_hp') }}" maxlength="13">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control" rows="3">{{ old('alamat') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="kecamatan">Kecamatan</label>
                            <select class="form-control" id="kecamatan" name="kecamatan_id">
                                <option selected disabled>-- pilih kecamatan --</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Kirim</button>
                    </form>
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
    
    <script>
        $(document).ready(function () {
            $.ajax({
                url: '/api/kecamatan',
                type: 'GET',
                success: function(data) {
                    // Loop data dan tambahkan option ke dalam select
                    data.forEach(function(item) {
                        $('#kecamatan').append(`<option value="${item.id}">${item.nama}</option>`);
                    });
                },
                error: function() {
                    alert('Gagal mengambil data kecamatan.');
                }
            });
        });
    </script>
</body>
</html>
