@extends('layouts.admin.app')

@section('title', 'Data TPS')

@section('content')
<h1 class="h3 mb-0 text-gray-800">TPS</h1>
<p class="mb-4 text-gray-500">Halaman Untuk Mengelola Data TPS</p>

@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Gagal! </strong>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<!-- DataTables -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data TPS</h6>
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
                        <h5 class="modal-title" id="addModalLabel">Tambah Data TPS</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('tps.store') }}" method="POST" id="addForm">
                            @csrf
                            <div class="form-group">
                                <label for="nama" class="font-weight">Nama TPS</label>
                                <input type="text" name="nama" class="form-control" id="nama" value="{{ old('nama') }}" placeholder="masukkan nama tps" required oninput="this.value = this.value.toUpperCase();">
                            </div>
                            <div class="form-group">
                                <label for="kabupaten_kota" class="font-weight">Pilih Kabupaten / Kota</label>
                                <select class="form-control" id="kabupaten_kota" name="kabupaten_kota_id">
                                    <option selected disabled>-- pilih kabupaten/kota --</option>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kecamatan" class="font-weight">Pilih Kecamatan</label>
                                <select class="form-control" id="kecamatan" name="kecamatan_id">
                                    <option selected disabled>-- pilih kecamatan --</option>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kelurahan_desa" class="font-weight">Pilih Kelurahan / Desa</label>
                                <select class="form-control" id="kelurahan_desa" name="kelurahan_desa_id">
                                    <option selected disabled>-- pilih kelurahan/desa --</option>
                                    
                                </select>
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
                        <h5 class="modal-title" id="editModalLabel">Edit Data TPS</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="editForm">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nama" class="font-weight">Nama TPS</label>
                                <input type="text" name="nama" class="form-control" id="nama" value="{{ old('nama') }}" placeholder="masukkan nama kelurahan/desa" required oninput="this.value = this.value.toUpperCase();">
                            </div>
                            <div class="form-group">
                                <label for="kabupaten_kota" class="font-weight">Pilih Kabupaten / Kota</label>
                                <select class="form-control" id="kabupaten_kota" name="kabupaten_kota_id">
                                    <option selected disabled>-- pilih kabupaten/kota --</option>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kecamatan" class="font-weight">Pilih Kecamatan</label>
                                <select class="form-control" id="kecamatan" name="kecamatan_id">
                                    <option selected disabled>-- pilih kecamatan --</option>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kelurahan_desa" class="font-weight">Pilih Kelurahan / Desa</label>
                                <select class="form-control" id="kelurahan_desa" name="kelurahan_desa_id">
                                    <option selected disabled>-- pilih kelurahan/desa --</option>
                                    
                                </select>
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
                        <th>Kabupaten / Kota</th>
                        <th>Kecamatan</th>
                        <th>Kelurahan / Desa</th>
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
</script>

