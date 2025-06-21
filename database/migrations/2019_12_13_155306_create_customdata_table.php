<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomdataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customdata', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable()->index();

            $table->string('emailtemplate', 50)->nullable();
            $table->integer('from_id')->nullable();
            $table->string('fromname', 50)->nullable();
            $table->string('driver', 50)->nullable();
            $table->string('host', 20)->nullable();
            $table->string('username', 100)->nullable();
            $table->string('pwd', 100)->nullable();
            $table->string('port', 10)->nullable();
            $table->string('encryption', 10)->nullable();
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
        Schema::dropIfExists('customdata');
    }
}
