<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('clients');
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('adresse_email_client')->nullable();
            $table->string('nom_client');
            $table->string('prenom_client');
            $table->string('fonction_client')->nullable();
            $table->string('adresse_client')->nullable();
            $table->string('langue_client')->nullable();
            $table->integer('codep_client')->nullable();
            $table->string('ville_client')->nullable();
            $table->string('site_client')->nullable();
            $table->string('tel_client')->nullable();
            $table->string('societe_client')->nullable();
            $table->text('note_client')->nullable();
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('clients');
    }
}
