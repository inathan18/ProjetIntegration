<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

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
            'region' => 'Mauricie (04)',
            'country' => 'Canada',
            'phone' => json_encode(['8196930855', 'Bureau']),
            'postCode' => 'g9a6m1',
            'unspsc' => json_encode(['31160000']),
            'website' => 'rona.ca',
            'email' => 'rona@rona.ca',
            'files' => json_encode(['']),
            'neq' => '1171854699',
            'rbq' => '',
            'typesRbq' => '',
            'password' => Hash::make('rona'),
            'raisonRefus' => null,
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
            'typesRbq' => '',
            'password' => Hash::make('ford'),
            'raisonRefus' => null,
            'personneContact' => 'Directeur',
            'statut'=> 'A',
        ]);

        DB::table('fournisseurs')->insert([
            'id' => '3',
            'name'=> 'Test Fournisseur',
            'address' => 'Test',
            'city' => 'Abercorn',
            'province' => 'Quebec',
            'country' => 'Canada',
            'phone' => json_encode(['18005653673', 'Bureau']),
            'postCode' => 'L6J5E4',
            'unspsc' => json_encode(['25101702']),
            'website' => 'ford.ca',
            'email' => 'nathan.lafreniere@gmail.com',
            'files' => json_encode(['']),
            'neq' => '3',
            'rbq' => '',
            'typesRbq' => '',
            'password' => Hash::make('nathan'),
            'raisonRefus' => null,
            'personneContact' => 'Nathan',
            'statut'=> 'A',
        ]);

        DB::table('fournisseurs')->insert([
            'id' => '4',
            'name'=> 'Test Attente',
            'address' => 'Test',
            'city' => 'Acton Vale',
            'province' => 'Quebec',
            'country' => 'Canada',
            'phone' => json_encode(['18005653673', 'Bureau']),
            'postCode' => 'L6J5E4',
            'unspsc' => json_encode(['25101702']),
            'website' => 'ford.ca',
            'email' => 'nathan.lafreniere@gmail.com',
            'files' => json_encode(['']),
            'neq' => '4',
            'rbq' => '',
            'password' => Hash::make('nathan'),
            'raisonRefus' => null,
            'personneContact' => 'Nathan',
            'statut'=> 'AT',
        ]);

        DB::table('fournisseurs')->insert([
            'id' => '5',
            'name'=> 'Test Refus',
            'address' => 'Test',
            'city' => 'Litchfield',
            'province' => 'Quebec',
            'country' => 'Canada',
            'phone' => json_encode(['18005653673', 'Bureau']),
            'postCode' => 'L6J5E4',
            'unspsc' => json_encode(['25101702']),
            'website' => 'ford.ca',
            'email' => 'nathan.lafreniere@gmail.com',
            'files' => json_encode(['']),
            'neq' => '5',
            'rbq' => '',
            'password' => Hash::make('nathan'),
            'raisonRefus' => Crypt::encryptString('Raison du refus '),
            'personneContact' => 'Nathan',
            'statut'=> 'R',
        ]);

        DB::table('fournisseurs')->insert([
            'id' => '6',
            'name'=> 'Test Révision',
            'address' => 'Test',
            'city' => 'Noyan',
            'province' => 'Quebec',
            'country' => 'Canada',
            'phone' => json_encode(['18005653673', 'Bureau']),
            'postCode' => 'L6J5E4',
            'unspsc' => json_encode(['25101702']),
            'website' => 'ford.ca',
            'email' => 'nathan.lafreniere@gmail.com',
            'files' => json_encode(['']),
            'neq' => '6',
            'rbq' => '',
            'password' => Hash::make('nathan'),
            'raisonRefus' => null,
            'personneContact' => 'Nathan',
            'statut'=> 'AR',
        ]);
        
    }
}
