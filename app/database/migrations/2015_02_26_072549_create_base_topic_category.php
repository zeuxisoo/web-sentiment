<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaseTopicCategory extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create Topic Categories
        $life = new TopicCategory;
        $life->name = 'Life';
        $life->code = 'life';
        $life->save();

        $life = new TopicCategory;
        $life->name = 'Food';
        $life->code = 'food';
        $life->save();
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
