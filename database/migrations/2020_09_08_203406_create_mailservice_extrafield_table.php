<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailserviceExtrafieldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailservice_extrafield', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('mailservice_id');
            $table->string('field_name')->nullable();
            $table->string('field_type')->nullable();
            $table->string('field_value')->nullable();
            $table->string('field1_type')->nullable();
            $table->string('field1_value')->nullable();			
            $table->timestamps();
			$table->foreign('mailservice_id')->references('id')->on('mailservicedata')->onDelete('cascade');			
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('mailservice_extrafield', function (Blueprint $table) {
			$table->dropForeign(['mailservice_id']);
		});				
        Schema::dropIfExists('mailservice_extrafield');
    }
}
