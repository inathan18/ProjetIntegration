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
        Schema::create('fournisseurs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('address', 100);
            $table->string('city', 100);
            $table->string('province', 100);
            $table->string('country', 100);
            $table->json('phone')->nullable();
            $table->string('postCode', 10);
            $table->json('unspsc')->nullable();
            $table->string('website', 255);
            $table->string('email', 100);
            $table->json('files')->nullable();
            $table->string('statut', 10);
            $table->string('neq', 100)->unique();
            $table->string('rbq', 100)->nullable();
            $table->string('personneContact', 100);
            $table->timestamps();
            $table->string('password', 255);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fournisseurs');
    }
};
