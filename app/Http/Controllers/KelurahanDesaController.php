<?php

namespace App\Http\Controllers;

use App\Models\KelurahanDesa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class KelurahanDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dapil.kelurahan-desa.index');
    }

    public function data()
    {
        $kelurahanDesas = KelurahanDesa::with(['kecamatan.kabupatenKota'])
        ->select(['kelurahan_desas.id', 'kelurahan_desas.nama', 'kelurahan_desas.kecamatan_id'])
        ->orderBy('id', 'desc')
        ->get();
        
        return DataTables::of($kelurahanDesas)
        ->addIndexColumn()
        ->addColumn('kecamatan_nama', function($row){
            return $row->kecamatan ? $row->kecamatan->nama : 'N/A';
        })
        ->addColumn('kabupaten_kota_nama', function($row){
            return $row->kecamatan && $row->kecamatan->kabupatenKota ? $row->kecamatan->kabupatenKota->nama : 'N/A';
        })
        ->addColumn('action', function($row) {
            $btn = '<a href="javascript:void(0)" 
            class="edit btn btn-warning btn-sm" 
            data-id="' . $row->id . '" 
            data-nama="' . $row->nama . '" 
            data-kecamatan_id="' . $row->kecamatan_id . '" 
            data-kabupaten_kota_id="' . $row->kecamatan->kabupatenKota->id . '" 
            onclick="editData(this)"><i class="fas fa-edit"></i></a>';
            $btn .= ' <button type="button" 
            class="btn btn-danger btn-sm" 
            onclick="deleteData(event, \'' . route('kelurahan-desa.destroy', $row->id) . '\', \'' . $row->nama . '\')"><i class="fas fa-trash"></i></button>';
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
                Rule::unique('kelurahan_desas')->where(function ($query) use ($request) {
                    return $query->where('kecamatan_id', $request->kecamatan_id);
                }),
            ],
            'kecamatan_id' => 'required|integer|exists:kecamatans,id',
        ], [
            'nama.unique' => 'Nama kelurahan/desa sudah ada di kecamatan yang dipilih.',
            'kecamatan_id.required' => 'Kecamatan harus dipilih.',
        ]);
        
        // Simpan data ke database
        KelurahanDesa::create([
            'nama' => $request->nama,
            'kecamatan_id' => $request->kecamatan_id,
        ]);
        
        return redirect()->route('kelurahan-desa.index')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KelurahanDesa  $kelurahanDesa
     * @return \Illuminate\Http\Response
     */
    public function show(KelurahanDesa $kelurahanDesa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KelurahanDesa  $kelurahanDesa
     * @return \Illuminate\Http\Response
     */
    public function edit(KelurahanDesa $kelurahanDesa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KelurahanDesa  $kelurahanDesa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KelurahanDesa $kelurahanDesa)
    {
        $request->validate([
            'nama' => [
                'required',
                'string',
                'max:255',
                Rule::unique('kelurahan_desas')->where(function ($query) use ($request) {
                    return $query->where('kecamatan_id', $request->kecamatan_id);
                }),
            ],
            'kecamatan_id' => 'required|integer|exists:kelurahan_desas,id',
        ], [
            'nama.unique' => 'Nama kelurahan/desa sudah ada di kecamatan yang dipilih.',
            'kecamatan_id.required' => 'Kecamatan harus dipilih.',
        ]);

        $kelurahanDesa->update([
            'nama' => $request->nama,
            'kecamatan_id' => $request->kecamatan_id,
        ]);

        return redirect()->route('kelurahan-desa.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KelurahanDesa  $kelurahanDesa
     * @return \Illuminate\Http\Response
     */
    public function destroy(KelurahanDesa $kelurahanDesa)
    {
        $kelurahanDesa->delete();

        return response()->json(['success' => 'Data berhasil dihapus.']);
    }
}
