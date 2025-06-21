<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtraFieldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_field', function (Blueprint $table) {
            $table->increments('id');
			$table->unsignedInteger('user_id');
            $table->string('field_name')->nullable();
            $table->string('field_type')->nullable();
			$table->unsignedInteger('sorted')->default(0);			
            $table->string('field1_type')->nullable();
			$table->timestamps();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');	
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('extra_field', function (Blueprint $table) {
			$table->dropForeign(['user_id']);
		});				
        Schema::dropIfExists('extra_field');
    }
}
