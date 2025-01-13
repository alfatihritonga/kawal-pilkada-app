<?php

namespace App\Http\Controllers;

use App\Models\KabupatenKota;
use App\Models\Kecamatan;
use App\Models\KelurahanDesa;
use App\Models\Suara;
use App\Models\Tps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SuaraController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view('admin.suara.index');
    }
    
    public function data()
    {
        $suara = Suara::with(['tps.kelurahanDesa'])
        ->select(['id', 'tps_id', 'suara_darwis', 'suara_baharuddin', 'suara_zahir', 'status'])
        ->orderBy('created_at', 'desc')
        ->get();
        
        return DataTables::of($suara)
        ->addIndexColumn()
        ->addColumn('tps_nama', function($row){
            return $row->tps ? $row->tps->nama : 'N/A';
        })
        ->addColumn('kelurahan_desa_nama', function($row){
            return $row->tps->kelurahanDesa ? $row->tps->kelurahanDesa->nama : 'N/A';
        })
        ->addColumn('action', function($row) {
            $btn = '<button class="btn btn-primary btn-sm lihat-detail" data-id="'.$row->id.'"><i class="fas fa-eye"></i></button>';
            
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        //
    }
    
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
            'tps_id' => 'required|integer|exists:tps,id',
            'form_c1' => 'image|max:5012',
            'suara_darwis' => 'required|integer',
            'suara_baharuddin' => 'required|integer',
            'suara_zahir' => 'required|integer',
        ]);
        
        $filePath = $this->storeImage($request);
        
        Suara::create([
            'suara_darwis' => $request->suara_darwis,
            'suara_baharuddin' => $request->suara_baharuddin,
            'suara_zahir' => $request->suara_zahir,
            'tps_id' => $request->tps_id,
            'user_id' => Auth::user()->id,
            'status' => 'pending',
            'form_c1' => $filePath,
        ]);
        
        return back()->with('success', 'Data berhasil disimpan.');
    }
    
    private function storeImage($request)
    {
        if ($request->hasFile('form_c1')) {
            // Ambil nama lokasi berdasarkan ID, jika null gunakan 'unknown'
            $kabupaten = strtolower(optional(KabupatenKota::find($request->kabupaten_kota_id))->nama) ?? 'unknown';
            $kecamatan = strtolower(optional(Kecamatan::find($request->kecamatan_id))->nama) ?? 'unknown';
            $desa = strtolower(optional(KelurahanDesa::find($request->kelurahan_desa_id))->nama) ?? 'unknown';
            $tps = strtolower(optional(Tps::find($request->tps_id))->nama) ?? 'unknown';
            
            // Format nama file: c1-kabupaten-kecamatan-desa-tps-timestamp.ext
            $timestamp = now()->format('YmdHis'); // Format waktu: YYYYMMDDHHMMSS
            $originalExtension = $request->file('form_c1')->getClientOriginalExtension();
            $filename = sprintf(
                'c1-%s-%s-%s-%s-%s.%s',
                str_replace(' ', '_', $kabupaten),
                str_replace(' ', '_', $kecamatan),
                str_replace(' ', '_', $desa),
                str_replace(' ', '_', $tps),
                $timestamp,
                $originalExtension
            );
            
            // Simpan file di folder 'storage/app/public/img/c1'
            $path = $request->file('form_c1')->storeAs('public/img/c1', $filename);
            
            // Hapus prefix 'public/' agar URL bisa diakses melalui '/storage/'
            return str_replace('public/', '', $path);
        }
        
        return null; // Jika tidak ada file, kembalikan null
    }
    
    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Suara  $suara
    * @return \Illuminate\Http\Response
    */
    public function show(Suara $suara)
    {
        return response()->json([
            'tps_nama' => $suara->tps->nama,
            'kelurahan_desa_nama' => $suara->tps->kelurahanDesa->nama,
            'kecamatan_nama' => $suara->tps->kelurahanDesa->kecamatan->nama,
            'kabupaten_kota_nama' => $suara->tps->kelurahanDesa->kecamatan->kabupatenKota->nama,
            'suara_darwis' => $suara->suara_darwis,
            'suara_baharuddin' => $suara->suara_baharuddin,
            'suara_zahir' => $suara->suara_zahir,
            'filepath_form_c1' => asset('storage/' . $suara->form_c1),
        ]);
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Suara  $suara
    * @return \Illuminate\Http\Response
    */
    public function edit(Suara $suara)
    {
        //
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Suara  $suara
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Suara $suara)
    {
        //
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Suara  $suara
    * @return \Illuminate\Http\Response
    */
    public function destroy(Suara $suara)
    {
        //
    }
    
    public function suaraSaksiData()
    {
        $suara = Suara::with(['tps.kelurahanDesa.kecamatan'])
        ->where('user_id', Auth::user()->id)
        ->select(['id', 'tps_id', 'suara_darwis', 'suara_baharuddin', 'suara_zahir', 'form_c1','user_id', 'created_at'])
        ->orderBy('id', 'desc')
        ->get();
        
        return DataTables::of($suara)
        ->addIndexColumn()
        ->addColumn('tps_nama', function($row){
            return $row->tps ? $row->tps->nama : 'N/A';
        })
        ->addColumn('kelurahan_desa_nama', function($row){
            return $row->tps->kelurahanDesa ? $row->tps->kelurahanDesa->nama : 'N/A';
        })
        ->addColumn('kecamatan_nama', function($row){
            return $row->tps->kelurahanDesa->kecamatan ? $row->tps->kelurahanDesa->kecamatan->nama : 'N/A';
        })
        ->addColumn('form_c1', function($row) {
            if ($row->form_c1) {
                return '<img src="' . asset('storage/' . $row->form_c1) . '" alt="Form C1" width="100">';
            } else {
                return 'Belum ada';
            }
        })
        ->rawColumns(['form_c1'])
        ->make(true);
    }
    
    public function uploadC1(Request $request)
    {
        $request->validate([
            'tps_id' => 'required|integer|exists:tps,id',
            'form_c1' => 'required|image|max:5012',
        ]);
        
        $suara = Suara::where('tps_id', $request->tps_id)->first();
        if (!$suara) {
            return back()->with('error', 'Data suara tidak ditemukan untuk TPS tersebut.');
        }
        
        $filePath = $this->storeImage($request);
        
        $suara->form_c1 = $filePath;
        $suara->save();
        
        return redirect()->route('saksi.home')->with('success', 'Foto C1 berhasil dikirim');
    }
}
