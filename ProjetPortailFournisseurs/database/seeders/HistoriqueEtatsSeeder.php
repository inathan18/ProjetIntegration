<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class HistoriqueEtatsSeeder extends Seeder
{
    public function run()
    {
        DB::table('historique_etats')->insert([
            [
                'fournisseur_id' => 1,
                'etat' => 'AT',
                'modifie_par' => 'Admin',
                'raison_refus' => null,
                'modifications' => null,
                'created_at' => '2024-01-01 10:00:00', 
                'updated_at' => '2024-01-01 10:00:00', 
            ],
            [
                'fournisseur_id' => 1,
                'etat' => 'R',
                'modifie_par' => 'Admin',
                'raison_refus' => Crypt::encryptString('Ne correspond pas à nos attentes'),
                'modifications' => null,
                'created_at' => '2024-02-15 14:30:00', 
                'updated_at' => '2024-02-15 14:30:00', 
            ],
            [
                'fournisseur_id' => 1,
                'etat' => 'M',
                'modifie_par' => 'Admin',
                'raison_refus' => null,
                'modifications' => json_encode(['champ1' => 'modifié', 'champ2' => 'ajouté']),
                'created_at' => '2024-03-10 09:15:00', 
                'updated_at' => '2024-03-10 09:15:00', 
            ],
        ]);
    }
}
