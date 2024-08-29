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
        DB::table('usagers')-­insert([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'role' => 'admin'

        ]);

        DB::table('usagers')-­insert([
            'id' => 2,
            'name' => 'Responsable',
            'email' => 'responsable@responsable.com',
            'password' => Hash::make('responsable'),
            'role' => 'responsable'

        ]);

        DB::table('usagers')-­insert([
            'id' => 3,
            'name' => 'Commis',
            'email' => 'commis@commis.com',
            'password' => Hash::make('commis'),
            'role' => 'commis'
        ]);


        
    }
}
