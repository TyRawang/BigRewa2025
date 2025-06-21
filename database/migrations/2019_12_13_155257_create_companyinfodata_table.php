<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyinfodataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companyinfodata', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable()->index();
            $table->string('logo', 255)->nullable();
            $table->string('name', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('mobile', 50)->nullable();
            $table->string('address', 100)->nullable();
            $table->string('toll_free_no', 100)->nullable();
            $table->string('website')->nullable();
            $table->text('company_info')->nullable();
			$table->text('email_template_token')->nullable();
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
		Schema::table('companyinfodata', function (Blueprint $table) {
			$table->dropForeign(['user_id']);
		});		
        Schema::dropIfExists('companyinfodata');
    }
}
