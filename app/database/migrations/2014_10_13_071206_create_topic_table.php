<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('topic', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->references('id')->on('user');
			$table->string('subject', 180)->index();
			$table->string('cover', 64)->nullable();
			$table->text('description');
			$table->string('answer_a_text', 180);
			$table->string('answer_b_text', 180);
			$table->string('answer_a_image', 64)->nullable();
			$table->string('answer_b_image', 64)->nullable();
			$table->mediumInteger('view_count')->unsigned()->default(0);
			$table->mediumInteger('vote_count')->unsigned()->default(0);
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
		Schema::drop('topic');
	}

}
