@extends('layouts.operator.app')

@section('title', 'Dafar Saksi | Kawal Pilkada')

@section('content')
<h1 class="h3 mb-0 text-gray-800">Daftar Saksi</h1>
<p class="mb-4 text-gray-500">Halaman Untuk Mengelola Data Saksi</p>

<!-- DataTables -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Saksi</h6>
    </div>
    <div class="card-body">
        <button type="button" class="btn btn-success btn-sm px-3 py-2 mb-3" data-toggle="modal" data-target="#addModal">
            <i class="fas fa-plus mr-2"></i>Tambah
        </button>
        
        {{-- Modal Add Data --}}
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Tambah Saksi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('registrasi.saksi') }}" method="POST" id="addForm" enctype="multipart/form-data">
                            @csrf
                            <div class="card mb-3">
                                <div class="card-header bg-primary py-3">
                                    <h6 class="m-0 font-weight-bold text-white">Data Akun</h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="username" class="font-weight">Username</label>
                                        <input type="text" name="username" id="username" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="font-weight">Password</label>
                                        <input type="password" name="password" id="password" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-header bg-primary py-3">
                                    <h6 class="m-0 font-weight-bold text-white">Data Pribadi</h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" name="nama" id="nama" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nomor_hp" class="font-weight">Nomor Handphone</label>
                                        <input type="tel" name="nomor_hp" id="nomor_hp" class="form-control" maxlength="13">
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat" class="font-weight">Alamat</label>
                                        <textarea name="alamat" id="alamat" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-header bg-primary py-3">
                                    <h6 class="m-0 font-weight-bold text-white">Daerah Pemilihan</h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="kecamatan" class="font-weight-bold">Kecamatan</label>
                                        <select class="form-control" id="kecamatan" name="kecamatan_id">
                                            <option selected disabled>-- pilih kecamatan --</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="sumbit" class="btn btn-success" form="addForm">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <!-- <th>Password</th> -->
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        timer: 2000,
        showConfirmButton: false
    });
    @endif
</script>

<script>
    $(document).ready(function() {
        // Inisialisasi DataTable
        $('#dataTable').DataTable({
                processing: true,
                serverSide: true, 
                ajax: "{{ route('operator.saksi.data') }}",
                columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'nama', name: 'nama' },
                { data: 'username', name: 'username' },
                // { data: 'password', name: 'password' },
                ]
            });
            
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
    @endsection
    