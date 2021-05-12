<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devis', function (Blueprint $table) {
            $table->integerincrements('id');
            $table->enum('etat_devis', ['Provisoire', 'Finalisé', 'Refusés', 'Signés']);
            $table->float('total_ht_articlesdf')->nullable();
            $table->float('remise_gendf')->nullable();
            $table->integer('remised')->nullable();
            $table->float('total_ht_apres_remise_gendf')->nullable();
            $table->float('tvadf')->nullable();
            $table->float('total_facturedf')->nullable();
            $table->string('condition_regld')->nullable();
            $table->string('mode_regld')->nullable();
            $table->string('interet_regld')->nullable();
            $table->longText('text_introductiond')->nullable();
            $table->longText('text_conclusiond')->nullable();
            $table->longText('pied_paged')->nullable();
            $table->longText('condition_vented')->nullable();
            $table->unsignedInteger('client_id')->nullable();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->unsignedInteger('user_id')->nullable();
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
        Schema::dropIfExists('devis');
    }
}
