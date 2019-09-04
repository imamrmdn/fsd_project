<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTimeline extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timeline', function(Blueprint $table){
        $table->increments('Id');
        $table->integer('Project_Id');
        $table->string('Modul');
        $table->date('Tanggal_awal');
        $table->date('Tanggal_akhir');
        $table->string('PIC');
        $table->integer('Status');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
