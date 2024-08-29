<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FournisseursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fournisseurs')-­>insert([
            'name'=> 'Rona Inc Trois-Rivieres',
            'address' => '4025 Boulevard des Récollets',
            'city' => 'Trois-Rivières',
            'province' => 'Québec',
            'country' => 'Canada',
            'phone' => '8196930855',
            'postCode' => 'g9a6m1',
            'unspsc' => '31160000',
            'website' => 'rona.ca',
            'email' => 'rona@rona.ca',
            'files',
            'neq' => '1171854699',
            'rbq',
            'password' => Hash::make('rona'),
        ]);

        DB::table('fournisseurs')->­insert([
            'name'=> 'Ford Canada',
            'address' => '1 The Canadian Road',
            'city' => 'Oakville',
            'province' => 'Ontario',
            'country' => 'Canada',
            'phone' => '18005653673',
            'postCode' => 'L6J5E4',
            'unspsc' => '25101702',
            'website' => 'ford.ca',
            'email' => 'ford@ford.ca',
            'files',
            'neq' => '1146438586',
            'rbq',
            'password' => Hash::make('ford'),
        ]);

        
    }
}
