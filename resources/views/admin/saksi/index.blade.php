@extends('layouts.admin.app')

@section('title', 'Admin | Manage Petugas')

@section('content')
<h1 class="h3 mb-0 text-gray-800">Manage Petugas</h1>
<p class="mb-4 text-gray-500">Halaman Untuk Mengelola Data Petugas</p>

<!-- DataTables -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-danger">Data Petugas</h6>
    </div>
    <div class="card-body">
        <button type="button" class="btn btn-success btn-sm px-3 py-2 mb-3" data-toggle="modal" data-target="#addModal">
            <i class="fas fa-plus mr-2"></i>Tambah Data
        </button>
        
        {{-- Modal Add Data --}}
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Tambah Data Petugas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('petugas.store') }}" method="POST" id="addForm" enctype="multipart/form-data">
                            @csrf
                            <div class="card mb-3">
                                <div class="card-header bg-danger py-3">
                                    <h6 class="m-0 font-weight-bold text-white">Data Petugas</h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nik" class="font-weight">NIK</label>
                                        <input type="tel" name="nik" class="form-control" id="nik" value="{{ old('nik') }}" placeholder="masukkan nik petugas" required maxlength="16">
                                        @error('nik')
                                        <div class="text-danger my-1">
                                            <i>{{ $message }}</i>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="nama" class="font-weight">Nama Lengkap</label>
                                        <input type="text" name="nama" class="form-control" id="nama" value="{{ old('nama') }}" placeholder="masukkan nama lengkap petugas" required oninput="this.value = this.value.toUpperCase();">
                                        @error('nama')
                                        <div class="text-danger my-1">
                                            <i>{{ $message }}</i>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat" class="font-weight">Alamat</label>
                                        <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="2" required></textarea>
                                        @error('alamat')
                                        <div class="text-danger my-1">
                                            <i>{{ $message }}</i>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="nomor_hp" class="font-weight">Nomor HP</label>
                                        <input type="tel" pattern="[0-9]{10,13}" name="nomor_hp" class="form-control" id="nomor_hp" value="{{ old('nomor_hp') }}" placeholder="masukkan nomor hp petugas" required>
                                        @error('nomor_hp')
                                        <div class="text-danger my-1">
                                            <i>{{ $message }}</i>
                                        </div>
                                        @enderror
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
        
        {{-- Modal Edit Data --}}
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Data Petugas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="editForm">
                            @csrf
                            @method('PUT') <!-- Karena kita akan melakukan update -->
                            <div class="form-group">
                                <label for="nik" class="font-weight">NIK</label>
                                <input type="tel" name="nik" class="form-control" id="nik" value="{{ old('nik') }}" placeholder="masukkan nik petugas" required maxlength="16">
                                @error('nik')
                                <div class="text-danger my-1">
                                    <i>{{ $message }}</i>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama" class="font-weight">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" id="nama" value="{{ old('nama') }}" placeholder="masukkan nama lengkap petugas" required oninput="this.value = this.value.toUpperCase();">
                                @error('nama')
                                <div class="text-danger my-1">
                                    <i>{{ $message }}</i>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="font-weight">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="2" required></textarea>
                                @error('alamat')
                                <div class="text-danger my-1">
                                    <i>{{ $message }}</i>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nomor_hp" class="font-weight">Nomor HP</label>
                                <input type="tel" pattern="[0-9]{10,13}" name="nomor_hp" class="form-control" id="nomor_hp" value="{{ old('nomor_hp') }}" placeholder="masukkan nomor hp petugas" required>
                                @error('nomor_hp')
                                <div class="text-danger my-1">
                                    <i>{{ $message }}</i>
                                </div>
                                @enderror
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success" form="editForm">Ubah</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No. Hp</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        timer: 2200,
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
            ajax: "{{ route('petugas.data') }}",
            columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nik', name: 'nik' },
            { data: 'nama', name: 'nama' },
            { data: 'alamat', name: 'alamat' },
            { data: 'nomor_hp', name: 'nomor_hp' },
            { data: 'action', name: 'action' },
            ]
        });
    });


    function deleteData(event, url, nama) {
        event.preventDefault();
        
        Swal.fire({
            title: 'Anda yakin?',
            text: `Data ${nama} akan dihapus dan tidak dapat dikembalikan!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Kirim form penghapusan jika user mengonfirmasi
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        "_method": "DELETE",
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        Swal.fire(
                        'Terhapus!',
                        `Data ${nama} telah dihapus.`,
                        'success'
                        ).then(() => {
                            $('#dataTable').DataTable().ajax.reload(); // Reload data di DataTable
                        });
                    },
                    error: function(error) {
                        Swal.fire(
                        'Gagal!',
                        'Terjadi kesalahan saat menghapus data.',
                        'error'
                        );
                    }
                });
            }
        });
    }
    
    function editData(button) {
        var id = $(button).data('id');
        var nik = $(button).data('nik');
        var nama = $(button).data('nama');
        var alamat = $(button).data('alamat');
        var nomor_hp = $(button).data('nomor_hp');
        
        // Masukkan data ke dalam form modal
        $('#editModal').find('#nik').val(nik);
        $('#editModal').find('#nama').val(nama);
        $('#editModal').find('#alamat').val(alamat);
        $('#editModal').find('#nomor_hp').val(nomor_hp);
        $('#editModal').find('form').attr('action', '/admin/manage/petugas/update/' + id); // Set action form untuk mengupdate data
        
        // Tampilkan modal
        $('#editModal').modal('show');
    }
</script>
@endsection
