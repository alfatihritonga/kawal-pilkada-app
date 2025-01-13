@extends('layouts.admin.app')

@section('title', 'Data Suara')

@section('content')
<h1 class="h3 mb-0 text-gray-800">Data Suara</h1>
<p class="mb-4 text-gray-500">Halaman Untuk Mengelola Data Suara</p>

<!-- DataTables -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Suara</h6>
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
                        <h5 class="modal-title" id="addModalLabel">Input Data Suara Hasil C1</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('suara.store') }}" method="POST" id="addForm" enctype="multipart/form-data">
                            @csrf
                            <div class="card mb-3">
                                <div class="card-header bg-primary py-3">
                                    <h6 class="m-0 font-weight-bold text-white">Data Daerah Pemilihan</h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="kabupaten_kota" class="font-weight-bold">Pilih Kabupaten / Kota</label>
                                        <select class="form-control" id="kabupaten_kota" name="kabupaten_kota_id">
                                            <option selected disabled>-- pilih kabupaten/kota --</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="kecamatan" class="font-weight-bold">Pilih Kecamatan</label>
                                        <select class="form-control" id="kecamatan" name="kecamatan_id">
                                            <option selected disabled>-- pilih kecamatan --</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="kelurahan_desa" class="font-weight-bold">Pilih Kelurahan / Desa</label>
                                        <select class="form-control" id="kelurahan_desa" name="kelurahan_desa_id">
                                            <option selected disabled>-- pilih kelurahan/desa --</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tps" class="font-weight-bold">Pilih TPS</label>
                                        <select class="form-control" id="tps" name="tps_id">
                                            <option selected disabled>-- pilih tps --</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-header bg-primary py-3">
                                    <h6 class="m-0 font-weight-bold text-white">Data Hasil C1</h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="form_c1" class="font-weight-bold">Photo C1</label>
                                        <input type="file" name="form_c1" id="form_c1" class="form-control-file" required accept="image/*" onchange="previewImage(event)">
                                        
                                        <img id="preview" src="#" alt="Preview Gambar C1" style="display: none; max-width: 300px; margin-top: 10px; max-width: 100%">
                                    </div>
                                    <div class="form-group" id="jumlah-suara" style="display: none">
                                        <label class="font-weight-bold">Masukkan Jumlah Suara Paslon</label>
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>Darwis - Oky</td>
                                                <td>
                                                    <input type="number" name="suara_darwis" id="suara_darwis" class="form-control" value="{{ old('suara_darwis') }}" min="0" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Baharuddin - Syafrizal</td>
                                                <td>
                                                    <input type="number" name="suara_baharuddin" id="suara_baharuddin" class="form-control" value="{{ old('suara_baharuddin') }}" min="0" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Zahir - Aslam</td>
                                                <td>
                                                    <input type="number" name="suara_zahir" id="suara_zahir" class="form-control" value="{{ old('suara_zahir') }}" min="0" required>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="sumbit" class="btn btn-success" form="addForm">Kirim</button>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Modal Detail Data --}}
        <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Detail Data Suara Hasil C1</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item" id="kabupaten_kota_nama">Kabupaten Batu Bara</a></li>
                                <li class="breadcrumb-item" id="kecamatan_nama">AIR PUTIH</li>
                                <li class="breadcrumb-item" id="kelurahan_desa_nama">ARAS</li>
                                <li class="breadcrumb-item" id="tps_nama">TPS 1</li>
                            </ol>
                        </nav>

                        <img id="filepath_form_c1" src="" alt="Gambar C1" class="img-fluid mb-3">

                        <table id="data_suara" class="table table-bordered">
                            <tr>
                                <td>Darwis - Oky</td>
                                <td id="suara_darwis"></td>
                            </tr>
                            <tr>
                                <td>Baharuddin - Syafrizal</td>
                                <td id="suara_baharuddin"></td>
                            </tr>
                            <tr>
                                <td>Zahir - Aslam</td>
                                <td id="suara_zahir"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>TPS</th>
                        <th>Kelurahan/Desa</th>
                        <th>Darwis</th>
                        <th>Baharuddin</th>
                        <th>Zahir</th>
                        <th>Status</th>
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
    
    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('preview');
        const jumlahSuara = document.getElementById('jumlah-suara');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                jumlahSuara.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = "#";
            preview.style.display = 'none';
            jumlahSuara.style.display = 'none';
        }
    }
