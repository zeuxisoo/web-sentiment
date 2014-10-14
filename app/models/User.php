<?php
use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\ConfideUserInterface;

class User extends Eloquent implements ConfideUserInterface {

	use ConfideUser;

	protected $table = 'user';

	public function avatar($size = 20) {
		return Gravatar::src($this->email, $size);
	}

    public function topics() {
        return $this->hasMany('Topic');
    }

    public function scopeRandom($query, $amount = 6) {
        $items  = $this->orderBy('created_at', 'desc')->take(100)->get();
        $amount = $items->count() > $amount ? $amount : $items->count();

        return $items->random($amount);
    }

}
