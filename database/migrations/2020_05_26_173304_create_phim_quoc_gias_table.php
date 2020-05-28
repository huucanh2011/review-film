<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhimQuocGiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phim_quoc_gias', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('phim_id')->unsigned();
            $table->integer('quocgia_id')->unsigned();
            $table->timestamps();

            $table->foreign('phim_id')->references('id')->on('phims')->onDelete('cascade');
            $table->foreign('quocgia_id')->references('id')->on('quoc_gias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phim_quoc_gias');
    }
}
