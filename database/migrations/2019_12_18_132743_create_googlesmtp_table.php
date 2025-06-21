<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGooglesmtpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('googlesmtp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->longText('access_token')->nullable();
            $table->integer('expires_in')->nullable();
            $table->text('scope')->nullable();
            $table->string('token_type', 255)->nullable();
            $table->integer('created')->nullable();
            $table->longText('refresh_token')->nullable();
            $table->string('email')->nullable();
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
		Schema::table('googlesmtp', function (Blueprint $table) {
			$table->dropForeign(['user_id']);
		});		
		Schema::dropIfExists('googlesmtp');
    }
}
