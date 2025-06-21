<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailservicedataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailservicedata', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id')->nullable()->index();
            $table->string('subject')->nullable();
            $table->string('employeeName', 200)->nullable();
            $table->string('customerName')->nullable();
            $table->string('customerEmail', 200)->nullable();
            $table->string('estimatedWeight', 50)->nullable();
            $table->string('costPerPound', 250)->nullable();
			$table->integer('status')->default(0);
			$table->float('total')->nullable()->default(0);
			$table->datetime('convert_date')->nullable();
			$table->float('final_amount')->default(0);
            $table->text('note')->nullable();
            $table->string('movingdate1', 25)->nullable();
            $table->string('movingdate2', 100)->nullable();
            $table->string('leadinfo', 500)->nullable();
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
		Schema::table('mailservicedata', function (Blueprint $table) {
			$table->dropForeign(['user_id']);
		});				
        Schema::dropIfExists('mailservicedata');
    }
}
