<?php

namespace App\Http\Controllers;

use App\Models\KabupatenKota;
use App\Models\Kecamatan;
use App\Models\KelurahanDesa;
use App\Models\Tps;
use Illuminate\Http\Request;

class DapilController extends Controller
{
    public function getKabupatenKota()
    {
        $kabupatenKota = KabupatenKota::select(['id', 'nama'])->get();
        
        return response()->json($kabupatenKota);
    }
    
    public function getKecamatan()
    {
        $kecamatan = Kecamatan::select(['id', 'kabupaten_kota_id', 'nama'])
        ->orderBy('nama', 'asc')
        ->get();
        
        return response()->json($kecamatan);
    }
    
    public function getKelurahanDesa()
    {
        $kelurahanDesa = KelurahanDesa::select(['id', 'kecamatan_id', 'nama'])->get();
        
        return response()->json($kelurahanDesa);
    }
    
    public function getTPS()
    {
        $tps = TPS::select(['id', 'kelurahan_desa_id', 'nama'])->get();
        
        return response()->json($tps);
    }
    
    public function getKecamatanByKabupatenKotaID($kabupatenKotaID)
    {
        $kecamatan = Kecamatan::where('kabupaten_kota_id', $kabupatenKotaID)
        ->select(['id', 'kabupaten_kota_id', 'nama'])
        ->orderBy('nama', 'asc')
        ->get();
        
        return response()->json($kecamatan);
    }
    
    public function getKelurahanDesaByKecamatanID($kecamatanID)
    {
        $kelurahanDesa = KelurahanDesa::where('kecamatan_id', $kecamatanID)
        ->select(['id', 'kecamatan_id', 'nama'])
        ->orderBy('nama', 'asc')
        ->get();
        
        return response()->json($kelurahanDesa);
    }
    
    public function getTpsByKelurahanDesaID($kelurahanDesaID)
    {
        $tps = Tps::where('kelurahan_desa_id', $kelurahanDesaID)
        ->select(['id', 'kelurahan_desa_id', 'nama'])
        ->orderByRaw('LENGTH(nama), nama')
        ->get();
        
        return response()->json($tps);
    }
}
