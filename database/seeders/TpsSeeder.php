<?php

namespace Database\Seeders;

use App\Models\KelurahanDesa;
use App\Models\Tps;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TpsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kelurahanDesa = KelurahanDesa::select('id')->get();

        foreach ($kelurahanDesa as $desa) {
            for ($i = 1; $i <= 5; $i++) { 
                Tps::create([
                    'nama' => 'TPS ' . $i,
                    'kelurahan_desa_id' => $desa->id,
                ]);
            }
        }
    }
}
