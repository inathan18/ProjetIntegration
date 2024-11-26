<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailTemplatesTable extends Migration
{
    public function up()
    {
        Schema::create('mail_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('subject')->nullable();
            $table->string('greeting')->nullable();
            $table->string('line1')->nullable();
            $table->string('line2')->nullable();
            $table->timestamps();
        });
    }
}
