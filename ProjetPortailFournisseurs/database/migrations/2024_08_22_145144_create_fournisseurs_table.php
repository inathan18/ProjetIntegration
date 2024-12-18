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
            $table->string('province', 100)->default('Québec');
            $table->string('region', 100)->nullable();
            $table->string('country', 100)->default('Canada');
            $table->json('phone')->nullable();
            $table->string('postCode', 10);
            $table->json('unspsc')->nullable();
            $table->string('website', 255);
            $table->string('email', 100)->unique();
            $table->json('files')->nullable();
            $table->string('statut', 10)->default('AT');
            $table->string('neq', 100)->nullable()->unique();
            $table->string('rbq', 100)->nullable();
            $table->json('typesRbq')->nullable();
            $table->json('personneContact');
            $table->timestamps();
            $table->text('raisonRefus')->nullable();
            $table->string('password', 255);
            $table->unsignedBigInteger('financial_information_id');
            $table->datetime('email_verified_at')->nullable();
            $table->rememberToken();
            $table->foreign('financial_information_id')->nullable()
            ->references('id')->on('financial_informations')
            ->onDelete('cascade')
            ->nullable();
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
