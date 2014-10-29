<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserConnectionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_connection', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('user_id')->references('id')->on('user');
            $table->string('provider_name', 30);
            $table->string('provider_uid', 30);
            $table->string('email', 180);
            $table->string('display_name', 80)->nullable();
            $table->string('first_name', 80)->nullable();
            $table->string('last_name', 80)->nullable();
            $table->string('profile_url', 180)->nullable();
            $table->string('website_url', 180)->nullable();
            $table->string('photo_url', 180)->nullable();
            $table->text('tokens');
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
		Schema::drop('user_connection');
	}

}
