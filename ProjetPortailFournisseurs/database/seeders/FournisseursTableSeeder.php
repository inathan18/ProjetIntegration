<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class FournisseursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fournisseurs')->insert([
            'id' => '1',
            'name'=> 'Rona Inc Trois-Rivieres',
            'address' => '4025 Boulevard des Récollets',
            'city' => 'Trois-Rivières',
            'province' => 'Québec',
            'country' => 'Canada',
            'phone' => json_encode(['8196930855', 'Bureau']),
            'postCode' => 'g9a6m1',
            'unspsc' => json_encode(['31160000']),
            'website' => 'rona.ca',
            'email' => 'rona@rona.ca',
            'files' => json_encode(['']),
            'neq' => '1171854699',
            'rbq' => '',
            'password' => Hash::make('rona'),
            'raisonRefus' => '',
            'personneContact' => 'Directeur',
            'statut'=> 'A',
        ]);

        DB::table('fournisseurs')->insert([
            'id' => '2',
            'name'=> 'Ford Canada',
            'address' => '1 The Canadian Road',
            'city' => 'Oakville',
            'province' => 'Ontario',
            'country' => 'Canada',
            'phone' => json_encode(['18005653673', 'Bureau']),
            'postCode' => 'L6J5E4',
            'unspsc' => json_encode(['25101702']),
            'website' => 'ford.ca',
            'email' => 'ford@ford.ca',
            'files' => json_encode(['']),
            'neq' => '1146438586',
            'rbq' => '',
            'password' => Hash::make('ford'),
            'raisonRefus' => '',
            'personneContact' => 'Directeur',
            'statut'=> 'A',
        ]);

        DB::table('fournisseurs')->insert([
            'id' => '3',
            'name'=> 'Test Fournisseur',
            'address' => 'Test',
            'city' => 'Trois-Rivieres',
            'province' => 'Quebec',
            'country' => 'Canada',
            'phone' => json_encode(['18005653673', 'Bureau']),
            'postCode' => 'L6J5E4',
            'unspsc' => json_encode(['25101702']),
            'website' => 'ford.ca',
            'email' => 'nathan.lafreniere@gmail.com',
            'files' => json_encode(['']),
            'neq' => '',
            'rbq' => '',
            'password' => Hash::make('nathan'),
            'raisonRefus' => '',
            'personneContact' => 'Nathan',
            'statut'=> 'A',
        ]);

        
    }
}
