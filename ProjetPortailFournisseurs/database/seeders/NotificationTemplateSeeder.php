<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class NotificationTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('mail_templates')->insert([
            'id' => '1',
            'type' => 'Bienvenue',
            'name' => 'Bienvenue Fournisseur',
            'subject' => 'Bienvenue',
            'line1' => 'Bienvenue sur le Portail des fournisseurs de la ville de Trois-Rivières !',
            'line2' => 'Merci de votre intérêt pour notre ville!',
            'line3' => '',
        ]);
        DB::table('mail_templates')->insert([
            'id' => '2',
            'type' => 'Changement',
            'name' => 'Changement Fournisseur',
            'subject' => 'Changement à votre profil',
            'line1' => 'Un modification a été effectué sur votre profil fournisseur.',
            'line2' => 'Merci de votre collaboration!',
            'line3' => '',
        ]);
        DB::table('mail_templates')->insert([
            'id' => '3',
            'type' => 'Changement',
            'name' => 'Changement Statut',
            'subject' => 'Changement à votre statut de fournisseur',
            'line1' => 'Votre statut de fournisseur a été modifié sur votre profil fournisseur.',
            'line2' => 'Merci de votre collaboration!',
            'line3' => '',
        ]);
        DB::table('mail_templates')->insert([
            'id' => '4',
            'type' => 'Nouveau',
            'name' => 'Nouveau Fournisseur',
            'subject' => 'Nouveau fournisseur inscrit.',
            'line1' => 'Un nouveau fournisseur s\'est inscrit sur le portail.',
            'line2' => 'Merci de prendre en charge la demande.',
            'line3' => '',
        ]);
    }
}
