<?php

namespace Database\Seeders;

use App\Models\KabupatenKota;
use App\Models\Kecamatan;
use App\Models\KelurahanDesa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class DataBatuBaraSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $kabupatenKotaModel = KabupatenKota::create([
            'nama' => 'KABUPATEN BATU BARA'
        ]);

        // Mendapatkan data kecamatan
        // Berdasarkan API "id" KABUPATEN BATU BARA => 1219
        // Sehingga request ke API => "http://www.emsifa.com/api-wilayah-indonesia/api/districts/1219.json"
        
        $kecamatans = Http::get("http://www.emsifa.com/api-wilayah-indonesia/api/districts/1219.json")->json();
        foreach ($kecamatans as $kecamatan) {
            $kecamatanModel = Kecamatan::create([
                'nama' => $kecamatan['name'],
                'kabupaten_kota_id' => $kabupatenKotaModel->id,
            ]);
            
            // Mendapatkan data kelurahan/desa
            $desas = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/villages/{$kecamatan['id']}.json")->json();
            foreach ($desas as $desa) {
                KelurahanDesa::create([
                    'nama' => $desa['name'],
                    'kecamatan_id' => $kecamatanModel->id,
                ]);
            }
        }
    }
}
