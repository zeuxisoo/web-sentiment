<?php
class Bookmark extends Eloquent {

    protected $table = 'bookmark';

    protected $fillable = ['topic_id', 'user_id'];

    public function topic() {
        return $this->belongsTo('Topic');
    }

    public function user() {
        return $this->belongsTo('User');
    }

    public function scopeTopicAndUser($query, $topic, $user) {
        $query = $query->whereTopicId($topic->id);

        if ($user === null) {
            $query = $query->whereUserId(null);
        }else{
            $uqery = $query->whereUserId($user->id);
        }

        return $query;
    }

}
