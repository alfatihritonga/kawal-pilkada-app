<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $data = [
            [
                'nama' => 'admin',
            ],
            [
                'nama' => 'operator',
            ],
            [
                'nama' => 'saksi',
            ],
        ];
        
        foreach ($data as $item) {
            Role::firstOrCreate(['nama' => $item['nama']]);
        }
    }
}
