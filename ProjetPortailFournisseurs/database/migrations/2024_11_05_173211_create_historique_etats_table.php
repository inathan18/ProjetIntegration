<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriqueEtatsTable extends Migration
{
    public function up()
    {
        Schema::create('historique_etats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fournisseur_id')->constrained('fournisseurs')->onDelete('cascade');
            $table->string('etat');
            $table->string('modifie_par');
            $table->text('raison_refus')->nullable();
            $table->json('modifications')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('historique_etats');
    }
}

