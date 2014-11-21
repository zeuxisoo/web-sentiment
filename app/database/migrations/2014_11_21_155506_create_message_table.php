<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('message', function(Blueprint $table)
		{
			$table->increments('id');
	        $table->integer('sender_id')->references('id')->on('user');
	        $table->integer('receiver_id')->references('id')->on('user');
	        $table->enum('category', ['normal', 'system'])->default('normal');
	        $table->string('subject', 180);
	        $table->text('content');
	        $table->tinyInteger('have_read')->default(0);
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
		Schema::drop('message');
	}

}
