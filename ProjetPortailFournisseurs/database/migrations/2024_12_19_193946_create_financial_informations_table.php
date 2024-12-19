<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('financial_informations', function (Blueprint $table) {
            $table->id();
            $table->string('noTps', 100);
            $table->string('noTvq', 100);
            $table->string('conditionPaiement', 10);
            $table->string('devise', 10);
            $table->string('modeCommunication', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_informations');
    }
};
