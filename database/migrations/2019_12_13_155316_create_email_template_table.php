<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_template', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable()->index();

            $table->string('title', 100)->nullable();
            $table->string('logo', 200)->nullable();
            $table->text('description')->nullable();
            $table->string('background_color', 50)->nullable();
			$table->text('email_template_token')->nullable();
            $table->string('status', 20)->nullable();
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
		Schema::table('email_template', function (Blueprint $table) {
			$table->dropForeign(['user_id']);
		});				
        Schema::dropIfExists('email_template');
    }
}
