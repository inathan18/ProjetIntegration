<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UsagersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usagers')->insert([
            'id' => 1,
            'email' => 'admin@admin.com',
            'role' => 'admin'

        ]);

        DB::table('usagers')->insert([
            'id' => 2,
            'email' => 'responsable@responsable.com',
            'role' => 'responsable'

        ]);

        DB::table('usagers')->insert([
            'id' => 3,
            'email' => 'commis@commis.com',
            'role' => 'commis'
        ]);
    }
}
