<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaseRole extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create Roles
        $user = new Role;
        $user->name = 'User';
        $user->save();

        $banned = new Role;
        $banned->name = 'Banned';
        $banned->save();

        $admin = new Role;
        $admin->name = 'Admin';
        $admin->save();
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		$roles = Role::all();

		foreach($roles as $role) {
			$role->delete();
		}
	}

}
