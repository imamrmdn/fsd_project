<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_project', function(Blueprint $table){
        $table->increments('Id');
        $table->string('Nama_Project');
        $table->integer('Status_Project');
        $table->integer('Client_Id');
        $table->string('Upload_By');
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
