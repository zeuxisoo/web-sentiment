<?php
use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\ConfideUserInterface;

class User extends Eloquent implements ConfideUserInterface {

	use ConfideUser;

	protected $table = 'user';

	public function avatar($size = 20) {
		return Gravatar::src($this->email, $size);
	}

}
