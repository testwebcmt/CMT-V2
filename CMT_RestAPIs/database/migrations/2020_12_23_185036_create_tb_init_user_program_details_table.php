<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbInitUserProgramDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_init_user_program_details', function (Blueprint $table) {
           //$table->id();
           $table->bigIncrements('program_details_id');            
           $table->string('programName');
           $table->string('category');
           
           $table->bigInteger('userId')->unsigned()->index();
           $table->foreign('userId')->references('userId')->on('tb_init_user_details')->onDelete('cascade');

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
        Schema::dropIfExists('tb_init_user_program_details');
    }
}
