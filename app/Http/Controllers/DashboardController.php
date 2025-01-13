<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\KelurahanDesa;
use App\Models\Suara;
use App\Models\Tps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
    
    public function dataTotalDapil()
    {
        // Jumlah data berdasarkan daerah pemilihan
        $jlhKecamatan = Kecamatan::count();
        $jlhKelurahanDesa = KelurahanDesa::count();
        $jlhTps = Tps::count();
        
        $dataDapil = [
            'jlhKecamatan' => $jlhKecamatan,
            'jlhKelurahanDesa' => $jlhKelurahanDesa,
            'jlhTps' => $jlhTps,
        ];
        
        return response()->json($dataDapil);
    }
    
    public function dataTotalSuaraPaslon()
    {
        $totalSuaraPaslon = [
            'darwis_oky' => $this->getTotalSuaraPaslon('suara_darwis'),
            'baharuddin_syafrizal' => $this->getTotalSuaraPaslon('suara_baharuddin'),
            'zahir_aslam' => $this->getTotalSuaraPaslon('suara_zahir'),
        ];
        
        return response()->json($totalSuaraPaslon);
    }
    
    private function getTotalSuaraPaslon($suaraPaslon)
    {
        // Pastikan bahwa kolom yang diminta memang ada di tabel suaras
        if (!in_array($suaraPaslon, ['suara_darwis', 'suara_baharuddin', 'suara_zahir'])) {
            throw new InvalidArgumentException("Kolom $suaraPaslon tidak valid.");
        }
        
        // Menghitung total suara berdasarkan kolom yang diberikan
        return DB::table('suaras')->where('status', 'valid')->sum($suaraPaslon);
    }
    
    public function dataPersentaseSuaraPaslon()
    {
        $totalSuaraDarwis = $this->getTotalSuaraPaslon('suara_darwis');
        $totalSuaraBaharuddin= $this->getTotalSuaraPaslon('suara_baharuddin');
        $totalSuaraZahir = $this->getTotalSuaraPaslon('suara_zahir');
        
        $totalSuara = $totalSuaraDarwis + $totalSuaraBaharuddin + $totalSuaraZahir;
        
        $persentasePaslon = [
            'persentaseDarwis' => $totalSuara > 0 ? round(($totalSuaraDarwis / $totalSuara) * 100, 2) : 0,
            'persentaseBaharuddin' => $totalSuara > 0 ? round(($totalSuaraBaharuddin / $totalSuara) * 100, 2) : 0,
            'persentaseZahir' => $totalSuara > 0 ? round(($totalSuaraZahir / $totalSuara) * 100, 2) : 0,
        ];
        
        return response()->json($persentasePaslon);
    }
    
    public function dataPersentasePerKecamatan()
    {
        $listKecamatan = Kecamatan::select(['id', 'nama'])->get();
        
        $dataSuara = Suara::with(['tps' => function ($query) {
            $query->select(['id', 'nama', 'kelurahan_desa_id']);
        },
        'tps.kelurahanDesa' => function ($query) {
            $query->select(['id', 'nama', 'kecamatan_id']);
        },
        'tps.kelurahanDesa.kecamatan' => function ($query) {
            $query->select(['id', 'nama']);
        }
        ])->select(['tps_id', 'suara_darwis', 'suara_baharuddin', 'suara_zahir'])
        ->where('status', 'valid')
        ->get();
        
        
        $persentasePerKecamatan = [];
        
        // Inisialisasi semua kecamatan dengan 0%
        foreach ($listKecamatan as $kecamatan) {
            $persentasePerKecamatan[$kecamatan->nama] = [
                'total_darwis' => 0,
                'total_baharuddin' => 0,
                'total_zahir' => 0,
                'total_suara' => 0,
            ];
        }
        
        // Kelompokkan total suara per kecamatan
        foreach ($dataSuara as $suara) {
            $kecamatan = $suara->tps->kelurahanDesa->kecamatan;
            
            $persentasePerKecamatan[$kecamatan->nama]['total_darwis'] += $suara->suara_darwis;
            $persentasePerKecamatan[$kecamatan->nama]['total_baharuddin'] += $suara->suara_baharuddin;
            $persentasePerKecamatan[$kecamatan->nama]['total_zahir'] += $suara->suara_zahir;
            $persentasePerKecamatan[$kecamatan->nama]['total_suara'] += 
            $suara->suara_darwis + $suara->suara_baharuddin + $suara->suara_zahir;
        }
        
        // Hitung persentase suara per kecamatan
        foreach ($persentasePerKecamatan as $namaKecamatan => $data) {
            $totalSuara = $data['total_suara'];
            
            $persentasePerKecamatan[$namaKecamatan] = [
                'persentase_darwis' => $totalSuara > 0 ? round(($data['total_darwis'] / $totalSuara) * 100, 2) : 0,
                'persentase_baharuddin' => $totalSuara > 0 ? round(($data['total_baharuddin'] / $totalSuara) * 100, 2) : 0,
                'persentase_zahir' => $totalSuara > 0 ? round(($data['total_zahir'] / $totalSuara) * 100, 2) : 0,
            ];
        }
        
        return response()->json($persentasePerKecamatan);
    }
    
}
