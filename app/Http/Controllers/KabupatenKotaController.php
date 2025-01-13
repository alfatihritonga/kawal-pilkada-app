<?php

namespace App\Http\Controllers;

use App\Models\KabupatenKota;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KabupatenKotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dapil.kabupaten-kota.index');
    }

    public function data()
    {
        $kabupatenKotas = KabupatenKota::select(['id', 'nama']);
        
        return DataTables::of($kabupatenKotas)
        ->addIndexColumn()
        ->addColumn('action', function($row) {
            $btn = '<a href="javascript:void(0)" 
            class="edit btn btn-warning btn-sm" 
            data-id="' . $row->id . '" 
            data-nama="' . $row->nama . '" 
            onclick="editData(this)"><i class="fas fa-edit"></i></a>';
            $btn .= ' <button type="button" 
            class="btn btn-danger btn-sm" 
            onclick="deleteData(event, \'' . route('kabupaten-kota.destroy', $row->id) . '\', \'' . $row->nama . '\')"><i class="fas fa-trash"></i></button>';
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
            'nama' => 'required|string|max:255|unique:kabupaten_kotas,nama',
        ], [
            'nama.unique' => 'Nama Kabupaten / Kota sudah.',
        ]);
        
        // Simpan data ke database
        KabupatenKota::create([
            'nama' => $request->nama,
        ]);
        
        return redirect()->route('kabupaten-kota.index')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KabupatenKota  $kabupatenKota
     * @return \Illuminate\Http\Response
     */
    public function show(KabupatenKota $kabupatenKota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KabupatenKota  $kabupatenKota
     * @return \Illuminate\Http\Response
     */
    public function edit(KabupatenKota $kabupatenKota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KabupatenKota  $kabupatenKota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_edit' => 'required|string|max:255|unique:kabupaten_kotas,nama,' . $id,
        ], [
            'nama_edit.unique' => 'Nama Kabupaten / Kota sudah.',
        ]);
        
        $kabupatenKota = KabupatenKota::find($id);
        $kabupatenKota->nama = $request->nama_edit;
        $kabupatenKota->save();
        
        return redirect()->route('kabupaten-kota.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KabupatenKota  $kabupatenKota
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kabupatenKota = KabupatenKota::findOrFail($id);
        $kabupatenKota->delete();
        
        return response()->json(['success' => 'Data berhasil dihapus.']);
    }
}