<script>
    $(document).ready(function() {
        // Inisialisasi DataTable
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('tps.data') }}",
            columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nama', name: 'nama' },
            { data: 'kabupaten_kota_nama', name: 'kabupaten_kota_nama', searchable: true },
            { data: 'kecamatan_nama', name: 'kecamatan_nama', searchable: true },
            { data: 'kelurahan_desa_nama', name: 'kelurahan_desa_nama', searchable: true },
            { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
        
        // Simpan setiap data lama
        var oldKabupatenKotaID = '{{ old('kabupaten_kota_id') }}';
        var oldKecamatanID = '{{ old('kecamatan_id') }}';
        var oldKelurahanDesaID = '{{ old('kelurahan_desa_id') }}';
        
        // Panggil API untuk mendapatkan data kabupaten/kota
        $.ajax({
            url: '/api/kabupaten-kota', // Endpoint API
            type: 'GET',
            success: function(data) {
                // Loop data dan tambahkan option ke dalam select
                data.forEach(function(item) {
                    $('#kabupaten_kota').append(`<option value="${item.id}">${item.nama}</option>`);
                    $('#editModal').find('#kabupaten_kota').append(`<option value="${item.id}">${item.nama}</option>`);
                });
                
                // Set nilai default dari old jika ada
                if (oldKabupatenKotaID) {
                    $('#kabupaten_kota').val(oldKabupatenKotaID).trigger('change');
                }
            },
            error: function() {
                alert('Gagal mengambil data kabupaten/kota.');
            }
        });
        
        // AJAX untuk mendapatkan kecamatan berdasarkan kabupaten yang dipilih
        $('#kabupaten_kota').on('change', function() {
            var kabupatenKotaID = $(this).val();
            if (kabupatenKotaID) {
                $.ajax({
                    url: '/api/kecamatan/' + kabupatenKotaID,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#kecamatan').empty().append('<option selected disabled>-- pilih kecamatan --</option>');
                        $.each(data, function(key, value) {
                            $('#kecamatan').append('<option value="' + value.id + '">' + value.nama + '</option>');
                        });
                        if (oldKecamatanID) {
                            $('#kecamatan').val(oldKecamatanID).trigger('change');
                        }
                    }
                });
            } else {
                $('#kecamatan').empty().append('<option selected disabled>-- pilih kecamatan --</option>');
                $('#kelurahan-desa').empty().append('<option selected disabled>-- pilih kelurahan/desa --</option>');
            }
        });
        
        // AJAX untuk mendapatkan kelurahan/desa berdasarkan kecamatan yang dipilih
        $('#kecamatan').on('change', function() {
            var kelurahanDesaID = $(this).val();
            if (kelurahanDesaID) {
                $.ajax({
                    url: '/api/kelurahan-desa/' + kelurahanDesaID,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#kelurahan_desa').empty().append('<option selected disabled>-- pilih kelurahan/desa --</option>');
                        $.each(data, function(key, value) {
                            $('#kelurahan_desa').append('<option value="' + value.id + '">' + value.nama + '</option>');
                        });
                        if (oldKelurahanDesaID) {
                            $('#kelurahan_desa').val(oldKelurahanDesaID).trigger('change');
                        }
                    }
                });
            } else {
                $('#kelurahan_desa').empty().append('<option selected disabled>-- pilih kecamatan --</option>');
            }
        });
        
        // Set event listener untuk update kecamatan saat kabupaten/kota berubah
        $('#editModal').find('#kabupaten_kota').on('change', function() {
            var kabupatenKotaID = $(this).val();
            if (kabupatenKotaID) {
                $.ajax({
                    url: '/api/kecamatan/' + kabupatenKotaID,
                    type: 'GET',
                    success: function(data) {
                        $('#editModal').find('#kecamatan').empty().append('<option selected disabled>-- pilih kecamatan --</option>');
                        data.forEach(function(item) {
                            $('#editModal').find('#kecamatan').append(`<option value="${item.id}">${item.nama}</option>`);
                        });
                        if (oldKecamatanID) {
                            $('#editModal').find('#kecamatan').val(oldKecamatanID).trigger('change');
                        }
                    },
                    error: function() {
                        alert('Gagal mengambil data kecamatan.');
                    }
                });
            }
        });
        
        // Set event listener untuk update kelurahan/desa saat kecamatan berubah
        $('#editModal').find('#kecamatan').on('change', function() {
            var kelurahanDesaID = $(this).val();
            if (kelurahanDesaID) {
                $.ajax({
                    url: '/api/kelurahan-desa/' + kelurahanDesaID,
                    type: 'GET',
                    success: function(data) {
                        $('#editModal').find('#kelurahan_desa').empty().append('<option selected disabled>-- pilih kelurahan/desa --</option>');
                        data.forEach(function(item) {
                            $('#editModal').find('#kelurahan_desa').append(`<option value="${item.id}">${item.nama}</option>`);
                        });
                        if (oldKelurahanDesaID) {
                            $('#editModal').find('#kelurahan_desa').val(oldKelurahanDesaID).trigger('change');
                        }
                    },
                    error: function() {
                        alert('Gagal mengambil data kecamatan.');
                    }
                });
            }
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
        var kelurahan_desa_id = $(button).data('kelurahan_desa_id');
        var kecamatan_id = $(button).data('kecamatan_id');
        var kabupaten_kota_id = $(button).data('kabupaten_kota_id');
        
        // Set nilai nama dan kabupaten/kota di modal
        $('#editModal').find('#nama').val(nama);
        $('#editModal').find('#kabupaten_kota').val(kabupaten_kota_id).trigger('change');
        
        // Setelah kabupaten/kota di-set, atur nilai kecamatan di dropdown kecamatan
        $('#editModal').find('#kabupaten_kota').on('change', function() {
            $('#editModal').find('#kecamatan').val(kecamatan_id).trigger('change');
        });
        
        // Setelah kecamatan di-set, atur nilai kelurahan/desa di dropdown kelurahan/desa
        $('#editModal').find('#kecamatan').on('change', function() {
            $('#editModal').find('#kelurahan_desa').val(kelurahan_desa_id).trigger('change');
        });
        
        // Atur action form berdasarkan ID
        $('#editModal').find('form').attr('action', '{{ route('tps.update', ':id') }}'.replace(':id', id));
        
        // Tampilkan modal
        $('#editModal').modal('show');
    }
</script>

@endsection
