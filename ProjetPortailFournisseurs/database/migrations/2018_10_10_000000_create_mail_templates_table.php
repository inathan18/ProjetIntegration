<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailTemplatesTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('mail_templates')) {
            Schema::create('mail_templates', function (Blueprint $table) {
                $table->id();
                $table->string('type');
                $table->string('name');
                $table->string('subject')->nullable();
                $table->string('line1')->nullable();
                $table->string('line2')->nullable();
                $table->string('line3')->nullable();
                $table->timestamps();
            });
        }
    }
    
}
