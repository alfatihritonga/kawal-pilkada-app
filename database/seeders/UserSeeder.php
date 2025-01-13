<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
                'username' => 'admin',
                'password' => 'password',
            ],
            [
                'username' => 'operator',
                'password' => 'password',
            ],
        ];
        
        foreach ($data as $item) {
            // Check if user already exists before creating
            User::firstOrCreate(
                ['username' => $item['username']],
                ['password' => Hash::make($item['password'])]
            );
        }
    }
}
