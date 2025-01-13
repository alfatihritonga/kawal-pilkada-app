@extends('layouts.saksi.app')

@section('title', 'Beranda | Kawal Pilkada')

@section('content')
<h1 class="h4 mb-0 text-gray-800 font-weight-bold">Halo, {{ Auth::user()->profile->nama ?? 'no profile' }}!</h1>
<p class="mb-4 text-gray-500">Kawal Pilkada Batu Bara dengan menjaga tps dan formulir c1</p>

<div class="row">
    {{-- <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daerah Pemilihan Anda</h6>
            </div>
            <div class="card-body">
                @if (Auth::user()->hasTps())    
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        <div class="card bg-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="h5 mb-0 font-weight-bold text-white">KABUPATEN <br> BATU BARA</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-map fa-2x text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body position-relative">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ Auth::user()->tpsUser->tps->kelurahanDesa->kecamatan->nama }} \ {{ Auth::user()->tpsUser->tps->kelurahanDesa->nama }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ Auth::user()->tpsUser->tps->nama }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-database fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="card border border-secondary shadow py-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h4 class="h5 text-center d-none d-md-block">Daerah Pemilihan belum dipilih, pilih sekarang?</h4>
                                <h4 class="h6 text-center d-block d-md-none">Daerah Pemilihan belum dipilih, pilih sekarang?</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                <a href="{{ route('saksi.tps') }}" class="btn btn-success px-4 mt-2">Pilih Dapil</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div> --}}
    <div class="col-md-4">
        <div class="card shadow mb-4 p-4">
            <div class="card-body py-4" style="border-width: 2px; border-style: dashed; border-radius: 6px">
                {{-- <a href="{{ route('suara.saksi') }}" class="stretched-link"></a> --}}
                <h4 class="h5 text-center d-none d-md-block">Input hasil perhitungan suara tps</h4>
                <h4 class="h6 text-center d-block d-md-none">Input hasil perhitungan suara tps</h4>
                <button class="btn btn-success w-100" type="button" data-toggle="modal" data-target="#addSuaraModal">
                    <i class="fas fa-plus mr-2 "></i>Input
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow mb-4 p-4">
            <div class="card-body py-4" style="border-width: 2px; border-style: dashed; border-radius: 6px">
                {{-- <a href="{{ route('suara.saksi') }}" class="stretched-link"></a> --}}
                <h4 class="h5 text-center d-none d-md-block">Foto C1 hasil hitung suara tps</h4>
                <h4 class="h6 text-center d-block d-md-none">Foto C1 hasil hitung suara tps</h4>
                <button class="btn btn-success w-100" type="button" data-toggle="modal" data-target="#addC1Modal">
                    <i class="fas fa-camera mr-2 "></i>Foto
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Add Data --}}
<div class="modal fade" id="addSuaraModal" tabindex="-1" aria-labelledby="addSuaraModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSuaraModalLabel">Input Hasil Suara TPS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('suara.store') }}" method="POST" id="addForm" enctype="multipart/form-data">
                    @csrf
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
                            <div class="form-group">
                                <label for="kelurahan_desa" class="font-weight-bold">Kelurahan / Desa</label>
                                <select class="form-control" id="kelurahan_desa" name="kelurahan_desa_id">
                                    <option selected disabled>-- pilih kelurahan/desa --</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tps" class="font-weight-bold">TPS</label>
                                <select class="form-control" id="tps" name="tps_id">
                                    <option selected disabled>-- pilih tps --</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header bg-primary py-3">
                            <h6 class="m-0 font-weight-bold text-white">Hasil Hitung Suara</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group" id="jumlah-suara">
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

