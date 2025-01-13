@extends('layouts.admin.app')

@section('title', 'Data Kabupaten / Kota')

@section('content')
<h1 class="h3 mb-0 text-gray-800">Kabupaten / Kota</h1>
<p class="mb-4 text-gray-500">Halaman Untuk Mengelola Data Kabupaten / Kota</p>

@error('nama_edit')
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Update Gagal! </strong>{{ $message }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@enderror

<!-- DataTables -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Kabupaten / Kota</h6>
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
                        <h5 class="modal-title" id="addModalLabel">Tambah Data Kabupaten / Kota</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('kabupaten-kota.store') }}" method="POST" id="addForm">
                            @csrf
                            <div class="form-group">
                                <label for="nama" class="font-weight">Nama Kabupaten / Kota</label>
                                <input type="text" name="nama" class="form-control" id="nama" value="{{ old('nama') }}" placeholder="masukkan nama kabupaten/kota" required oninput="this.value = this.value.toUpperCase();">
                                @error('nama')
                                <div class="text-danger my-1">
                                    <i>{{ $message }}</i>
                                </div>
                                @enderror
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
        
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Data Kabupaten / Kota</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="editForm">
                            @csrf
                            @method('PUT') <!-- Karena kita akan melakukan update -->
                            <div class="form-group">
                                <label for="nama_edit" class="font-weight">Nama Kabupaten / Kota</label>
                                <input type="text" name="nama_edit" class="form-control" id="nama_edit" value="{{ old('nama_edit') }}" placeholder="masukkan nama kabupaten/kota" required oninput="this.value = this.value.toUpperCase();">
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
            <table style="white-space: nowrap" class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
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
        timer: 2000,
        showConfirmButton: false
    });
    @endif
    
    @error('nama')
    $('#addModal').modal('show');
    @enderror
    
</script>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('kabupaten-kota.data') }}",
            columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nama', name: 'nama' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
    
    // SweetAlert untuk konfirmasi hapus
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
        var nama = $(button).data('nama');
        
        // Masukkan data ke dalam form modal
        $('#editModal').find('#nama_edit').val(nama);
        $('#editModal').find('form').attr('action', '{{ route('kabupaten-kota.update', ':id') }}'.replace(':id', id));
        
        // Tampilkan modal
        $('#editModal').modal('show');
    }
</script>

@endsection
