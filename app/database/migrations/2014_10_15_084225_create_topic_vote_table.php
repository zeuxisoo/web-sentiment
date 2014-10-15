<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicVoteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('topic_vote', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->references('id')->on('user');
			$table->integer('topic_id')->unsigned()->references('id')->on('topic');
			$table->enum('choice', ['A', 'B']);
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
		Schema::drop('topic_vote');

		DB::table('topic')->update(['vote_count' => 0]);
	}

}
