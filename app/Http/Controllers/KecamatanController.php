<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class KecamatanController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view('admin.dapil.kecamatan.index');
    }
    
    public function data()
    {
        $kecamatans = Kecamatan::with(['kabupatenKota'])
        ->select(['kecamatans.id', 'kecamatans.nama', 'kecamatans.kabupaten_kota_id'])
        ->get();
        
        return DataTables::of($kecamatans)
        ->addIndexColumn()
        ->addColumn('kabupaten_kota_nama', function($row){
            return $row->kabupatenKota ? $row->kabupatenKota->nama : 'N/A';
        })
        ->addColumn('action', function($row) {
            $btn = '<a href="javascript:void(0)" 
            class="edit btn btn-warning btn-sm" 
            data-id="' . $row->id . '" 
            data-nama="' . $row->nama . '" 
            data-kabupaten_kota_id="' . $row->kabupaten_kota_id . '" 
            onclick="editData(this)"><i class="fas fa-edit"></i></a>';
            $btn .= ' <button type="button" 
            class="btn btn-danger btn-sm" 
            onclick="deleteData(event, \'' . route('kecamatan.destroy', $row->id) . '\', \'' . $row->nama . '\')"><i class="fas fa-trash"></i></button>';
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
                Rule::unique('kecamatans')->where(function ($query) use ($request) {
                    return $query->where('kabupaten_kota_id', $request->kabupaten_kota_id);
                }),
            ],
            'kabupaten_kota_id' => 'required|integer|exists:kabupaten_kotas,id',
        ], [
            'nama.unique' => 'Nama kecamatan sudah ada di kabupaten/kota yang dipilih.',
            'kabupaten_kota_id.required' => 'Kabupaten/Kota harus dipilih.',
        ]);
        
        // Simpan data ke database
        Kecamatan::create([
            'nama' => $request->nama,
            'kabupaten_kota_id' => $request->kabupaten_kota_id,
        ]);
        
        return redirect()->route('kecamatan.index')->with('success', 'Data berhasil disimpan.');
    }
    
    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Kecamatan  $kecamatan
    * @return \Illuminate\Http\Response
    */
    public function show(Kecamatan $kecamatan)
    {
        //
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Kecamatan  $kecamatan
    * @return \Illuminate\Http\Response
    */
    public function edit(Kecamatan $kecamatan)
    {
        //
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Kecamatan  $kecamatan
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Kecamatan $kecamatan)
    {
        $request->validate([
            'nama' => [
                'required',
                'string',
                'max:255',
                Rule::unique('kecamatans')->where(function ($query) use ($request) {
                    return $query->where('kabupaten_kota_id', $request->kabupaten_kota_id);
                }),
            ],
            'kabupaten_kota_id' => 'required|integer|exists:kabupaten_kotas,id',
        ], [
            'nama.unique' => 'Nama kecamatan sudah ada di kabupaten/kota yang dipilih.',
            'kabupaten_kota_id.required' => 'Kabupaten/Kota harus dipilih.',
        ]);
        
        $kecamatan->update([
            'nama' => $request->nama,
            'kabupaten_kota_id' => $request->kabupaten_kota_id,
        ]);

        return redirect()->route('kecamatan.index')->with('success', 'Data berhasil diperbarui.');
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Kecamatan  $kecamatan
    * @return \Illuminate\Http\Response
    */
    public function destroy(Kecamatan $kecamatan)
    {
        $kecamatan->delete();
        
        return response()->json(['success' => 'Data berhasil dihapus.']);
    }
}
