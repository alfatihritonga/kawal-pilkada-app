<?php

namespace App\Http\Controllers;

use App\Models\Tps;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class TpsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dapil.tps.index');
    }

    public function data()
    {
        $tps = Tps::with(['kelurahanDesa.kecamatan.kabupatenKota'])
        ->select(['tps.id', 'tps.nama', 'tps.kelurahan_desa_id'])
        ->orderBy('id', 'desc')
        ->get();
        
        return DataTables::of($tps)
        ->addIndexColumn()
        ->addColumn('kelurahan_desa_nama', function($row){
            return $row->kelurahanDesa ? $row->kelurahanDesa->nama : 'N/A';
        })
        ->addColumn('kecamatan_nama', function($row){
            return $row->kelurahanDesa && $row->kelurahanDesa->kecamatan ? $row->kelurahanDesa->kecamatan->nama : 'N/A';
        })
        ->addColumn('kabupaten_kota_nama', function($row){
            return $row->kelurahanDesa && $row->kelurahanDesa->kecamatan && $row->kelurahanDesa->kecamatan->kabupatenKota ? $row->kelurahanDesa->kecamatan->kabupatenKota->nama : 'N/A';
        })
        ->addColumn('action', function($row) {
            $btn = '<a href="javascript:void(0)" 
            class="edit btn btn-warning btn-sm" 
            data-id="' . $row->id . '" 
            data-nama="' . $row->nama . '" 
            data-kelurahan_desa_id="' . $row->kelurahan_desa_id . '" 
            data-kecamatan_id="' . $row->kelurahanDesa->kecamatan->id . '" 
            data-kabupaten_kota_id="' . $row->kelurahanDesa->kecamatan->kabupatenKota->id . '" 
            onclick="editData(this)"><i class="fas fa-edit"></i></a>';
            $btn .= ' <button type="button" 
            class="btn btn-danger btn-sm" 
            onclick="deleteData(event, \'' . route('tps.destroy', $row->id) . '\', \'' . $row->nama . '\')"><i class="fas fa-trash"></i></button>';
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
            'nama' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tps')->where(function ($query) use ($request) {
                    return $query->where('kelurahan_desa_id', $request->kelurahan_desa_id);
                }),
            ],
            'kelurahan_desa_id' => 'required|integer|exists:kelurahan_desas,id',
        ], [
            'nama.unique' => 'Nama tps sudah ada di kelurahan/desa yang dipilih.',
            'kelurahan_desa_id.required' => 'Kelurahan/desa harus dipilih.',
        ]);
        
        // Simpan data ke database
        Tps::create([
            'nama' => $request->nama,
            'kelurahan_desa_id' => $request->kelurahan_desa_id,
        ]);
        
        return redirect()->route('tps.index')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tps  $tps
     * @return \Illuminate\Http\Response
     */
    public function show(Tps $tps)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tps  $tps
     * @return \Illuminate\Http\Response
     */
    public function edit(Tps $tps)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tps  $tps
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tps')->where(function ($query) use ($request) {
                    return $query->where('kelurahan_desa_id', $request->kelurahan_desa_id);
                }),
            ],
            'kelurahan_desa_id' => 'required|integer|exists:kelurahan_desas,id',
        ], [
            'nama.unique' => 'Nama tps sudah ada di kelurahan/desa yang dipilih.',
            'kelurahan_desa_id.required' => 'Kelurahan/desa harus dipilih.',
        ]);

        $tps = Tps::find($id);
        $tps->update([
            'nama' => $request->nama,
            'kelurahan_desa_id' => $request->kelurahan_desa_id,
        ]);

        return redirect()->route('tps.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tps  $tps
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tps = Tps::findOrFail($id);
        $tps->delete();
        
        return response()->json(['success' => 'Data berhasil dihapus.']);
    }
}
