<?php

namespace App\Http\Controllers;

use App\Models\Suara;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class OperatorController extends Controller
{
    public function home()
    {
        $kecamatan_id = Auth::user()->profile->kecamatan_id;
        
        $jlhSuara = Suara::whereHas('tps.kelurahanDesa.kecamatan', function ($query) use ($kecamatan_id) {
            $query->where('id', $kecamatan_id);
        })->count();
        
        $jlhSaksi = UserProfile::where('kecamatan_id', Auth::user()->profile->kecamatan_id)
        ->where('role', 'saksi')
        ->count();

        return view('operator.home', compact('jlhSuara', 'jlhSaksi'));
    }
    
    public function saksi()
    {
        return view('operator.saksi.index');
    }
    
    public function dataSaksi()
    {
        $saksi = UserProfile::where('kecamatan_id', Auth::user()->profile->kecamatan_id)
        ->where('role', 'saksi')
        ->select(['nama', 'username', 'password'])
        ->get();
        
        return DataTables::of($saksi)
        ->addIndexColumn()
        ->make(true);
    }
    
    public function saksiStore(Request $request)
    {
        return back()->with('success', 'Berhasil menambah saksi.');
    }
    
    public function suara()
    {
        return view('operator.suara.index');
    }
    
    public function dataSuara()
    {
        $kecamatanId = Auth::user()->profile->kecamatan_id;
        
        $suara = Suara::with(['tps.kelurahanDesa.kecamatan'])
        ->select(['id', 'tps_id', 'suara_darwis', 'suara_baharuddin', 'suara_zahir', 'status'])
        ->when($kecamatanId, function ($query, $kecamatanId) {
            // Filter berdasarkan kecamatan_id
            return $query->whereHas('tps.kelurahanDesa.kecamatan', function ($query) use ($kecamatanId) {
                $query->where('id', $kecamatanId);
            });
        })
        ->orderBy('created_at', 'desc')
        ->get();
        
        return DataTables::of($suara)
        ->addIndexColumn()
        ->addColumn('tps_nama', function($row) {
            return $row->tps ? $row->tps->nama : 'N/A';
        })
        ->addColumn('kelurahan_desa_nama', function($row) {
            return $row->tps->kelurahanDesa ? $row->tps->kelurahanDesa->nama : 'N/A';
        })
        ->addColumn('action', function($row) {
            $btn = '<button class="btn btn-primary btn-sm lihat-detail" data-id="'.$row->id.'"><i class="fas fa-eye"></i></button>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
    
    public function validasiSuara(Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:pending,valid,invalid',
            'suara_id' => 'required|exists:suaras,id',
        ]);
        
        $suara = Suara::findOrFail($validated['suara_id']);
        
        $suara->status = $validated['status'];
        $suara->save();
        
        return redirect()->back()->with('success', 'Status berhasil diperbarui!');
    }
    
}
