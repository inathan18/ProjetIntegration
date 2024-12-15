<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ParametersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('parameters')->insert([
            'id' => '1',
            'emailAppro' => 'approvisionnement@v3r.net',
            'delaiRevision' => '24',
            'tailleFichier' => '75',
            'emailFinance' => 'finances@v3r.net',

        ]);
    }
}
