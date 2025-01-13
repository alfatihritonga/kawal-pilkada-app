@extends('layouts.operator.app')

@section('title', 'Hasil Suara TPS | Kawal Pilkada')

@section('content')
<h1 class="h3 mb-0 text-gray-800">Hasil Suara TPS</h1>
<p class="mb-4 text-gray-500">Halaman Untuk Mengelola Hasil Suara TPS</p>

<!-- DataTables -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Hasil Suara TPS</h6>
    </div>
    <div class="card-body">
        
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

{{-- Modal Detail Data --}}
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Hasil Suara TPS</h5>
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
                <div class="dropdown">
                    <button class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                        Status
                    </button>
                    <div class="dropdown-menu">
                        <form action="{{ route('operator.suara.validasi') }}" id="pending" method="POST" hidden>
                            @csrf
                            <input type="hidden" name="status" value="pending">
                            <input type="hidden" name="suara_id" id="suara_id_1" value="">
                        </form>
                        <form action="{{ route('operator.suara.validasi') }}" id="valid" method="POST" hidden>
                            @csrf
                            <input type="hidden" name="status" value="valid">
                            <input type="hidden" name="suara_id" id="suara_id_2" value="">
                        </form>
                        <form action="{{ route('operator.suara.validasi') }}" id="invalid" method="POST" hidden>
                            @csrf
                            <input type="hidden" name="status" value="invalid">
                            <input type="hidden" name="suara_id" id="suara_id_3" value="">
                        </form>
                        
                        <button type="submit" class="dropdown-item" form="pending">Pending</button>
                        <button type="submit" class="dropdown-item" form="valid">Valid</button>
                        <button type="submit" class="dropdown-item" form="invalid">Invalid</button>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
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
            ajax: "{{ route('operator.suara.data') }}",
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
                
                // Isi input hidden suara_id di form status
                $('#suara_id_1').val(id);
                $('#suara_id_2').val(id);
                $('#suara_id_3').val(id);

                // Tampilkan modal
                $('#detailModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error('Error: ' + error);
            }
        });
    });
</script>

@endsection