{{-- Modal Add C1 --}}
<div class="modal fade" id="addC1Modal" tabindex="-1" aria-labelledby="addC1ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addC1ModalLabel">Foto Formulir C1</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('suara.store.c1') }}" method="POST" id="addC1" enctype="multipart/form-data">
                    @csrf
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
                            <div class="form-group">
                                <label for="kelurahan_desa" class="font-weight-bold">Kelurahan / Desa</label>
                                <select class="form-control" id="kelurahan_desa" name="kelurahan_desa_id">
                                    <option selected disabled>-- pilih kelurahan/desa --</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tps" class="font-weight-bold">TPS</label>
                                <select class="form-control" id="tps" name="tps_id">
                                    <option selected disabled>-- pilih tps --</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header bg-primary py-3">
                            <h6 class="m-0 font-weight-bold text-white">Foto Formulir C1</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="form_c1" class="font-weight-bold">Foto C1</label>
                                <input type="file" name="form_c1" id="form_c1" class="form-control-file" required accept="image/*" onchange="previewImage(event)">
                                
                                <img id="preview" src="#" alt="Preview Gambar C1" style="display: none; max-width: 300px; margin-top: 10px; max-width: 100%">
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="sumbit" class="btn btn-success" form="addC1">Kirim</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Hasil Suara TPS</h6>
    </div>
    <div class="card-body">
        
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>TPS</th>
                        <th>Kelurahan/Desa</th>
                        <th>Kecamatan</th>
                        <th>Darwis</th>
                        <th>Baharuddin</th>
                        <th>Zahir</th>
                        <th>Foto C1</th>
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
    
    @if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Oops...!',
        text: "{{ session('error') }}",
        timer: 2000,
        showConfirmButton: false
    });
    @endif
    
    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('preview');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = "#";
            preview.style.display = 'none';
        }
    }
</script>

<script>
    $(document).ready(function() {
        // Inisialisasi DataTable
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true, 
            ajax: "{{ route('suara.saksi.data') }}",
            columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'tps_nama', name: 'tps_nama' },
            { data: 'kelurahan_desa_nama', name: 'kelurahan_desa_nama' },
            { data: 'kecamatan_nama', name: 'kecamatan_nama' },
            { data: 'suara_darwis', name: 'suara_darwis' },
            { data: 'suara_baharuddin', name: 'suara_baharuddin' },
            { data: 'suara_zahir', name: 'suara_zahir' },
            { data: 'form_c1', name: 'form_c1' },
            ]
        });
        
        $.ajax({
            url: '/api/kecamatan',
            type: 'GET',
            success: function(data) {
                // Loop data dan tambahkan option ke dalam select
                data.forEach(function(item) {
                    $('#kecamatan').append(`<option value="${item.id}">${item.nama}</option>`);
                    $('#addC1Modal').find('#kecamatan').append(`<option value="${item.id}">${item.nama}</option>`);
                });
            },
            error: function() {
                alert('Gagal mengambil data kecamatan.');
            }
        });
        
        $('#kecamatan').on('change', function() {
            var kecamatanID = $(this).val();
            if (kecamatanID) {
                $.ajax({
                    url: '/api/kelurahan-desa/' + kecamatanID,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#kelurahan_desa').empty().append('<option selected disabled>-- pilih kelurahan/desa --</option>');
                        $.each(data, function(key, value) {
                            $('#kelurahan_desa').append('<option value="' + value.id + '">' + value.nama + '</option>');
                        });
                    }
                });
            } else {
                $('#kelurahan_desa').empty().append('<option selected disabled>-- pilih kecamatan --</option>');
            }
        });
        
        $('#addC1Modal').find('#kecamatan').on('change', function() {
            var kecamatanID = $(this).val();
            if (kecamatanID) {
                $.ajax({
                    url: '/api/kelurahan-desa/' + kecamatanID,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#addC1Modal').find('#kelurahan_desa').empty().append('<option selected disabled>-- pilih kelurahan/desa --</option>');
                        $.each(data, function(key, value) {
                            $('#addC1Modal').find('#kelurahan_desa').append('<option value="' + value.id + '">' + value.nama + '</option>');
                        });
                    }
                });
            } else {
                $('#addC1Modal').find('#kelurahan_desa').empty().append('<option selected disabled>-- pilih kecamatan --</option>');
            }
        });
        
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
                    }
                });
            } else {
                $('#tps').empty().append('<option selected disabled>-- pilih tps --</option>');
            }
        });
        
        $('#addC1Modal').find('#kelurahan_desa').on('change', function() {
            var kelurahanDesaID = $(this).val();
            if (kelurahanDesaID) {
                $.ajax({
                    url: '/api/tps/' + kelurahanDesaID,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#addC1Modal').find('#tps').empty().append('<option selected disabled>-- pilih tps --</option>');
                        $.each(data, function(key, value) {
                            $('#addC1Modal').find('#tps').append('<option value="' + value.id + '">' + value.nama + '</option>');
                        });
                    }
                });
            } else {
                $('#addC1Modal').find('#tps').empty().append('<option selected disabled>-- pilih tps --</option>');
            }
        });
    });
</script>

@endsection
