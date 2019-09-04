<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTabeleClient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('client', function(Blueprint $table){
        $table->increments('Id');
        $table->string('Nama_Client');
        $table->string('Nama_Perusahaan');
        $table->string('Alamat_Perusahaan');
        $table->string('logo');
        $table->string('logo_url');
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
        //
    }
}