</script>

<script>
    $(document).ready(function() {
        // Inisialisasi DataTable
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true, 
            ajax: "{{ route('suara.data') }}",
            columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'tps_nama', name: 'tps_nama' },
            { data: 'kelurahan_desa_nama', name: 'kelurahan_desa_nama' },
            { data: 'suara_darwis', name: 'suara_darwis' },
            { data: 'suara_baharuddin', name: 'suara_baharuddin' },
            { data: 'suara_zahir', name: 'suara_zahir' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action' },
            ]
        });
        
        // Simpan setiap data lama
        var oldKabupatenKotaID = '{{ old('kabupaten_kota_id') }}';
        var oldKecamatanID = '{{ old('kecamatan_id') }}';
        var oldKelurahanDesaID = '{{ old('kelurahan_desa_id') }}';
        var oldTpsID = '{{ old('tps_id') }}';
        
        // Panggil API untuk mendapatkan data kabupaten/kota
        $.ajax({
            url: '/api/kabupaten-kota', // Endpoint API
            type: 'GET',
            success: function(data) {
                // Loop data dan tambahkan option ke dalam select
                data.forEach(function(item) {
                    $('#kabupaten_kota').append(`<option value="${item.id}">${item.nama}</option>`);
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
        
        // AJAX untuk mendapatkan tps berdasarkan kelurahan/desa yang dipilih
        $('#kelurahan_desa').on('change', function() {
            var kelurahanDesaID = $(this).val();
            if (kelurahanDesaID) {
                $.ajax({
                    url: '/api/tps/' + kelurahanDesaID,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#tps').empty().append('<option selected disabled>-- pilih tps --</option>');
                        $.each(data, function(key, value) {
                            $('#tps').append('<option value="' + value.id + '">' + value.nama + '</option>');
                        });
                        if (oldKelurahanDesaID) {
                            $('#tps').val(oldKelurahanDesaID).trigger('change');
                        }
                    }
                });
            } else {
                $('#tps').empty().append('<option selected disabled>-- pilih tps --</option>');
            }
        });
    });
    
    
    
    $(document).on('click', '.lihat-detail', function() {
        var id = $(this).data('id');
        
        $.ajax({
            url: 'suara/' + id,
            method: 'GET',
            success: function(data) {
                // Mengisi data breadcrumb
                $('#kabupaten_kota_nama').text(data.kabupaten_kota_nama);
                $('#kecamatan_nama').text(data.kecamatan_nama);
                $('#kelurahan_desa_nama').text(data.kelurahan_desa_nama);
                $('#tps_nama').text(data.tps_nama);
                
                // Mengisi data gambar
                $('#filepath_form_c1').attr('src', data.filepath_form_c1);
                
                // Mengisi data suara untuk masing-masing kandidat
                $('#detailModal').find('#suara_darwis').text(data.suara_darwis);
                $('#detailModal').find('#suara_baharuddin').text(data.suara_baharuddin);
                $('#detailModal').find('#suara_zahir').text(data.suara_zahir);
                
                // Tampilkan modal
                $('#detailModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error('Error: ' + error);
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
        var nik = $(button).data('nik');
        var nama = $(button).data('nama');
        var alamat = $(button).data('alamat');
        var nomor_hp = $(button).data('nomor_hp');
        var oldPetugasID = $(button).data('petugas_id');
        
        // Masukkan data ke dalam form modal
        $('#editModal').find('#nik').val(nik);
        $('#editModal').find('#nama').val(nama);
        $('#editModal').find('#alamat').val(alamat);
        $('#editModal').find('#nomor_hp').val(nomor_hp);
        $('#editModal').find('form').attr('action', '/admin/pemilih/update/' + id); // Set action form untuk mengupdate data
        
        // Tampilkan modal
        $('#editModal').modal('show');
    }
</script>

@endsection
