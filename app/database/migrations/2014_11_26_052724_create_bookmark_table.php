<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookmarkTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bookmark', function(Blueprint $table)
		{
			$table->increments('id');
	        $table->integer('user_id')->references('id')->on('user');
	        $table->integer('topic_id')->references('id')->on('topic');
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
		Schema::drop('bookmark');
	}

}
