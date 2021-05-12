<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAvoirIdToClesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cles', function (Blueprint $table) {
            $table->unsignedInteger('avoir_id')->nullable();
            $table->foreign('avoir_id')->references('id')->on('avoirs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cles', function (Blueprint $table) {
            $table->dropColumn('avoir_id');
        });
    }
}
