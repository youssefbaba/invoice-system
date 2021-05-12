<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->enum('etat_facture', ['Provisoire', 'Finalisé', 'Payée', 'APayée']);

            $table->float('total_ht_articlesf');
            $table->float('remise_genf')->nullable();
            $table->float('total_ht_apres_remise_genf');
            $table->float('tvaf');
            $table->float('total_debours')->nullable();
            $table->float('total_facturef');
            $table->string('condition_reglf');
            $table->string('mode_reglf')->nullable();
            $table->string('interet_reglf')->nullable();
            $table->string('code_bancf')->nullable();
            $table->longText('text_introductionf')->nullable();
            $table->longText('text_conclusionf')->nullable();
            $table->longText('pied_pagef')->nullable();
            $table->unsignedInteger('client_id')->nullable();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('devis');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factures');
    }
}
