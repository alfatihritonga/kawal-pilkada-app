<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
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
                'user_id' => 1, // username => admin
                'role_id' => 1, // role => admin
            ],
            [
                'user_id' => 2, // username => operator
                'role_id' => 2, // role => operator
            ],
        ];

        foreach ($data as $item) {
            DB::table('user_roles')->insert($item);
        }
    }
}
