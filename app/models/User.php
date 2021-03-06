<?php
use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\ConfideUserInterface;
use Zizaco\Entrust\HasRole;
use Illuminate\Database\Eloquent\Collection;

class User extends Eloquent implements ConfideUserInterface {

	use ConfideUser;
    use HasRole;

	protected $table    = 'user';
    protected $fillable = ['username', 'password', 'email'];
    protected $hidden   = ['password', 'confirmation_code', 'remember_token', 'confirmed'];

	public function avatar($size = 20) {
		return Gravatar::src($this->email, $size);
	}

    public function topics() {
        return $this->hasMany('Topic');
    }

    public function topicVotes() {
        return $this->hasMany('TopicVote');
    }

    public function topicComments() {
        return $this->hasMany('TopicComment');
    }

    public function connections() {
        return $this->hasMany('UserConnection');
    }

    public function scopeRandom($query, $amount = 6) {
        $items  = $this->orderBy('created_at', 'desc')->take(100)->get();
        $amount = $items->count() > $amount ? $amount : $items->count();
        $users  = $items->random($amount);

        if (is_array($users) === false && $users !== null) {
            return [$users];
        }else{
            return $users;
        }
    }

}
