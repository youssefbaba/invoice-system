<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->enum('type_article',['Service','Acompte','Heures','Jours','Produit']);
            $table->integer('quantité_article');
            $table->float('prix_ht_article');
            $table->integer('tva')->nullable();
            $table->integer('reduction_article')->nullable();
            $table->float('total_ht_article');
            $table->float('total_ttc_article');
            $table->text('description_article')->nullable();
            $table->unsignedInteger('facture_id')->nullable();
            $table->foreign('facture_id')->references('id')->on('factures')->onDelete('cascade');
            $table->unsignedInteger('devi_id')->nullable();
            $table->foreign('devi_id')->references('id')->on('devis')->onDelete('cascade');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('articles');
    }
}
